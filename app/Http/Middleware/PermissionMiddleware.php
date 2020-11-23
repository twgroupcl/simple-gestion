<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (! $request->user()->can($permission)) {
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permisos para realizar esta accion',
            ], 403);
        }
        
        return $next($request);
    }
}
