<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkLogin
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
        if (Auth::guard('home')->check()) {
            if(Auth::guard('home')->user()->status != '1') {
                $home_page = $this->get_host();
                return response()->view('error.status_off', compact("home_page"));
            }
            return $next($request);

        }else {
            $home_page = $this->get_host();
            return response()->view('error.notLogin', compact("home_page"));
        }

    }

    function get_host(){
        $scheme = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $url = $scheme.$_SERVER['HTTP_HOST'];
        return $url;
    }
}
   