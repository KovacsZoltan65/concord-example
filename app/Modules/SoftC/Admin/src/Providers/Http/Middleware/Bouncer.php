<?php

namespace SoftC\Admin\Http\Middleware;

use Illuminate\Support\Facades\Route;

class Bouncer
{
    public function handle($request, \Closure $next, $guard = 'user'): mixed
    {
        if (! auth()->guard($guard)->check()) {
            return redirect()->route('admin.session.create');
        }

        if (! (bool) auth()->guard($guard)->user()->status) {
            auth()->guard($guard)->logout();

            session()->flash('error', __('admin::app.errors.401'));

            return redirect()->route('admin.session.create');
        }

        if ($this->isPermissionsEmpty()) {
            auth()->guard($guard)->logout();

            session()->flash('error', __('admin::app.errors.401'));

            return redirect()->route('admin.session.create');
        }

        return $next($request);
    }

    public function isPermissionsEmpty()
    {
        if (! $role = auth()->guard('user')->user()->role) {
            abort(401, 'This action is unauthorized.');
        }

        if ($role->permission_type === 'all') {
            return false;
        }

        if ($role->permission_type !== 'all' && empty($role->permissions)) {
            return true;
        }

        $this->checkIfAuthorized();

        return false;
    }

    public function checkIfAuthorized()
    {
        $roles = acl()->getRoles();

        if (isset($roles[Route::currentRouteName()])) {
            bouncer()->allow($roles[Route::currentRouteName()]);
        }
    }
}