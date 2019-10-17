<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Kin;
use App\Country;
use App\BankDetail;
use App\Transaction;
use App\Order;
use App\PropertyUpload;
use PDF;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorTransactionController extends Controller
{
    //method gets user id
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    //end//

    //method gets all user transaction//
    public function getTransactions (GlobalMethods $globalMethods)
    {
        $order  = Order::where('investor_id', $this->investorID())->orderBy('id', 'desc')->get();
        return view('v1.views.investor_dashboard.potfolio.transactions')
                ->with('progress', $globalMethods->progressBarColor())
                ->with('width', $globalMethods->progressBarWidth())
                ->with('title', $globalMethods->progressBarTitle())
                ->withDetails($order);
    }
    //end//

    //method gets single user transaction history
    public function getTransaction ($token,GlobalMethods $globalMethods)
    {
        $token = \Crypt::decrypt($token);
        $transaction = Transaction::where('order_id',$token)->where('investor_id', Auth::user()->investor_id)->get();
        return view('v1.views.investor_dashboard.potfolio.transaction')
                ->with('progress', $globalMethods->progressBarColor())
                ->with('width', $globalMethods->progressBarWidth())
                ->with('title', $globalMethods->progressBarTitle())
                ->with('transactions', $transaction);
    }
    //end//

    //method converts user transaction to pdf report
    public function getPDF ($token)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_transaction_data_to_html($token));
        $pdf->setPaper('A4');
        return $pdf->download('Investment Report.pdf');
    }
    //end//

    //method gets user transaction for pdf transaction//
    public function convert_transaction_data_to_html ($token)
    {
        $token = \Crypt::Decrypt($token);
        $transaction_data = Transaction::where('order_id', $token->first())->where('investor_id', Auth::user()->investor_id)->get();
        // $transaction_data = $transaction;
        $output = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="'.public_path().'/css/bootstrap.min.css">
            <link rel="stylesheet" href="'.public_path().'/css/default.css">
        </head>
        
        <body class="grey-bg-light">
        <style>

        </style>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 navbar-bg white x3-padding bold">
                        <h1 class="text-center">Site Logo</h1>
                    </div>
                </div>
                <div class="row x1-margin-top">
                    <div class="col-md-12 col-sm-12 col-lg-12 x5-padding-left x5-padding-right">
                        <div>
                            <style>
                                .table-borderless td,
                                .table-borderless th {
                                    border: 0;
                                }
                                .table {
                                    border-bottom:0px !important;
                                }
                                .table th, .table td {
                                    border: 1px !important;
                                    padding:0;
                                }
                                .fixed-table-container {
                                    border:0px !important;
                                }
                                .table-condensed>thead>tr>th, .table-condensed>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
                                    padding: 2px;
                                }
                            </style>
                            <table class="table table-responsive fixed-table-container x2-margin-top table-condensed">
                                <tr style="border:none; outline:none">
                                    <td colspan="1">
                                        <h2 class="footer-continue bolder no-margin">'.strtoupper($transaction_data->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('title')->first()).'</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light">Property Type: </h4>
                                    </td>
                                    <td class="table-borderless">
                                        <h4 class="grey-light">'.ucfirst($transaction_data->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('property_type')->first()).'</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light">Purchased Slot: </h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light">'.($transaction_data->pluck('order')->pluck('purchased_slot')->first()).'</h4>
                                    </td>
                                </tr>                                
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light">Property Cost: </h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light">NGN '.number_format($transaction_data->pluck('order')->pluck('property_cost')->first(), 2).'</h4>
                                    </td>
                                </tr>    
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light">Miscellaneous: </h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light ">NGN '.number_format($transaction_data->pluck('order')->pluck('miscellaneous')->first(), 2).'</h4>
                                    </td>
                                </tr>    
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light ">Rental Unit (year): </h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light ">NGN'.number_format($transaction_data->pluck('order')->pluck('investment')->pluck('profit_per_slot_on_rent')->first() * $transaction_data->pluck('order')->pluck('purchased_slot')->first(), 2).'</h4>
                                    </td>
                                </tr>    
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light ">Sell-off Unit (year): </h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light">NGN '.number_format($transaction_data->pluck('order')->pluck('investment')->pluck('profit_per_slot_on_sell_off')->first() * $transaction_data->pluck('order')->pluck('purchased_slot')->first(), 2).'</h4>
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="x3-width">
                                        <h4 class="grey-light "><i class="fas fa-bedroom"></i> Bedroom:  '.($transaction_data->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('bedroom')->first()).'</h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light"><i class="fas fa-bedroom"></i> Bathroom:  '.($transaction_data->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('bathroom')->first()).'</h4>
                                    </td>
                                    <td>
                                        <h4 class="grey-light"><i class="fas fa-bedroom"></i> Toilet:  '.($transaction_data->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('toilet')->first()).'</h4>
                                    </td>
                                </tr>    
                            </table>
                        </div>
                        <table class="table table-stripped x1-margin-top">
                            <thead>
                                <tr class="header-bg">
                                    <th>S/NO</th>
                                    <th>AMOUNT</th>
                                    <th>DATE</th>
                                    <th>PAYMENT TYPE</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $count = 0;
                            foreach($transaction_data as $transaction){
                                $count += 1;
                                $active = '';
                                if($count % 2 == 0){
                                    $active = 'success';
                                }
                                $output.=  '
                                    <tr class="grey '.$active.'">
                                        <td>'.$count.'</td>
                                        <td>NGN '.number_format($transaction->amount,2).'</td>
                                        <td>'.$transaction->created_at.'</td>
                                        <td>'.ucfirst($transaction->type).'</td>
                                    </tr>';
                            }
                        $output.= '</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        </html>
                ';
        return $output;
    }
    //end//

    // method searches for speific investment transactions
    public function getTransactionSearch (Request $request,GlobalMethods $globalMethods)
    {
        $validator = $this->validate($request, [
            'search' => 'required'
        ]);

        $property  = PropertyUpload::where('title', 'LIKE', '%'.$request->search.'%')->get();

        //checking if specified search exist
        if (!$property->isEmpty())
        {
            foreach($property as $properties)
            {
                $order = Order::where('investment_id', $properties->investment->id)->where('investor_id', Auth::user()->investor_id)->get();
                // checking if user has such investment in potfolio
                if (!$order->isEmpty())
                {
                    return view('v1.views.investor_dashboard.potfolio.transactions')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('orders', $order);
                    
                }
                else
                {
                    $message = 'No property with the supplied name exist on your transaction list';
                    return redirect()->route('transactions')->with('status', $message);
                }
                //end//
            }
        }
        else
        {
            $message = 'No property with the supplied name exist on your transaction list';
            return redirect()->route('transactions')->with('status', $message);
        }

    }
    // end//
}
