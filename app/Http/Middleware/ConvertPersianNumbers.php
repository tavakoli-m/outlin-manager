<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertPersianNumbers
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(
            $this->convertArray($request->all())
        );
        return $next($request);
    }

    private function convertArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->convertArray($value);
            } elseif (is_string($value)) {
                $data[$key] = convertPersianToEnglish($value);
            }
        }

        return $data;
    }
}
