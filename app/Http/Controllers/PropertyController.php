<?php

namespace App\Http\Controllers;


use Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mews\Purifier\Facades\Purifier;

use App\PropertyUpload;
use App\PropertyType;
use App\PropertyRegion;
use App\PropertyUploadImage;
use App\Investment;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = PropertyUpload::with('property_upload_image','investment')->get();

        return view('admin.property.index',compact('properties'));
    }

    public function showInvest($id)
    {
        $property = PropertyUpload::where('id','=', $id)->first();

        return view('admin.property.invest',compact('property'));
    }

    public function getInvestmentById($id)
    {
        $investment = Investment::where('id','=', $id)->first();

        return response()->json($investment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = PropertyType::where('active','=',1)->get();
        $regions = PropertyRegion::where('active','=',1)->get();

        return view('admin.property.create',compact('types','regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        // return $request->all();

        $property = new  PropertyUpload;
        $property->property_type = $request->type;
        $property->property_region = $request->region;
        $property->rentage = $request->rentage;
        $property->title = $request->title;
        $property->bedroom = $request->bedroom;
        $property->bathroom = $request->bathroom;
        $property->toilet = $request->toilet;
        $property->note = $request->note;
        $property->address = $request->address;
        $property->country = $request->country;
        $property->state = $request->state;
        $property->city = $request->city;
        $property->cost = $request->price;
        $property->save();

        if($property){


            $front = $request->file('front');
            $side = $request->file('side');
            $back = $request->file('back');

            $frontImage = time(). '.' . $front->getClientOriginalExtension();
            $sideImage = time(). '.' . $side->getClientOriginalExtension();
            $backImage = time(). '.' . $back->getClientOriginalExtension();

            $image = new PropertyUploadImage;
            $image->property_upload_id = $property->id;
            $image->front_image = $frontImage;
            $image->side_image = $sideImage;
            $image->back_image = $backImage;
            $image->save();

            $path = 'images/'.$request->type;

            $front->move($path, $frontImage);
            $side->move($path, $sideImage);
            $back->move($path, $backImage);

            sleep(10);

            $notification = array('message' => $request->title.' has been added','alert' => 'success' );
			return redirect()->back()->with($notification);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $types = PropertyType::where('active','=',1)->get();
        $regions = PropertyRegion::where('active','=',1)->get();

        $prop = PropertyUpload::where('id','=',$id)->with('property_upload_image')->first();

        return view('admin.property.show',compact('prop','types','regions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        // return $request->all();

        $total_profit_per_slot_on_rent = $request->profit_per_slot_on_rent * $request->slots;
        $total_profit_per_slot_on_sell_off = $request->profit_per_slot_on_sell_off * $request->slots;
        

        $data = array(

            'investment_duration' => $request->duration,
            'slots' => $request->slots,
            'avail_slots' => $request->slots,
            'renovation_cost' => $request->renovation,
            'management_cost' => $request->management,
            'cost_per_slot' => $request->cost_per_slot,
            'profit_per_slot_on_rent' => $request->profit_per_slot_on_rent,
            'total_profit_per_slot_on_rent' => $total_profit_per_slot_on_rent,
            'profit_per_slot_on_sell_off' => $request->profit_per_slot_on_rent,
            'total_profit_per_slot_on_sell_off' => $total_profit_per_slot_on_sell_off,
        );

        $p = Investment::where('id','=',$request->investment)->update($data);

        $notification = array('message' => ' Investment has been updated','alert' => 'success' );
        return redirect()->back()->with($notification);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->all();
        $id = $request->property_id;

        $data = array(
            // "property_type" => $request->type,
            // "property_region" => $request->region,
            "rentage" => $request->rentage,
            "title" => $request->title,
            "bedroom" => $request->bedroom,
            "bathroom" => $request->bathroom,
            "toilet" => $request->toilet,
            "note" => $request->note,
            "address" => $request->address,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "cost" => $request->price
        );

        // return $data;
        PropertyUpload::where('id','=',$id)->update($data);

        $notification = array('message' => $request->title.' has been updated','alert' => 'success' );
        return redirect()->back()->with($notification);



    }


    public function Activate(Request $request)
    {

        $total_profit_per_slot_on_rent = $request->profit_per_slot_on_rent * $request->slots;
        $total_profit_per_slot_on_sell_off = $request->profit_per_slot_on_sell_off * $request->slots;
        
        $invest = new Investment;
        
        $invest->property_upload_id = $request->property;
        $invest->investment_duration = $request->duration;
        $invest->slots = $request->slots;
        $invest->avail_slots = $request->slots;
        $invest->renovation_cost = $request->renovation;
        $invest->management_cost = $request->management;
        $invest->cost_per_slot = $request->cost_per_slot;
        $invest->profit_per_slot_on_rent = $request->profit_per_slot_on_rent;
        $invest->total_profit_per_slot_on_rent = $total_profit_per_slot_on_rent;
        $invest->profit_per_slot_on_sell_off = $request->profit_per_slot_on_rent;
        $invest->total_profit_per_slot_on_sell_off = $total_profit_per_slot_on_sell_off;
        $invest->save();
        
        // return $request->all();


        $notification = array('message' => 'Investment has been added','alert' => 'success' );
        return redirect()->back()->with($notification);

          
           

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $property =  PropertyUpload::where('id','=',$id)->update(['active' => 0]);

      $notification = array('message' => 'Property has been deactivated','alert' => 'warning' );
      return redirect()->back()->with($notification);

        //
    }
    public function Toggle($id)
    {
      $property =  PropertyUpload::where('id','=',$id)->update(['active' => 1]);

      $notification = array('message' => 'Property has been activated','alert' => 'success' );
      return redirect()->back()->with($notification);

        //
    }
}
