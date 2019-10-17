<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Kin;
use App\Country;
use App\Bank;
use App\BankDetail;
use App\WishList;
use App\UserNotification;
use App\Relationship;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlobalMethods extends Controller
{
    private function investorID () //method gets current investorID
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }

    public function sendNotification ($investor_id, $message) //method sends notification to user
    {
        $notify = new UserNotification();
        $notify->investor_id = $investor_id;
        $notify->data= $message;
        $notify->save();
    }
    //end//

    public static function sendNotifications ($investor_id, $message) //method sends notification to user
    {
        $notify = new UserNotification();
        $notify->investor_id = $investor_id;
        $notify->data= $message;
        $notify->save();
    }
    //end//

    public function getCountryPrefix ($value) //method gets country prefixes based on country
    {
        $country_prefix = Country::where('country', $value)->pluck('code')->first();
        return $country_prefix;
    }

    public function getCountryPrefixes () //method gets all country prefix/code
    {
        $country_prefix = Country::all()->pluck('code');
        return $country_prefix;
    }

    public function getCountries () //method gets all contries
    {
        $country = Country::all()->pluck('country');
        return $country;
    }

    public function getCountry ($value) //method gets country based on prefix/code
    {
        $country = Country::where('code', $value)->pluck('country')->first();
        return ($country);
    }

    public function getAbbrevs () //method gets all country abbrev 
    {
        $abbrev = Country::all()->pluck('abbrev');
        return $abbrev;
    }

    public function getAbbrev ($value) //method gets gets abbrev based on country supplied
    {
        $abbrev = Country::where('country', $value)->pluck('abbrev')->first();
        return $abbrev;
    }

    public function getBanks () //method gets all available and active banks
    {
        $bank = Bank::where('active', 1)->pluck('bank');
        return $bank;
    }

    public static function Banks ()
    {
        $bank = Bank::where('active', 1)->get();
        return $bank;
    }

    public function getBank ($value) //method gets bank by ID
    {
        $bank = Bank::where('bank_id', $value)->pluck('bank')->first();
        return $bank;
    }

    public static function getStaticBank ($value) //method gets bank by ID
    {
        $bank = Bank::where('bank_id', $value)->pluck('bank')->first();
        return $bank;
    }

    public function getBankIDs () //method get all the banks id
    {
        $bank_id = Bank::all()->pluck('bank_id');
        return $bank_id;
    }

    public function getBankID ($value) //method gets bank id based on the bank supplied
    {
        $bank_id = Bank::where('bank', $value)->pluck('bank_id')->first();
        return $bank_id;
    }

    public function progressBarColor () //method determines progress-bar bg-color
    {
        $investor = Investor::where('investor_id', $this->investorID())->first();
        $kin      = Kin::where('investor_id', $this->investorID())->first();
        $bank     = BankDetail::where('investor_id', $this->investorID())->first();
        //checking if investor information not supplied//
        if ($investor->first_name == Null && $investor->last_name == Null && $investor->address == Null && $investor->state == Null && $investor->city == Null)
        {
            return 'progressbar-bgdanger';
        }
        //checking all information are supplied//
        else if ($investor->first_name != Null && $investor->last_name != Null && $investor->address != Null && $investor->state != Null && $investor->city != Null && $kin != Null && $bank != Null) 
        {
            return 'bgsuccess';
        }
        //checking if investor information supplied but kin not supplied//
        else if ($kin == Null)
        {
            return 'progressbar-bgwarning';
        }
        //checking if kin supplied but bank not supplied
        else if ($bank == Null)
        {
            return 'progressbar-bgwarning';
        }
    }

    public function progressBarTitle () //method determines progress-bar title
    {
        $investor = Investor::where('investor_id', $this->investorID())->first();
        $kin      = Kin::where('investor_id', $this->investorID())->first();
        $bank     = BankDetail::where('investor_id', $this->investorID())->first();
        //checking if investor information not supplied//
        if ($investor->first_name == Null && $investor->last_name == Null && $investor->address == Null && $investor->state == Null && $investor->city == Null)
        {
            return 'Update 10%';
        }
        //checking all information are supplied//
        else if ($investor->first_name != Null && $investor->last_name != Null && $investor->address != Null && $investor->state != Null && $investor->city != Null && $kin != Null && $bank != Null) 
        {
            return "Update 100%";
        }
        //checking if investor information supplied but kin not supplied//
        else if ($kin == Null)
        {
            return 'Update 40%';
        }
        //checking if kin supplied but bank not supplied
        else if ($bank == Null)
        {
            return 'Update 70%';
        }
    }

    public function progressBarWidth () //method determines progress-bar width
    {
        $investor = Investor::where('investor_id', $this->investorID())->first();
        $kin      = Kin::where('investor_id', $this->investorID())->first();
        $bank     = BankDetail::where('investor_id', $this->investorID())->first();
        //checking if investor information not supplied//
        if ($investor->first_name == Null && $investor->last_name == Null && $investor->address == Null && $investor->state == Null && $investor->city == Null)
        {
            return 'noinvestor';
        }
        //checking all information are supplied//
        else if ($investor->first_name != Null && $investor->last_name != Null && $investor->address != Null && $investor->state != Null && $investor->city != Null && $kin != Null && $bank != Null) 
        {
            return 'full';
        }
        //checking if investor information supplied but kin not supplied//
        else if ($kin == Null)
        {
            return 'nokin';
        }
        //checking if kin supplied but bank not supplied
        else if ($bank == Null)
        {
            return 'nobank';
        }
    }

    public static function getWishlistNumber () //method gets number of properties on user wishlist//
    {
        $investor_id   = Auth::user()->investor_id;
        $wishList      = WishList::where('investor_id', $investor_id);
        $wishListCount = count($wishList->pluck('id'));
        return $wishListCount;
    }

    public static function remove_format($text) //method removes number format
    { 
        $text = str_replace(",", "", $text);
        return doubleval($text);
    }

    public static function sum($val1, $val2) //method sums two numbers
    {
        return $val1 + $val2;
    }

    public static function sumThree($val1, $val2, $val3)
    {
        return $val1+$val2+$val3;
    }

    public static function product($val1, $val2) //method multiplies two numbers
    {
        return $val1 * $val2;
    }

    public static function checkWishlist ($token) //checks if investment already exist in user wishlist//
    {
        $investor_id    = Auth::user()->investor_id;
        $investment_id  = \Crypt::decrypt($token);
        $check_wishlist = WishList::where(
            ['investment_id'=>$investment_id],
            ['investor_id'=>$investor_id]
        );

        if ($check_wishlist->count())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function avail_slots_progressBar ($avail_slots, $slots) //method fills investment progress bar based on the slots remaining
    {
        if (($avail_slots/$slots) * 100 <= 5) 
        {
            return 'x95-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 10)
        {
            return 'x90-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 15)
        {
            return 'x85-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 20)
        {
            return 'x80-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 25)
        {
            return 'x75-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 30)
        {
            return 'x70-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 35)
        {
            return 'x65-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 40)
        {
            return 'x60-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 45)
        {
            return 'x55-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 50)
        {
            return 'x50-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 55)
        {
            return 'x45-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 60)
        {
            return 'x40-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 65)
        {
            return 'x35-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 70)
        {
            return 'x30-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 75)
        {
            return 'x25-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 80)
        {
            return 'x20-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 85)
        {
            return 'x15-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 90)
        {
            return 'x10-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 95)
        {
            return 'x5-fill';
        }
        else if (($avail_slots/$slots) * 100 <= 100)
        {
            return 'x3-fill';
        }
    }

    //method supplies all relationship 
    public static function relationships ()
    {
        $relations = relationship::where('active', 1)->get();
        return $relations;
    }
    //end//

    //method gets a relationship type based on supplied id
    public static function getRelationship ($id)
    {
        $relationship = Relationship::where('id', $id)->where('active', 1)->get()->first();
        return $relationship->type;
    }
    //end//

    // method gets gets investments status message
    public static function getInvestmentStatus ($id)
    {
        $message;
        if ($id == 0)
        {
            //set status msg//
            $message = '<i class="fas fa-toggle-off"></i> In active';
        }
        else if ($id == 1)
        {
            //set status mg//
            $message = '<i class="fas fa-toggle-on"></i> Running';
        }
        else if ($id == 2)
        {
            //set status msg//
            $message = '<i class="fas fa-check-circle"></i> Completed';
        }
        else if ($id === 3)
        {
            //set status msg//
            $message = '<i class="fas fa-times-circle"></i> Cancelled';
        }
        else
        {
            //set status msg//
            $message= '<i class="fa fa-times-circle"></i> Error';
        }
        return $message;
    }
    // end //

    public static function getInvestmentStatusColor ($id)
    {
        $color;
        if ($id == 0)
        {
            //set status color 4 in-active//
            $color = 'maroon';
        }
        else if ($id == 1)
        {
            //set status color 4 running//
            $color = 'yellow-2';
        }
        else if ($id == 2)
        {
            //set status color 4 completed//
            $color = 'green-2';
        }
        else if ($id === 3)
        {
            //set status color 4 cancelled//
            $color = 'maroon-2';
        }
        else
        {
            //set status color 4 an error
            $color = 'grey-light';
        }
        return $color;
    }
    // end //

    // method checks if personal info, bank info and kin info are filled
    public static function verified ()
    {
        $auth_investor = Investor::where('investor_id', Auth::user()->investor_id)->get();
        $auth_kin      = Kin::where('investor_id', Auth::user()->investor_id)->get();
        $auth_bank     = BankDetail::where('investor_id', Auth::user()->investor_id)->get();

        if($auth_investor->pluck('first_name')->isEmpty() || $auth_investor->pluck('last_name')->isEmpty() || $auth_investor->pluck('state')->isEmpty() || $auth_investor->pluck('city')->isEmpty() || $auth_investor->pluck('address')->isEmpty() || $auth_bank->isEmpty() || $auth_kin->isEmpty())
        {
            return false;
        }
        else
        {
            return true;
        }
        
    }
    // end //

    // method makes navbar icon badges justified on all pages
    public static function fixWishlistBadge () //for wishlist
    {
        if (\Route::current()->getName() == 'offerInvest' || \Route::current()->getName() == 'ticket' || \Route::current()->getName() == 'ticketResponse' || \Route::current()->getName() == 'readResponse' || \Route::current()->getName() == 'info' || \Route::current()->getName() == 'settings')
        {
            $css = 'margin-top:20%; margin-left:25%';
            return $css;
        }else{
            $css = 'margin-top:-1%; margin-left:25%';
            return $css;

        }
    }

    public static function fixNotificationBadge () //for notification
    {
        if (\Route::current()->getName() == 'offerInvest' || \Route::current()->getName() == 'ticket' || \Route::current()->getName() == 'ticketResponse' || \Route::current()->getName() == 'readResponse' || \Route::current()->getName() == 'info' || \Route::current()->getName() == 'settings')
        {
            $css = 'margin-top:3%; margin-left:25%';
            return $css;
        }else{
            $css = 'margin-top:-15%; margin-left:25%';
            return $css;

        }
    }
    // end //

    // mehtod calculated estimated reading time
    public static function readTime($content)
    {
    $words = str_word_count(strip_tags($content));
    $min = floor($words / 200);
    $sec = floor($words % 200 / (200 / 60));
    $est = $min . ' min' . ($min == 1 ? '' : 's') . ', ' . $sec . ' sec' . ($sec == 1 ? '' : 's');
    return $est;
    }
    // end //
}

