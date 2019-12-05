<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuth
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
        $administrator_id = Auth::user()->id; //gets authenticated user id
        $administrator = Administrator::where('id',$administrator_id); //finds user in db
        if ($administrator->count())
        {
            if ($administrator->pluck('twoFA')->first() === 1)
            {
                if ($administrator->pluck('twoFA_verified')->first() != 1) 
                {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Page cannot be accessed without 2FA confirmation');
                }
            }
        }
       


        return $next($request);
    }
}
