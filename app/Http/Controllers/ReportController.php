<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Investment;
use App\Order;
use App\PropertyUpload;
use App\Transaction;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function users()
    {
        $investors = Investor::all();

        return view('admin.reports.users',compact('investors'));
    }

    public function usersDeactive($id)
    {
        $status;
        $type;

        $act =  Investor::where('id','=',$id)->first();
        if($act->active == 0){
            $investor =  Investor::where('id','=',$id)->update(['active' => 1]);

            $status = 'activated';
                $type = 'info';
            }else{
                $investor =  Investor::where('id','=',$id)->update(['active' => 0]);
                $status = 'deactivated';
                $type = 'warning';

        }

        $notification = array('message' => 'Investor has been '.$status,'alert' => $type );
        return redirect()->back()->with($notification);
    }

    public function usersUpdate(Request $request)
    {
        // return $request->all();

       $data = array(
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'country' => $request->country,
        );

        $investor =  Investor::where('id','=',$request->id)->update($data);

        $notification = array('message' => 'Investor has been updated','alert' => 'success' );
        return redirect()->back()->with($notification);
    }



    public function transactions()
    {
        $transactions = Transaction::with('order')->get();
        $investors = Investor::all();
        $investments = Investment::all();
        $orders = Order::all();
        $properties = PropertyUpload::all();

        // $orders = Order::with('investment')->get();
        return view('admin.reports.transactions',compact('transactions','investors','properties','orders','investments'));
    }
    public function properties()
    {
        $properties = PropertyUpload::where('active','=', 1)->with('property_upload_image','investment')->get();

        return view('admin.reports.properties',compact('properties'));
    }

    public function getPDF ($token)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_transaction_data_to_html($token));
        $pdf->setPaper('A4');
        return $pdf->download('Investment Report.pdf');
    }


}
