<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Market;
use App\Investor;
use App\Investment;
use App\Order;
use App\Transaction;
use Auth;

class MarketController extends Controller
{

    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    

    public function addToMarket(Request $request)
    {

        $transaction_id = $request->transaction_id;
        $string = $request->order_id;
        $order_id = preg_replace("/[^a-zA-Z0-9\s]/","",$string);


        $getInvestment = Order::where('id','=', $order_id)->first();

        // dd($getInvestment->investment_id);

        $market = new Market;
        $market->investor_id = $this->investorID();
        $market->investment_id = $getInvestment->investment_id;
        $market->transaction_id = $request->transaction_id;
        $market->order_id = $order_id;
        $market->slots = $request->slot;
        $market->price = $request->amount;
        $market->save();



        $message = 'You have successful add  '.$request->slot.' slots to be sold';
        return redirect()->back()->with('success', $message);
    }

    public function showMarket()
    {
       $houses = Market::where('active', '=', 1)->with('Investment','Order','Transaction','Investor')->paginate(20);

       return view('v1.views.investor_dashboard.market.index',compact('houses'));
    //    return response()->json($houses);

    }

    public function buyProperty(Request $request)
    {
        // return $request->all();
        


        $house = Market::where('id', '=', $request->property)->with('Investment','Order','Transaction','Investor')->first();
        
       return response()->json($house);
        
    //    $slot = $request->slots;

    //    if($slot > 6){

    //    }else{

    //    }

    }
}
