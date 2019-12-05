<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Kin;
use App\Country;
use App\BankDetail;
use App\Relationship;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorProfileController extends Controller
{
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    public function index (GlobalMethods $globalMethods)
    {
        if (!Auth::check()) 
        {
            return redirect()->back();
        }
        return view('v1.views.investor_dashboard.home')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle());
    }

    public function info (GlobalMethods $globalMethods)
    {
        $banks              = $globalMethods::Banks();
        $relationship       = Relationship::where('active', 1)->get();
        $country            = Auth::user()->country;
        $country_prefix     = $globalMethods->getCountryPrefix($country);
        $investor_id        = $this->investorID();

        // return $investor_id;
        $kin_info           = Kin::where('investor_id', $investor_id)->first(); 
        $bank_info          = BankDetail::where('investor_id', $investor_id)->get()->first();
        $bank_name          = ($bank_info === Null ? '' : $globalMethods->getBank($bank_info->bank_id));
        $kin_country_prefix = ($kin_info === Null ? '' : $globalMethods->getCountryPrefix($kin_info->country));
        $countries          = $globalMethods->getCountries();
        return view('v1.views.investor_dashboard.profile.info')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('country_prefix', $country_prefix)
                    ->with('kin_country_prefix', $kin_country_prefix)
                    ->with('kin_info', $kin_info)
                    ->with('bank_name', $bank_name)
                    ->with('countries', $countries)
                    ->with('bank_info', $bank_info)
                    ->with('banks', $banks)
                    ->with('relationships', $relationship);
    }

    public function getAddPersonal (GlobalMethods $globalMethods)
    {
        $countries = $globalMethods->getCountries();
        return view('v1.views.investor_dashboard.profile.addPersonal')
        ->with('progress', $globalMethods->progressBarColor())
        ->with('width', $globalMethods->progressBarWidth())
        ->with('title', $globalMethods->progressBarTitle())
        ->with('countries', $countries);
    }

    public function postAddPersonal (Request $request,GlobalMethods $globalMethods)
    {
        //post function for adding personal information
        $validator = $this->validate($request, [
            'firstName' => 'required|alpha|max:15',
            'lastName'  => 'required|alpha|max:15',
            'addresss'   => 'required|max:150',
            'state'     => 'required|alpha|max:45',
            'city'      => 'required|alpha|max:45'
        ]);

        $investor_id = $this->investorID(); //gets investor_id
        $add_info = Investor::where('investor_id','=',$investor_id);
        $add_record = [
            'first_name' => strtolower($request->firstName),
            'last_name'  => strtolower($request->lastName),
            'address'    => strtolower($request->addresss),
            'state'      => strtolower($request->state),
            'city'       => strtolower($request->city)
        ];

        $add_info->update($add_record);
        if (!empty($add_info)) 
        {
            $notification = 'Personal information has been updated successfully!';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            if($request->ajax()){
                return response()->json(['success'=>'Personal information updated successfully!']);
            }
            return redirect()->route('addKin');
        }   
    }
    //end//

    public function getAddBank (Request $request, GlobalMethods $globalMethods)
    {
        $investor_id = $this->investorID();
        $bank        = $globalMethods->getBanks();
        $bank_id     = $globalMethods->getBankIDs();
        $bank_detail = BankDetail::where('investor_id', $investor_id)->get()->first();
        return view('v1.views.investor_dashboard.profile.addBank')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('bank_detail', $bank_detail)                    
                    ->with('bank', $bank)
                    ->with('bank_id', $bank_id);
    }

    public function postAddBank (Request $request, GlobalMethods $globalMethods)
    {
        //post function for adding bank information
        $validate = $this->validate($request, [
            'acc_name'   => 'required|max:45|regex:/^[\pL\s\-]+$/u',
            'acc_number' => 'required|digits:10',
            'bank'       => 'required',
        ]);

        $check = BankDetail::where('investor_id', $this->investorID())->first();
        if ($check)
        {
            if($request->ajax())
            {
                $new_bank = [
                    'bank_id'     => $request->bank,
                    'investor_id' => $this->investorID(),
                    'acc_name'    => \Crypt::encrypt(strtolower($request->acc_name)),
                    'acc_number'  => \Crypt::encrypt($request->acc_number)
                ];
                $check->update($new_bank);
                
                if (!empty($check))
                {
                    $notification = 'Bank information has been updated successfully!';
                    $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                    $message = 'Bank information has been updated successfully!';
                    return response()->json(['message'=>$message]);
                }
                else{
                    $message = 'An error has occured. Kindly try again later!';
                    return response()->json(['message'=>$message]);
                }

            }else{
                $new_bank = [
                    'bank_id'     => $request->bank,
                    'investor_id' => $this->investorID(),
                    'acc_name'    => \Crypt::encrypt(strtolower($request->acc_name)),
                    'acc_number'  => \Crypt::encrypt($request->acc_number)
                ];
                $check->update($new_bank);
                
                if (!empty($check))
                {
                    $notification = 'Bank information has been updated successfully!';
                    $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                    $message = 'Bank information has been updated successfully!';
                    return redirect()->back()->with('status', $message);
                }
                else{
                    $message = 'An error has occured. Kindly try again later!';
                    return redirect()->back()->with('status', $message);
                }
            }
            return redirect()->route('addBank')->with(['error'=> 'Bank information already supplied']);
        }
        $bank_detail = new BankDetail([
            'bank_id'     => $request->bank,
            'investor_id' => $this->investorID(),
            'acc_name'    => \Crypt::encrypt(strtolower($request->acc_name)),
            'acc_number'  => \Crypt::encrypt($request->acc_number)
        ]);

        $save_record = $bank_detail->save();
        if ($save_record)
        {
            $notification = 'Your bank details has been saved successfully!';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            
            if ($request->ajax())
            {
                $message = 'The bank information you supplied has been saved successfully!';
                return response()->json(['message'=>$message]);
            }
            else
            {
                $title = 'Update Report';
                $body  = "The information you supplied has been saved successfully.";
                return redirect()->route('addBank')
                    ->with('title', $title)
                    ->with('body', $body);
            }
        }
    }

    public function getAddKin (GlobalMethods $globalMethods)
    {
        $investor_id   = $this->investorID();
        $relationship  = Relationship::where('active', 1)->get();
        $kin_info      = Kin::where('investor_id', $investor_id)->first();
        $countries     = $globalMethods->getCountries();
        return view('v1.views.investor_dashboard.profile.addKin')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('countries', $countries)
                    ->with('kin_info', $kin_info)
                    ->with('relationships', $relationship);
    }

    public function postAddKin (Request $request,GlobalMethods $globalMethods)
    {
        
            //post function for adding Kin information
            $validate = $this->validate($request, [
                'fullName' => 'required|regex:/^[\pL\s\-]+$/u|max:45|regex:/^[\pL\s\-]+$/u',
                'email'    => 'required|email|max:150|unique:kins',
                'phone'    => 'required|digits:10|unique:kins',
                'addressed' => 'required|max:150',
                'country'  => 'required|max:45|alpha',
                'relation' => 'required|digits:1',
            ]);

                $investor_id = Auth::user()->investor_id;
                $kin_row     = Kin::where('investor_id', $investor_id)->get()->first();
                
                if (empty($kin_row))  //checking if kin already exist
                {
                    $kin = Kin::create([
                        'kin_id'       => bcrypt(uniqid()),
                        'investor_id'  => $investor_id,
                        'full_name'    => $request->fullName,
                        'email'        => $request->email,
                        'phone'        => $request->phone,
                        'address'      => $request->addressed,
                        'country'      => $request->country,
                        'relationship' => $request->relation
                    ]);
                    
                    $kin->save(); //save kin information
                    if (!empty($kin)) {
                        $notification = 'Next of Kin information has been updated successfully!';
                        $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                        if ($request->ajax()) {
                            $message = 'Next of kin information  has been updated successfully';
                            return response()->json(['message'=>$message]);
                        }else{
                            return redirect()->route('addBank');
                        }
                    }
                }
                else
                {
                    $kin = [
                        'full_name'    => $request->fullName,
                        'email'        => $request->email,
                        'phone'        => $request->phone,
                        'address'      => $request->addressed,
                        'country'      => $request->country,
                        'relationship' => $request->relation
                    ];
                    $kin_row->update($kin);
                    if(!empty($kin_row))
                    {
                        $notification = 'Next of Kin information updated successfully!';
                        $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                        if ($request->ajax()) {
                            $message = 'Next of kin information updated successfully';
                            return response()->json(['message'=>$message]);
                        }else{
                            return redirect()->back();
                        }
                    }
                }
    }

    public function getSettings (GlobalMethods $globalMethods)
    {
        return view('v1.views.investor_dashboard.profile.settings')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle());
    }

    public function postSettings (Request $request, GlobalMethods $globalMethods)
    {
        $validate = $this->validate($request, [
            'password' => 'required|min:6|max:30|confirmed',
            'password_confirmation' => 'required|min:6|max:30'
        ]);

        if ($validate) 
        {   
            $investor_id = $this -> investorID();
            $password = bcrypt($request->password);
            $investor = Investor::where('investor_id', $investor_id);
            $add_record = [
                'password' => $password
            ];

            $password_update = $investor->update($add_record);
            
            if ($password_update)
            {
                $investor_email = $investor->pluck('email')->first();
                $date  = $investor->pluck('updated_at')->first();
                $data = [
                    'name'  => 'Site Name',
                    'body'  => "Congratulation! you have successfully changed your password.\nEnsure to keep your password safe and secure.\nRemember! none of our staff would request for your password no matter the issue.\n\nBest regard!",
                    'email' => $investor_email,
                    'date'  => $date,
                ];
                Mail::send('v1.email.mail', $data, function($message) use ($investor_email) {
                    $message->subject('Password Changed')
                            ->to($investor_email);
                $message->from('skillzy101@gmail.com', 'Site Name');
                });
                $notification = 'Password has been changed successfully. Kindly ensure you do not disclose your password to any third party!';
                $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);

                if ($request->ajax())
                {
                    $message = 'Your password has been changed successfully';
                    return response()->json(['message'=>$message]);
                }
                else
                {    
                    return redirect()->route('settings')->with('status', 'Your password has been changed successfully');
                }
            }

        }
    }

    public function postSettingsTwoFA (Request $request, GlobalMethods $globalMethods)
    {
        $twoFA    = Auth::user()->twoFA;
        $investor = Investor::where('email', Auth::user()->email);
        if ($twoFA === 1)
        {
            $new_fa = [
                'twoFA' => 0,
            ];
            $investor->update($new_fa);
            $notification = 'You have successfully disabled 2FA for your account. Kindly note that this would make your account vulnerable.';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            
            if ($request->ajax())
            {
                $message = '2FA security has been successfully disabled for this account.';
                return response()->json(['disabled'=>$message]);
            }
            else
            {
                return redirect()->route('settings')->with('status', "2FA security has been successfully disabled for this account.");
            }
        }
        $new_fa = [
            'twoFA' => 1,
        ];
        $investor->update($new_fa);
        $notification = 'You have successfully enabled 2FA for your account. This increases the security measures on your account';
        $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
        
        if ($request->ajax()) 
        {
            $message = '2FA security has been successfully enabled for this account';
            return response()->json(['enabled'=>$message]);
        }
        else
        {
            return redirect()->route('settings')->with('status', '2FA security has been successfully enabled for this account');
        }

    }

    public function getDisabledAccount ()
    {
        $investor = Investor::where('email', Auth::user()->email)->first();
        $new_active = [
            'active' => 0,
        ];
        $update_progress = $investor->update($new_active);
        if ($update_progress) //checking if update was successfull//
        {
            $status = "Your account has been successfully disabled";
            return $this->getLogout($status);
        }
    }

    public function getLogout ($status = Null) 
    {
        if (isset(Auth::user()->investor_id) && !empty(Auth::user()->investor_id))
        {
            if (Auth::user()->twoFA === 1 && Auth::user()->twoFA_verified === 1) {
                $investor = Investor::where('investor_id', Auth::user()->investor_id);
                if ($investor->count()) 
                {
                    $new_record = [
                        'twoFA_verified' => 0,
                        'token'          => '',
                    ];
                    $update_progress = $investor->update($new_record);
                }
            }
            $inner_status = 'You\'ve been successfully logged out';
            $message = (isset($status) && !empty($status) ? $status : $inner_status);
            Auth::logout();
            return redirect()->route('login')->with('status', $message);
        }
        return redirect()->route('login');
    }
}
