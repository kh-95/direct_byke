<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class autoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route()->getName();
        $permission = Permission::whereRaw("FIND_IN_SET('$route',routes)")->where('guard_name','web')->first();
        if($permission)
        {
            if(!auth('web')->user()->hasPermissionTo($permission) && !auth('web')->user()->hasRole('Super Admin'))
            {
                abort(403);
            }
        }
        return $next($request);
    }
}
