<?php

namespace App\Http\Controllers;


use App\Investor;
use App\PropertyType;
use App\PropertyRegion;
use App\Investment;
use App\PropertyUpload;
use App\Order;
use App\Range;
use App\Transaction;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorOfferController extends Controller
{
    //method gets active user id
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    //end//

    //method gets the offers page
    public function getOffer (GlobalMethods $globalMethods)
    {
        $price_range = Range::where('active', 1)->get(); //gets all price ranges//
        $region      = PropertyRegion::where('active', 1)->get(); //gets all active regions//
        $value = 1; //initializes active\\
        $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
        })->where('active', 1)->paginate(6); //gets all property that met conditions//
        $property_type = PropertyType::where('active', 1)->get();  //gets property type values//
        

        // return $property;
        return view('v1.views.investor_dashboard.offer.offer')
                    ->with('progress', $globalMethods->progressBarColor()) //returns color for account update progressbar//
                    ->with('width', $globalMethods->progressBarWidth()) //returns width for account update progressbar//
                    ->with('title', $globalMethods->progressBarTitle()) //returns title for account update progressbar//
                    ->with('price_range', $price_range) //returns price ranges for properties for search//
                    ->with('region', $region)  //returns the available regions where properties are available//
                    ->with('property_type', $property_type) //returns the available property types//
                    ->with('properties', $property); //returns all available property//
    }
    //end//

    //method makes search of specific offers
    public function postOfferSearch (Request $request, GlobalMethods $globalMethods) //methods processing specific offer searches
    {
        $price_range = Range::where('active', 1)->get(); //gets all price ranges//
        $region      = PropertyRegion::where('active', 1)->get(); //gets all active regions//
        $property_type = PropertyType::where('active', 1)->get();  //gets property type values//
        $value = 1; //initializes active//
        $flag = false; //initialize error flag//
        $message = '';

        //validating data
        $validate = true;
        
        //checks if only region is not empty
        if ($request->region != "*" && $request->type == "*" && $request->price == "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('property_region', strtolower($request->region))->paginate(6); //gets all property that met conditions//
            
            //checking if search match
            if (strtolower($request->region) != $property->pluck('property_region')->first())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//

        }//end//
        //checking if only type is not empty
        else if ($request->region == "*" && $request->type != "*" && $request->price == "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('property_type', strtolower($request->type))->paginate(6); //gets all property that met conditions//
            
            //checking if search match
            if (strtolower($request->type) != $property->pluck('property_type')->first())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//
        }//end//
        //checking if only price is not empty//
        else if ($request->region == "*" && $request->type == "*" && $request->price != "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('cost', '<=', doubleval($request->price))->paginate(6); //gets all property that met conditions//
            
            //checking if search match
            if (!$property->count())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//
        }//end//
        //checking if type and region not empty
        else if ($request->type != "*" && $request->region != "*" && $request->price == "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('property_type', strtolower($request->type))->where('property_region', strtolower($request->region))->paginate(6); //gets all property that met conditions//

            //checking if search match
            if (!$property->count())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//
        }
        //end//
        //checking if type and price not empty
        else if ($request->type != "*" && $request->region == "*" && $request->price != "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('property_type', strtolower($request->type))->where('cost', '<=', doubleval($request->price))->paginate(6); //gets all property that met conditions//

            //checking if search match
            if (!$property->count())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//
        }
        //end//
        //checking if region and price not empty
        else if ($request->type == "*" && $request->region != "*" && $request->price != "*")
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->where('property_region', strtolower($request->region))->where('cost', '<=', doubleval($request->price))->paginate(6); //gets all property that met conditions//

            //checking if search match
            if (!$property->count())
            {
                $flag = true; //flag error//
                $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                    // Query the name field in investment table
                    $q->where('active', $value);
                })->where('active', 1)->paginate(6);
            }
            //end//
        }
        //end//
        else 
        {
            $property = PropertyUpload::with(['investment'])->whereHas('investment', function($q) use($value) {
                // Query the name field in investment table
                $q->where('active', $value);
            })->where('active', 1)->paginate(6); //gets all property that met conditions//
        }

        //checking if there is an error flag
        if ($flag){
            $message = 'No property was found with your specification(s) !';
            return redirect()->back()->with('status', $message);
        }
        //end//
        return view('v1.views.investor_dashboard.offer.offer')
                    ->with('progress', $globalMethods->progressBarColor()) //returns color for account update progressbar//
                    ->with('width', $globalMethods->progressBarWidth()) //returns width for account update progressbar//
                    ->with('title', $globalMethods->progressBarTitle()) //returns title for account update progressbar//
                    ->with('price_range', $price_range) //returns price ranges for properties for search//
                    ->with('region', $region)  //returns the available regions where properties are available//
                    ->with('property_type', $property_type) //returns the available property types//
                    ->with('properties', $property); //returns all available property//
    }//ends//

    //method gets offers investment page
    public function getOfferInvest ($token)
    {
        $globalMethods = new GlobalMethods();
        $investment_id = \Crypt::decrypt($token);
        $property_id   = Investment::where('id', $investment_id)->pluck('property_upload_id')->first();
        if ($property_id != Null || $property_id != '') //checking if such investment exist//
        {
            $property      = PropertyUpload::find($property_id);
            return view('v1.views.investor_dashboard.offer.offerInvest')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('property', $property);
        }
        return redirect()->back();
    }
    //end//

    //method processing investment request
    public function postOfferInvest (Request $request, GlobalMethods $globalMethods)
    {
       $validate = $this->validate($request, [
           'property_cost'   => 'required|numeric',
           'renovation_cost' => 'required|numeric',
           'management_cost' => 'required|numeric',
           'slot'            => 'required|numeric',
           'payment_option'  => 'required:alpha',
           'investment_id'   => 'required',
           'terms'           => 'required'
       ]);

       if ($validate) //checking if validation was successful//
       {
            $order = Order::create([
                'investor_id'      => Auth::user()->investor_id,
                'investment_id'    => \Crypt::decrypt($request->investment_id),
                'purchased_slot'   => $request->slot,
                'property_cost'    => $request->property_cost,
                'miscellaneous'    => $globalMethods::sum($request->renovation_cost, $request->management_cost),
                'filled'           => 1,
                'payment_gateway'  => strtolower($request->payment_option)
            ]);

            $save_progress = $order->save();
            if ($save_progress) //checking if the order was filled correctly//
            {
                //creating a new transaction for the order
                $transaction_type   = 'property purchase';
                $transaction        = Transaction::create([
                    'investor_id'   => Auth::user()->investor_id,
                    'order_id'      => $order->id,
                    'amount'        => $globalMethods::sum($order->property_cost,$order->miscellaneous),
                    'type'          => $transaction_type,
                    'successful'    => 1
                ]);
                //end//
                $transaction->save(); //saves transaction//
                //checking if transaction was saved//
                if ($transaction)
                {
                    $notification = 'Congratulation! You have successfully purchased '.$order->purchased_slot.' '.($order->purchased_slot > 1 ? 'slots' : 'slot').' of the property '. strtoupper($order->investment->property_upload->title) .'!';
                    $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                    echo $transaction;
                }
                echo 'Wasn\'t saved!';
            }
       }

    }
    //end//

}
