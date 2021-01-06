<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
            // for access control
            if(Auth::user()->roll_as == 'vendor')
            {
                if(Auth::check() && Auth::user()->access)
            {
                $banned = Auth::user()->access == "1";
                Auth::logout();

                if($banned == 1)
                {
                    $message = 'Your account has been banned. Please Contact with administrator!';
                }

                return redirect()->route('login')
                    ->with('status', $message)
                    ->withErrors(['email'=> 'Your account has been banned. Please Contact with administrator!' ]);
            }

            if(Auth::check())
            {
                $expireAt = Carbon::now()->addMinutes(1);
                Cache::put('user-is-online'. Auth::user()->id, true, $expireAt);
            }

            // for simple middleware
            return $next($request);
        }



        else
        {
            return redirect('/home')->with('status','You are not allowed to access Vendor Dashboard');
        }
    }
}