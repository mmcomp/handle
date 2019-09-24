<?php

namespace App\Http\Middleware;

use Closure;

class CanViewMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = $request->getPathInfo();
        $user = $request->user();
        $user->load('group.details');
        $isAdmin = false;
        $pathes = [];
        foreach($user->group->details as $detail) {
            if($detail->path=='all') {
                $isAdmin = true;
            }
            $pathes[] = $detail->path;
        }
        if($isAdmin) {
            dump('admin : ' . $path);
            return $next($request);
        }
        if(in_array($path, $pathes)) {
            dump('granted : ' . $path);
            return $next($request);
        }
        dump('rejected : ' . $path);
        if(count($pathes)>0) {
            return redirect($pathes[0]);
        }
        return redirect('/login');
    }
}
