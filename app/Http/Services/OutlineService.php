<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class OutlineService
{
    public mixed $outline_host;
    public mixed $outline_port;
    public mixed $outline_secret;
    public mixed $outline_api_url;

    public function __construct()
    {
        $this->outline_host = env('OUTLINE_HOST');
        $this->outline_port = env('OUTLINE_PORT');
        $this->outline_secret = env('OUTLINE_SECRET');
        $this->outline_api_url = $this->outline_host . ':' . $this->outline_port . '/' . $this->outline_secret;
    }

    public function createAccessKey(string $name)
    {
        $url = $this->outline_api_url . '/access-keys';
        $request = Http::withoutVerifying()->post($url, ['name' => $name]);
        $response = $request->json();
        return $response;
    }
    public function deleteAccessKey(string $id)
    {
        $url = $this->outline_api_url . '/access-keys/' . $id;
        $request = Http::withoutVerifying()->delete($url);
        $response = $request->status();
        return $response;
    }

    public function usedTraffics()
    {
        $url = $this->outline_api_url . '/metrics/transfer/';
        $request = Http::withoutVerifying()->get($url);
        $response = $request->json()['bytesTransferredByUserId'];
        return $response;
    }
}
