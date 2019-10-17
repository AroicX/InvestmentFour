<?php

namespace App\Http\Controllers;

use App\Investor;
use App\WishList;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorWishlistController extends Controller
{
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    
    public function wishList (GlobalMethods $globalMethods)
    {
        $wishlist = WishList::where('investor_id', $this->investorID())->orderBy('id', 'desc')->paginate(6);
        return view('v1.views.investor_dashboard.offer.wishList')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('wishlists', $wishlist);
    }

    public function getAddToList ($token,GlobalMethods $globalMethods)
    {
        $investor_id    = $this->investorID();
        $investment_id  = \Crypt::decrypt($token);
        $check_wishlist = WishList::where(
            ['investment_id'=>$investment_id],
            ['investor_id'=>$investor_id]
        );

        if ($check_wishlist->count())
        {
            $notification = 'The selected property has been successfully removed from your wishlist!';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            $check_wishlist->delete();
            return response()->json(['remove'=>'item removed']);
        }
        $wishList = new WishList([
            'investor_id'   => $investor_id,
            'investment_id' => $investment_id
        ]);

        $save_progress = $wishList->save();
        if($save_progress) //checking if record is saved//
        {   
            $notification = 'The selected property has been successfully added to your wishlist!';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            $investment_id = '';
            $message = 'Property successfully added to your wishlist.';
            return response()->json(['message'=>$message]);
        }else{
            
            $message = 'An error has occured and we couldn\'t add property to your wishlist. Kindly try again later.';
            return response()->json(['error'=>$message]);
        }

    }

}