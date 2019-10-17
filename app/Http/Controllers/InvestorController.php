<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Country;
use App\IpLog;
use App\UserNotification;
use Mail; //this adds the mail class
use URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorController extends Controller
{
    public function getActivateAccount ()
    {
        if (session('status')) 
        {
            return view('v1.views.investor_auth.active-account'); 
        }
        else
        {
            return redirect()->route('register');
        }
    }

    public function getLogin()
    {
        if (Auth::check()) 
        {
            return redirect()->route('info');
        }
        return view('v1.views.investor_auth.login');
    }

    public function postLogin(Request $request)
    {
       $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required|between:6,30',
        ]);
        $remember = $request['remember'] ? true : false;
        if (Auth::attempt(['email'=> $request['email'], 'password'=>$request['password'], 'active'=>1]))
        {
           $investor = Investor::where('email', $request->email);
           if ($investor->pluck('twoFA')->first() === 1) //checks if user has 2FA activated
           {
               $token          = str_random(10); //sets a random code to be sent to user email
               $new_token      = [
                   'token'     => $token,
               ];

               $update_progress = $investor->update($new_token);
               if ($update_progress) 
               {
                    $investor_email = $investor->pluck('email')->first(); //gets user email if exists
                    $date           = $investor->pluck('updated_at')->first(); //  gets updated date
                    //sending user 2fa code//
                    $data = [
                        'name'  => 'Site Name',
                        'body'  => "Your 2FA confirmation code is: ".$token."\n\nRegards,\nSite Name\n\nDo you have questions?",
                        'email' => $investor_email,
                        'date'  => $date,
                    ];
    
                    Mail::send('v1.email.mail', $data, function($message) use ($investor_email) {
                                $message->subject('2FA Confirmation Code')
                                        ->to($investor_email);
                        $message->from('skillzy101@gmail.com', 'Site Name');
                    });
    
                    if (!Mail::failures()) //testing if mail was sent successfully//
                    {
                        if ($request->ajax())
                        {
                            $message = 'Kindly check your mail for 2FA confirmation code';
                            return response()->json(['twoFa'=>route('two-fa'), 'message'=>$message]);
                        }
                        else
                        {
                                return redirect()->route('two-fa');
                        }
                    }
                    //   
               }
           }
           $ip_log      = new IpLog(array(
            'investor_id' => $investor->pluck('investor_id')->first(),
            'ip'          => $request->ip(),
            ));

            if ($ip_log->save()) //checking if user login log is saved
            {
                if ($request->ajax())
                {
                    return response()->json(['index'=>route('info')]);
                }
                else
                {
                    return redirect()->route('info');
                }
            }
        }

        if ($request->ajax())    
        {
            $message = 'Invalid credentials supplied or account disabled';
            return response()->json(['message'=>$message]);
        }
        else
        {
            return redirect()->route('login')->with('error', 'Invalid credentials supplied or account disabled')->with('email', $request->email);
        }
    }

    public function getRegister(GlobalMethods $globalMethods)
    {
        $countries      = $globalMethods->getCountries();
        $country_abbrev = $globalMethods-> getAbbrevs();
        $country_prefix = $globalMethods->getCountryPrefixes();
        return view('v1.views.investor_auth.register')
                    ->with('countries', $countries)
                    ->with('country_abbrev', $country_abbrev)
                    ->with('country_prefix', $country_prefix);
    }

    public function postRegister(Request $request, GlobalMethods $globalMethods) 
    {
        $validator = $this->validate($request, [
            'code'                  => 'required|numeric',
            'phone'                 => 'required|digits:10|unique:investors',
            'email'                 => 'required|email|unique:investors',
            'password'              => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required|min:6|max:30|',
            'terms'                 => 'required'
        ]);

        if ($validator) {
             $code = $request->code;
             $investor = new Investor(array(
            'investor_id'=> bcrypt(uniqid()),
            'ip_addr'    => $request->ip(),
            'phone'      => strtolower($request -> get('phone')),
            'email'      => strtolower($request -> get('email')),
            'country'    => $globalMethods->getCountry($code),
            'password'   => bcrypt($request -> get('password')),
            'token' =>   str_random(10),
            ));

            if ($investor -> save())
            {
                //gettting current user who registered
                $user = Investor::where('email', $investor->email)->get()->first();
                $investor_email = $user->email;
                $date = $user->created_at;

                //assigning values to be displayed in user mailbox
                $data = [
                    'name'  => 'Site Name',
                    'body'  => "Thank you for registering on site name.To complete your registration kindly click on the link below as this is to ensure that you intentionally and consciously registered on our platform.\nIf it wasn't you, kindly ignore this message.\n\nRegards,\nSite Name\n\nDo you have questions?",
                    'code'  => route('activate-account', $investor->token),
                    'email' => $investor_email,
                    'date'  => $date,
                ];

                Mail::send('v1.email.mail', $data, function($message) use ($investor_email) {
                            $message->subject('Verify Email')
                                    ->to($investor_email);
                    $message->from('skillzy101@gmail.com', 'Site Name');
                });

                if (!Mail::failures()) //testing if mail was sent successfully//
                {
                    if ($request->ajax())
                    {
                        $message = 'Registration successful! Kindly check your mail';
                        return response()->json(['message'=>$message]);
                    }
                    else
                    {
                        return redirect()->route('register')->with('status', 'Registration successful! Kindly check your mail');
                    }
                }
            }
        }
    } //end postRegister

    public function getCode ($token,GlobalMethods $globalMethods)
    {
        $investor = Investor::where('token', $token)->where('active', 0);
        $investor_id = $investor->pluck('investor_id')->first();
        if ($investor->count()) //checking whether user exists
        {

            //Update investor to active state//
            $update_info = [
                'active' => 1,
                'token'  => ''
            ];

            $update_progress = $investor->update($update_info);
            if ($update_progress) 
            {
                $notification = 'Welcome to site name. <br/> It is great to have you onboard. <br/> Let us know how we can serve you better.';
                $globalMethods->sendNotification($investor_id, $notification);
                return redirect()->route('active-account')
                ->with('status', 'Thank you for verifying your email. Your account has been successfully activated!');
            }

        }
        return redirect()->route('active-account')
                         ->with('sorry', 'Sorry an error occured and we could not verify your account');
    }

    public function getRecoverPassword () //method gets password-recovery page
    {
        return view('v1.views.investor_auth.password-forgot');
    }

    public function postRecoverPassword (Request $request) //method processes password-recovery
    {
        $validate = $this->validate($request, [
            'email' => 'required|email'
        ]);

        if ($validate)
        {
            $investor = Investor::where('email', $request->email);
            if ($investor->count())
            {
                $date  = $investor->pluck('updated_at')->first();
                $token = str_random(10);
                $investor_email = $request->email;
                $new_token = [
                    'password' => bcrypt($token),
                ];
        
                $update_process = $investor->update($new_token);
                if ($update_process)
                {
                   //assigning values to be displayed in user mailbox
                    $data = [
                        'name'  => 'Site Name',
                        'body'  => "Your request to recover your password was successful.\nHere is your temporary password: ".$token."\n\nRegards,\nSite Name\n\nDo you have questions?",
                        'email' => $investor_email,
                        'date'  => $date,
                    ];
        
                    Mail::send('v1.email.mail', $data, function($message) use ($investor_email) {
                                $message->subject('Password Recovery')
                                        ->to($investor_email);
                        $message->from('skillzy101@gmail.com', 'Site Name');
                    });
        
                    if (!Mail::failures()) //testing if mail was sent successfully//
                    {
                        return redirect()->route('password-forgot')->with('status', 'Password recovery was successful! Kindly check email');
                    }
                }
            }
            return redirect()->route('password-forgot')->with('error', 'Account not found. Kindly try again later.');
        }
    }

    public function getTwoFAVerification () //method gets two-fa page
    {
        if (isset(Auth::user()->investor_id) && !empty(Auth::user()->investor_id)) 
        {
            return view('v1.views.investor_auth.two-fa');
        }
        return redirect()->route('login');
    }

    public function postTwoFAVerification (Request $request) //method processes two-fa page request
    {
        $validate = $this->validate($request, [
            'code' => 'required|max:10|min:10',
        ]);

        if ($validate) //checking if validation was successful
        {
            $investor_id = Auth::user()->investor_id;
            $twoFA_code  = $request->code;
            $investor    = Investor::where('investor_id', $investor_id);
            if ($investor->count()) //checking if user exist
            {
                if ($investor->pluck('token')->first() === $twoFA_code) {
                    $new_token = [
                        'token'          => '',
                        'twoFA_verified' => 1,
                    ];
                    $update_progress = $investor->update($new_token);

                    if ($update_progress) //checking if update was successful
                    {
                        $ip_log      = new IpLog(array(
                        'investor_id' => $investor->pluck('investor_id')->first(),
                        'ip'          => $request->ip(),
                        ));
            
                        if ($ip_log->save()) //checking if user login log is saved
                        {
                            return redirect()->route('info');
                        }
                    }
                    return redirect()->route('two-fa')->with('error', 'Validation process interrupted. Please try again later.');
                }
                return redirect()->route('two-fa')->with('error', 'Invalid 2FA confirmation code supplied');
            }
            return redirect()->route('two-fa')->with('error', 'Sorry! we couldn\'t validate 2FA code. Try again later.');
        }

    }
}
