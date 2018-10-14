<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Profile;
use Illuminate\Support\Facades\Route;
class Steps
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
        $route_name = Route::currentRouteName();
        $profile_exists = Profile::where('user_id', Auth::id())->exists();

        //step 1
        if($route_name != 'frontend.getStepOne' && !$profile_exists){
            return redirect(route('frontend.getStepOne'));
        }

        if($route_name == 'frontend.getStepOne' && $profile_exists){
            return redirect(route('frontend.home'));
        }

        return $next($request);
    }
}
