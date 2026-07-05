<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessKey\StoreAccessKeyRequest;
use App\Http\Services\OutlineService;
use App\Models\AccessKey;

class AccessKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access_keys = AccessKey::oldest()->paginate(50);

        return view('index', compact('access_keys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccessKeyRequest $request, OutlineService $outlineService)
    {
        $inputs = $request->validated();

        if (!empty($inputs['limit_traffic']) && $inputs['limit_traffic']) {
            $inputs['limit_traffic'] = (int)$inputs['limit_traffic'] * 1000 * 1000 * 1000;
        }

        $expireAtTimestamp = substr($request->expire_at, 0, 10);
        if ((int)$expireAtTimestamp > time()) {
            $inputs['expire_at'] = date('Y-m-d H:i:s', $expireAtTimestamp);
        } else {
            $inputs['expire_at'] = null;
        }

        $access_key = $outlineService->createAccessKey($inputs['name']);

        $inputs['key_id'] = $access_key['id'];
        $inputs['key_secret'] = $access_key['accessUrl'];
        $inputs['public_id'] = rand(1111111, 9999999);

        AccessKey::create($inputs);

        return to_route('app.access-key.index')->with('success', 'عملیات ساخت کلید دسترسی با موفقیت انجام شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessKey $access_key, OutlineService $outlineService)
    {
        if ($access_key->status === 'active') {
            $result = $outlineService->deleteAccessKey($access_key->key_id);

            $access_key->update(['status' => 'deleted', 'deleted_at' => now(), 'key_id' => null, 'key_secret' => null]);

            return to_route('app.access-key.index')->with('success', 'عملیات حذف کلید دسترسی با موفقیت انجام شد');
        }
        return to_route('app.access-key.index')->with('error', 'کلید از قبل حذف شده است');
    }

    public function show(AccessKey $access_key) {
        return view('show',compact('access_key'));
    }
}
