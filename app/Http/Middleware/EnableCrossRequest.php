<?php

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allow_origin = config('cros.allowed_origins');
        if (in_array($origin, $allow_origin)) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', implode( ',', config('cros.allowed_headers') ));
            $response->header('Access-Control-Expose-Headers', implode( ',',config('cros.exposed_headers')));
            $response->header('Access-Control-Allow-Methods', implode( ',',config('cros.allowed_methods')));
            $response->header('Access-Control-Allow-Credentials', config('cros.supports_credentials'));
        }
        return $response;
    }
}
