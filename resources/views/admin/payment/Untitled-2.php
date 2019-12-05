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

        $transactions = Transaction::all();
        $orders = Order::all();
        $investments = Investment::where('active', '=', 1)->get();
        // return $investments;
        $due = [];

      

        foreach ($investments as $key => $investment) {


            
            $date = Carbon::parse($investment->created_at);
            $now = Carbon::now();
            $diff = $date->diffInYears($now);
            
            if($diff >= $investment->investment_duration){
              
              foreach ($orders as $key => $order) {
                
                if($order->investment_id == $investment->id){
                  $getTransactions = $order->transaction;
                  $getInvestorById = $getTransactions['0']->investor_id;
                  $paid_slots = $order->purchased_slot;
                  $amount = $getTransactions['0']->amount;
                  $total = $paid_slots * $amount;

                  $getInvestor = Investor::where('investor_id', '=', $getInvestorById)->get();
                  $getInvestorName = $getInvestor[0]->first_name;

                  //get-bank details
                  $getInvestorBankDeatils = BankDetail::where('investor_id', '=', $getInvestorById)->get();
                  $getInvestorBankAccName = Crypt::decrypt($getInvestorBankDeatils[0]->acc_name);
                  $getInvestorBankAccNum =  Crypt::decrypt($getInvestorBankDeatils[0]->acc_number);

                  $getBanks =  Bank::where('bank_id', '=', $getInvestorBankDeatils[0]->id)->get();
                  $getBankName = $getBanks[0]->bank;


                
              
                  
                  
                  
                  $failed = [
                      // 'investor_id' => $getInvestorById,
                      'investor' => $getInvestorName,
                      'bank' => $getBankName,
                      'bank_acc_name' => $getInvestorBankAccName,
                      'bank_acc_num' => $getInvestorBankAccNum,
                      'slots' => $investment->slots,
                      'paid_slots' => $paid_slots,
                      'amount' => $amount,
                      'total' => $total,
                      'duration' => $investment->investment_duration,
                      'expired' => true,
                      'expired_time' => $diff,
                  ];

                  
        
                }
                // $findExpired = Transaction::where()
              }
              array_push($due, $failed);




            }
            

          // return $due;
            
          }

          if($due){
            $globalMethods->adminNotification(1,'New Schedule ran, '.count($due).' investors due to be paid !');
          }else{
            $globalMethods->adminNotification(1,'New Schedule ran, 0 investors due to be paid !');
          }

          $hello = 'hello';

        //  dd($due);
       return view('admin.payment.index',compact('hello', 'due'));

       
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
