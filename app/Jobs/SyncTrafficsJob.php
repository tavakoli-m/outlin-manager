<?php

namespace App\Jobs;

use App\Http\Services\OutlineService;
use App\Models\AccessKey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class SyncTrafficsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $outlineService = new OutlineService();

        $access_keys_traffics = $outlineService->usedTraffics();

        $active_access_keys = AccessKey::where('status', 'active')->get();

        foreach ($active_access_keys as $access_key) {

            if((int)$access_keys_traffics[$access_key->key_id]){
            $access_key->update([
                'used_traffic' => (int)$access_keys_traffics[$access_key->key_id]
            ]);
        }

        $this->checkAccessKeys($active_access_keys, $outlineService);
            }
            
    }

    private function checkAccessKeys($active_access_keys, $outlineService)
    {

        foreach ($active_access_keys as $access_key) {
            if (($access_key->limit_traffic) !== null && (int)$access_key->used_traffic >= (int)$access_key->limit_traffic) {

                $result = $outlineService->deleteAccessKey($access_key->key_id);

                if ($result === 204) {
                    $access_key->update([
                        'status' => 'limited',
                        'key_id' => null,
                        'key_secret' => null,
                        'deleted_at' => now(),
                    ]);
                }
            } else if (($access_key->expire_at) !== null && $access_key->expire_at <= now()) {


                $result = $outlineService->deleteAccessKey($access_key->key_id);
                if ($result === 204) {

                    $access_key->update([
                        'status' => 'expired',
                        'key_id' => null,
                        'key_secret' => null,
                        'deleted_at' => now(),
                    ]);
                }
            } else {
                continue;
            }
        }
    }
}
