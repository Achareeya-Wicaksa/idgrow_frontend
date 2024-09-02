<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('access_token');
        if ($token) {
            $request->headers->set('Authorization', 'Bearer ' . $token);
        } else {
            // Debug jika token tidak tersedia
            logger()->error('Access token not found in session.');
        }

        return $next($request);
    }
}