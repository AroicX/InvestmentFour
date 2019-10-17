<?php

namespace App\HttP\Controllers;

use Illuminate\Http\Request; 
use App\PropertyUpload;
use App\Investment;
use App\VisitorContactMessage;
use App\Blog;

class HomePagesController extends Controller 
{
    public function getHome()
    {
        $investment_id = Investment::where('active', 1)->pluck('property_upload_id');
        $property      = PropertyUpload::find($investment_id);
        return view('v1.views.home.home')
                    ->with('property', $property);
    }

    public function getOffers()
    {
        return view('v1.views.home.offers');
    }

    public function getAbout()
    {
        return view('v1.views.home.about');
    }

    public function getContact()
    {
        return view('v1.views.home.contact');
    }

    // method post contact page form
    public function postContactMessage (Request $request)
    {
        $validator = $this->validate($request, [
            'email'   => 'required|email',
            'name'    => 'required|regex:/^[\pL\s\-]+$/u|max:45|regex:/^[\pL\s\-]+$/u',
            'phone'   => 'required|digits:11',
            'message' => 'required'
        ]);

        $contactMessage = VisitorContactMessage::create([
            'email'   => strtolower($request->email),
            'name'    => strtolower($request->name),
            'phone'   => $request->phone,
            'message' => $request->message
        ]);

        $contactMessage->save();
        // checking if message was saved
        if ($contactMessage)
        {
            $message = 'Your message has been sent successfully.';
            // checking if request is ajax
            if ($request->ajax())
            {
                return response()->json(['successBag'=>$message]);
            }
            else
            {
                return redirect()->route('contact')->with('successBag', $message);
            }
            // end //
        }
        else
        {
            $message = 'An error has occured. Kindly try again later';
             // checking if request is ajax
             if ($request->ajax())
             {
                 return response()->json(['errorBag'=>$message]);
             }
             else
             {
                 return redirect()->route('contact')->with('errorBag', $message);
             }
             // end //
        }
        // end//

    }
    // end //

    public function getPress()
    {
        $status = 1;
        $lead_post = Blog::where('lead_post', $status)->where('active', $status)->orderBy('id', 'desc')->limit(1)->get();
        return view('v1.views.home.press')
                    ->with('blogs', $lead_post);
    }

    public function getAffiliation()
    {
        return view('v1.views.home.affiliation');
    }

    public function getCareer()
    {
        return view('v1.views.home.career');
    }

}