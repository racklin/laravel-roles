<?php

namespace Helldar\Roles\Http\Middleware;

use Closure;
use Helldar\Roles\Exceptions\PermissionAccessIsDeniedException;

class Permissions
{
    /**
     * Checks the entry of all of the specified permissions.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string ...$permissions
     *
     * @throws \Helldar\Roles\Exceptions\PermissionAccessIsDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        foreach ($permissions as $permission) {
            if (!$request->user()->hasPermission($permission)) {
                throw new PermissionAccessIsDeniedException;
            }
        }

        return $next($request);
    }
}
