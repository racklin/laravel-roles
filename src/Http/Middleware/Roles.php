<?php

namespace Helldar\Roles\Http\Middleware;

use Closure;
use Helldar\Roles\Exceptions\RoleAccessIsDeniedException;
use Helldar\Roles\Traits\RootAccess;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Roles
{
    use RootAccess;

    /**
     * Checks the entry of all of the specified roles.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string ...$roles
     *
     * @throws \Helldar\Roles\Exceptions\RoleAccessIsDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            throw new AccessDeniedHttpException('User is not authorized', null, 403);
        }

        if ($this->isRoot($request)) {
            return $next($request);
        }

        if (!$request->user()->hasRoles($roles)) {
            throw new RoleAccessIsDeniedException;
        }

        return $next($request);
    }
}
