<?php

namespace App\Http\Middleware;

use Closure;
use App\Investor;
use Illuminate\Support\Facades\Auth;

class twoFa
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
        $investor_id = Auth::user()->investor_id; //gets authenticated user id
        $investor = Investor::where('investor_id',$investor_id); //finds user in db
        if ($investor->count())
        {
            if ($investor->pluck('twoFA')->first() === 1)
            {
                if ($investor->pluck('twoFA_verified')->first() != 1) 
                {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Page cannot be accessed without 2FA confirmation');
                }
            }
        }
       


        return $next($request);
    }
}
