<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $maxAge = 3600): Response
    {
        $response = $next($request);

        // Only cache GET requests
        if ($request->isMethod('GET') && $response->isSuccessful()) {
            // Set cache headers
            $response->header('Cache-Control', "public, max-age={$maxAge}");
            $response->header('Expires', gmdate('D, d M Y H:i:s', time() + $maxAge) . ' GMT');
            
            // Add ETag for validation
            $etag = md5($response->getContent());
            $response->header('ETag', $etag);
            
            // Check if client has cached version
            if ($request->header('If-None-Match') === $etag) {
                return response('', 304); // Not Modified
            }
        }

        return $response;
    }
}
