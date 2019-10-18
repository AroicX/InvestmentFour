<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TicketMessage;
use App\TicketResponse;
use Auth;
class TicketController extends Controller
{
    
    public function __construcr()
    {
        $this->middleware('admin');
    }

    public function index(TicketMessage $ticket)
    {
        $tickets = $ticket->with('ticket_subject')->get();

        // return $tickets;

        $responses = TicketResponse::all();


        return view('admin.tickets.index',compact('tickets','responses'));
    }

    public function Responsed(Request $request)
    {

        $user = Auth::user()->id;
        $res = new TicketResponse;

        $res->ticket_message_id = $request->id;
        $res->responder_id = bcrypt($user);
        $res->message = $request->message;
        $res->save();

        $notification = array('message' => 'Response added Succesfully...','alert' => 'success' );
        return redirect()->back()->with($notification); 



        // return $request->all();
    }

    public function edit($id)
    {
        $ticket = TicketMessage::where('id', '=', $id)->with('ticket_subject')->first();
        $responses = TicketResponse::where('ticket_message_id', '=', $id)->get();

        return view('admin.tickets.modal-response',compact('ticket','responses'));
    }



}
