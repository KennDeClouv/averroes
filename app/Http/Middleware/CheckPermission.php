<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user()->getPermissionCodes();
        if (!$user->contains($permission)) {
            abort(403, 'Unauthorized');
        }
        // if ($user->Role->code == 'super_admin') {
        //     return $next($request);
        // }
        return $next($request);
    }
}
