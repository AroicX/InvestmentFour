<?php

namespace App\Http\Controllers;

use App\AboutUs;
use App\Team;
use App\TeamRole;
use App\ContactUs;
use App\SocialHandle;
use Mews\Purifier\Facades\Purifier;


use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct__(){

        $this->middleware('admin');
    }

    public function index()
    {
        $about = AboutUs::where('id', '=', 1)->first();
        $contact = ContactUs::all();
        $team = Team::all();
        $teamroles = TeamRole::all();
        $social = SocialHandle::all();


        // return $about;
        return view('admin.pages.page',compact(
            'about',
            'contact',
            'team',
            'teamroles',
            'social'
        ));
    }

    public function pageAbout(Request $request)
    {
    //    return $request->all();

      

     
       if ($request->image) {    
        $image = $request->file('image');
        $filename = time(). '.' . $image->getClientOriginalExtension();
        
        $dataWithImage = array(
            'summary' =>  Purifier::clean($request->summary),
            'who_we_are' =>  Purifier::clean($request->who_we_are),
            'what_we_do' =>  Purifier::clean($request->what_we_do),
            'our_essence' =>  Purifier::clean($request->our_essence),
            'header_image' => $filename,
        );

            $about = AboutUs::where('id', '=', 1)->update($dataWithImage);


            if($about){
                $image->move('images', $filename);
            }
            $notification = array('message' => 'About Page has been updated ','alert' => 'success' );
            return redirect()->back()->with($notification); 
            
       
        }else{
            $data = array(
                'summary' =>  Purifier::clean($request->summary),
                'who_we_are' =>  Purifier::clean($request->who_we_are),
                'what_we_do' =>  Purifier::clean($request->what_we_do),
                'our_essence' =>  Purifier::clean($request->our_essence),
               
            );

            $about = AboutUs::where('id', '=', 1)->update($data);


            if($about){
                $notification = array('message' => 'About Page has been updated ','alert' => 'success' );
                return redirect()->back()->with($notification); 
            }
     
        }


       
    }

    public function getContactPage($id)
    {
        $contact = ContactUs::where('id', '=', $id)->first();
        
        return view('admin.pages.modal-contact',compact('contact'));
        # code...
    }

    public function ContactPage(Request $request)
    {
        $id = $request->contact;
        $data = array(
            'title' =>  $request->title,
            'content' =>  $request->content
           
        );

        $contact = ContactUs::where('id', '=', $id)->update($data);

        if($contact){
            $notification = array('message' => 'ContactUs Page has been updated... ','alert' => 'info' );
            return redirect()->back()->with($notification); 
        }
    }

    public function getTeamMember($id)
    {
        $roles = TeamRole::all();
        $team = Team::where('id', '=', $id)->first();
        
        return view('admin.pages.modal-team',compact('team','roles'));
    }

    public function TeamMember(Request $request)
    {

        $id = $request->id;
        if ($request->image) {
            $image = $request->file('image');
            $filename = time(). '.' . $image->getClientOriginalExtension();

            $data = array(
                'name' =>  $request->name,
                'image_file' =>  $filename,
                'team_role_id' =>  $request->team_role,
                'position' =>  $request->position,
                'facebook_link' =>  $request->facebook_link,
                'twitter_link' =>  $request->twitter_link,
                'instagram_link' =>  $request->instagram_link,
                'discord_link' =>  $request->discord_link,
               
            );
    
            $team = Team::where('id', '=', $id)->update($data);

            if($team){
                $image->move('images', $filename);
            }
            $notification = array('message' => $request->name.' has been updated ','alert' => 'success' );
            return redirect()->back()->with($notification); 
    

        }else{

            $data = array(
                'name' =>  $request->name,
                'team_role_id' =>  $request->team_role,
                'position' =>  $request->position,
                'facebook_link' =>  $request->facebook_link,
                'twitter_link' =>  $request->twitter_link,
                'instagram_link' =>  $request->instagram_link,
                'discord_link' =>  $request->discord_link,
               
            );
    
            $team = Team::where('id', '=', $id)->update($data);

            if($team){
                $notification = array('message' => $request->name.' has been updated ','alert' => 'success' );
            return redirect()->back()->with($notification); 
            }
           
        }
        
        
    }

}