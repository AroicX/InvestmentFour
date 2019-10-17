<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\AboutUs;
use App\SocialHandle;
use App\ContactUs;
use App\Blog;
use App\Team;
use App\TeamRole;

class AppController extends Controller
{
    //method gets the application / site name
    public static function getAppName ()
    {
        $appName = Application::all();
        return $appName->pluck('name')->first();
    }
    // end //

    // --METHODS GETS ABOUT US PAGE TABLE DATA --
 
     // method gets about us page image header name
     public static function getHeaderImageName ()
     {
         $imageName = AboutUs::all();
         return $imageName->pluck('header_image')->first();
     }
     // end //
 
     // method gets about us page summary content
     public static function getSummary ()
     {
         $summary = AboutUs::all();
         return $summary->pluck('summary')->first();
     }
     // end //

    //  method gets about us page who we are content
     public static function getWhoWeAre ()
     {
         $whoWeAre = AboutUs::all();
         return $whoWeAre->pluck('who_we_are')->first();
     }
    // end //

    // method gets about us page what we do content
    public static function getWhatWeDo ()
    {
        $whatWeDo = AboutUs::all();
        return $whatWeDo->pluck('what_we_do')->first();
    }
    // end //

    // method gets about us page our essence 
    public static function getOurEssence ()
    {
        $ourEssence = AboutUs::all();
        return $ourEssence->pluck('our_essence')->first();
    }
    // end //
 
    // --END-- //

    // --METHODS GET APPLICATION / COMAPNY SOCIAL MEDIA HANDLES 
    // method gets comapny facebook page link //
    public static function getFacebookLink ()
    {
        $title        = 'facebook';
        $status        = 1;
        $facebookLink = SocialHandle::where('title', $title)->where('active', $status)->get();
        //checking if facebook page is active
        return (!$facebookLink->isEmpty() ? $facebookLink->pluck('link')->first() : false);
        // end //
    }
    // end //

    //method gets company twitter page link
    public static function getTwitterLink ()
    {
        $title        = 'twitter';
        $status       = 1;
        $twitterLink  = SocialHandle::where('title', $title)->where('active', $status)->get();
        // checking if twitter page is active
        return (!$twitterLink->isEmpty() ? $twitterLink->pluck('link')->first() : false);
        // end //
        
    }
    // end //

    // method gets company discord server link
    public static function getDiscordLink ()
    {
        $title        = 'discord';
        $status       = 1;
        $discordLink  = SocialHandle::where('title', $title)->where('active', $status)->get();
        //  checking if discord server is active
        return (!$discordLink->isEmpty() ? $discordLink->pluck('link')->first() : false);
        // end //
    }
    // end//

    // method gets instagram page link
    public static function getInstagramLink ()
    {
        $title         = 'instagram';
        $status        = 1;
        $instagramLink = SocialHandle::where('title', $title)->where('active', $status)->get();
        // checking if instagram page is active
        return (!$instagramLink->isEmpty() ? $instagramLink->pluck('link')->first() : false);
        // end //
    }
    // end //

    // method gets telegram group link
    public static function getTelegramLink ()
    {
        $title         = 'telegram';
        $status        = 1;
        $telegramLink  = SocialHandle::where('title', $title)->where('active', 1)->get();
        // checking if telegram group is active
        return (!$telegramLink->isEmpty() ? $telegramLink->pluck('link')->first() : false);
        // end //
    }
    // end //
    // --END-- //

    // METHODS GET APPLICATION/COMPANY CONTACT INFORMATION

    // method gets support numbers
    public static function getSupportLine ()
    {
        $title       = 'support';
        $status      = 1;
        $support     = ContactUs::where('title', $title)->where('active', $status)->get();
        // checking if support lines are active
        return (!$support->isEmpty() ? $support->pluck('content') : false);
        // end //
    }
    // end //

    // method gets contact address 
    public static function getContactAddress ()
    {
        $title     = 'address';
        $status    = 1;
        $address   = ContactUs::where('title', $title)->where('active', 1)->get();
        // checking if address is available and active
        return (!$address->isEmpty() ? $address->pluck('content') : false);
        // end //
    }
    // end //

    // END//

    // METHODS GETS APPLICATION / COMPANY BLOGS
    // method gets lead posts 
    public static function getLeadPosts ($id) //id for current active lead post//
    {
        $status = 1;
        $blog   = Blog::where('lead_post', $status)->where('active', $status)->where('id', '!=', $id)->limit(5)->get();
        
        // checking if a post is returned //
        return (!$blog->isEmpty() ? $blog : false);
    }
    // end //
    
    // method gets blog post with the supplied id
    public static function getBlogPost ($id) //id for post to be gotten
    {
        $id        = \Crypt::decrypt($id);
        $status    = 1;
        $blog      = Blog::where('id', $id)->where('active', $status)->get();
        // checking if a post was returned 
        if (!$blog->isEmpty())
        {
            return view('v1.views.home.press-post')->with('blogs', $blog);
        }
        else
        {
            return redirect()->back();
        }
        // end //   
    }
    // end //

    // method gets all blogs aside from the current headline
    public static function getAllBlogPost ($id) //this is the id of the currently active headline
    {
        $id        = \Crypt::decrypt($id);
        $status    = 1;
        $blogPosts = Blog::where('active', $status)->where('id', '!=', $id)->orderBy('id', 'desc')->paginate(6);
        return (!$blogPosts->isEmpty() ? $blogPosts : false);
    }
    // end //

    // method gets last
    public static function getLastPosts ($id) //this is the id for the current blog post
    {
        $id        = \Crypt::decrypt($id);
        $status    = 1;
        $blogPosts = Blog::where('active', $status)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(3)->get();
        return (!$blogPosts->isEmpty() ? $blogPosts : false); //checking if a result if collection is empty//
    }
    // end//
    // END //

    // METHOD GETS APPLICATION / COMAPNY TEAM ROLES
    // method gets all the active team roles
    public static function getTeamRoles ()
    {
        $status = 1; 
        $roles  = TeamRole::where('active', $status)->get();
        return    (!$roles->isEmpty() ? $roles : false);
    }
    // end //
    // END //

    // METHODS GETS APPLICATION / COMPANY TEAM DETAILS
    // method gets all active team members
    public static function getTeamMembers ()
    {
        $status = 1;
        $team   = Team::where('active', $status)->get();
        return (!$team->isEmpty() ? $team : false);
    }
    // end //

    // method gets team members according to their roles
    public static function getTeamAndRole ($role_id)
    {
        $status = 1;
        $team   = Team::where('active', $status)->where('team_role_id', $role_id)->get();
        return (!$team->isEmpty() ? $team : false);
    }
    // end //

    // END //
}
