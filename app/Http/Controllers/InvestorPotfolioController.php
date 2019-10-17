<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Kin;
use App\Country;
use App\BankDetail;
use App\Order;
use App\Transaction;
use App\PropertyUpload;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorPotfolioController extends Controller
{
    //gets user id//
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    //end

    //method gets all investors investments//
    public function getAllInvestment (GlobalMethods $globalMethods)
    {
        $order  = Order::where('investor_id', Auth::user()->investor_id)->where('filled', 1)->orderBy('id', 'desc')->paginate(6);
        return view('v1.views.investor_dashboard.potfolio.all')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('orders', $order)
                    ->with('title', $globalMethods->progressBarTitle());
    }
    //end//

    //method gets the current active investment//
    public function getActiveInvestment (GlobalMethods $globalMethods)
    {
        $order       = Order::where('investor_id', Auth::user()->investor_id)->where('filled', 1)->orderBy('id', 'desc')->paginate(1);
        if(!$order->isEmpty()){
            $transaction = Transaction::where('investor_id', Auth::user()->investor_id)->where('order_id', $order->pluck('id'))->limit(5)->get();
        }
        else
        {
            $transaction = 0;
        }
        return view('v1.views.investor_dashboard.potfolio.active')  
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('orders', $order)
                    ->with('transactions', $transaction);
    }
    //end//

    // method searches for specific investment
    public function getInvestmentSearch (Request $request,GlobalMethods $globalMethods)
    {
        $validator = $this->validate($request,[
            'search' => 'required'
        ]);

        $property  = PropertyUpload::where('title', 'LIKE', '%'.$request->search.'%')->get();

        //checking if specified search exist
        if (!$property->isEmpty())
        {
            $investment = $property->pluck('investment');
            foreach ($investment as $investments)
            {
                $order = Order::where('investment_id', $investments->id)->where('investor_id', Auth::user()->investor_id)->paginate(6);
            // checking if the user has such an investment
                if (!$order->isEmpty()) {
                    return view('v1.views.investor_dashboard.potfolio.all')
                        ->with('progress', $globalMethods->progressBarColor())
                        ->with('width', $globalMethods->progressBarWidth())
                        ->with('orders', $order)
                        ->with('title', $globalMethods->progressBarTitle());
                }
                else
                {
                    //property which specified keywords don't exit
                    $message = 'No property with the supplied name exist on your potfolio';
                    return redirect()->route('all')->with('status', $message);
                }
                // end//
            }
        }
        else
        {
            //property which specified keywords don't exit
            $message = 'No property with the supplied name exist on your potfolio';
            return redirect()->route('all')->with('status', $message);
        }
        // end//
    }
    // end//
}
