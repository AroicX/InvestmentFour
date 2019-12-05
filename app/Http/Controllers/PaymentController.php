<?php

namespace App\Http\Controllers;



use App\Investment;
use App\Investor;
use App\Bank;
use App\BankDetail;
use App\Order;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Crypt;
use App\Http\Controllers\GlobalMethods;


class PaymentController extends Controller
{
   


	public function getDuePayments( GlobalMethods $globalMethods)
	{

        // $investment = Investment::where('active',1)->where('investemnt_duration')->get();

        $transactions = Transaction::all();
        $orders = Order::all();
        $investments = Investment::where('active', 1)->get();
        // return $investments;
        $due = [];

      

        foreach ($investments as $key => $investment) {


            
            $date = Carbon::parse($investment->created_at);
            $now = Carbon::now();
            $diff = $date->diffInYears($now);
            
            if($diff >= $investment->investment_duration){

              $failed = [$investment->id,];
             
              array_push($due, $failed);
              
             }
            

             
        }


            $invest = Investment::with('order','order.investor')->find($due);
            // dd($invest);


        return view('admin.payment.index',compact('invest'));

    }






















    
    public function FunctionName(Type $var = null)
    {
        $devices = Devices::all();

        $expired = [];
 
        foreach ($devices as $key => $value) {
         $date = Carbon::parse($value->updated_at);
         $now = Carbon::now();
         $diff = $date->diffInDays($now);
         $failed = ['user' => $value->user_id, 'duration' => $value->duration, 'expired_time' => $diff];
 
         array_push($expired,$failed);
         // sleep(6);
        }
 
 
        $proven = [];
 
        foreach ($expired as $key => $value) {
         // echo $value['duration'];
 
           if($value['expired_time'] > $value['duration']){
             $proof = ['user' => $value['user'], 'expired' => true];
           }else{
             $proof = ['user' => $value['user'], 'expired' => false];
           }
           array_push($proven,$proof);
 
        }
 
        foreach ($proven as $key => $value) {
 
        
             if($value['expired']){
                  Devices::where('user_id', $value['user'])->update(['status' => 0]);
                 // echo $value['user'];
             }
        }
    }


}
