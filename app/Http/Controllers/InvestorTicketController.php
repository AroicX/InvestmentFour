<?php

namespace App\Http\Controllers;

use App\Investor;
use App\Kin;
use App\Country;
use App\BankDetail;
use App\TicketSubject;
use App\TicketMessage;
use App\TicketResponse;
use Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalMethods;

class InvestorTicketController extends Controller
{
    private function investorID ()
    {
        $investor_id = Auth::user()->investor_id;
        return $investor_id;
    }
    
    public function getCreateTicket (GlobalMethods $globalMethods)
    {
        $ticket_subjects = TicketSubject::all();
        return view('v1.views.investor_dashboard.ticket.ticket')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('ticket_subject', $ticket_subjects)
                    ->with('title', $globalMethods->progressBarTitle());
    }

    public function  postCreateTicket (Request $request, GlobalMethods $globalMethods)
    {
        try {
            // Validate stop the execution is fields are empty
            $validator = $this->validate($request, [
                'ticket_subject_id' => 'required',
                'message' => 'required'
            ]);
            
            //inserting ticket into db
            $new_message = TicketMessage::create([
                'ticket_subject_id' => intval($request->ticket_subject_id),
                'investor_id' => Auth::user()->investor_id,
                'message' => $request->message,
            ]);//end
    
            if (!empty($new_message)){
                $notification = 'Your ticket has been delivered successfully! <br/>We will get back to you soon!';
                $globalMethods->sendNotification(Auth::user()->investor_id, $notification);
                $message = 'Ticket sent successfully! We will get back to you soon!';
                // checking if request is ajax
                if ($request->ajax())
                {
                    return response()->json(['success' => $message]);
                }
                else
                {
                    return redirect()->route('ticket')->with('status', $message);
                }
            }else{
                return response()->json([
                    "error" => "An error has occured. Kindly try again later.",
                ]);
            }
    
        }catch (\Exception $e) {

            // If there is any error it return a error response
            return response()->json(array(
                'subject' => 'The subject is required',
                'message' => 'The message is required'
            ));
        }
    }

    public function getticketResponse (GlobalMethods $globalMethods)
    {
        $investor_id       = Auth::user()->investor_id;
        $tickect_message   = TicketMessage::where('investor_id',$investor_id)->where('deleted', 0)->orderBy('id', 'desc')->paginate(4);
        $ticket_subject    = TicketSubject::find($tickect_message->pluck('subject_id'));
        $ticket_response   = TicketResponse::where('ticket_message_id', $tickect_message->pluck('id'));
        return view('v1.views.investor_dashboard.ticket.ticketResponse')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('ticket_message', $tickect_message)
                    ->with('ticket_response', $ticket_response)
                    ->with('ticket_subject', $ticket_subject);
    }

    public function getreadResponse ($token, GlobalMethods $globalMethods)
    {
        $token             = \Crypt::decrypt($token);
        $ticket_message    = TicketMessage::where('id', $token)->first();
        $ticket_response   = TicketResponse::where('ticket_message_id', $token)->orderBy('id', 'desc')->paginate();
        return view('v1.views.investor_dashboard.ticket.readResponse')
            ->with('progress', $globalMethods->progressBarColor())
            ->with('width', $globalMethods->progressBarWidth())
            ->with('title', $globalMethods->progressBarTitle())
            ->with('ticket_message', $ticket_message)
            ->with('ticket_response', $ticket_response);
    }

    public function getDeleteTicket ($token, GlobalMethods $globalMethods)
    {
        $token = \Crypt::decrypt($token);
        $ticket_message = TicketMessage::find($token);
        $ticket_message->deleted = 1;
        $query_flag = $ticket_message->update();
        //checking if query executed successfully//
        if ($query_flag) 
        {
            $notification = 'The selected ticket has been successfully removed from your ticket list.';
            $globalMethods->sendNotification(Auth::user()->investor_id, $notification);
            $success = "The selected ticket was deleted successfully";
            return response()->json(['success'=>$success]);//return response page//
        }
        $error = "Sorry an error was encountered. Kindly try again later.";
        return response()->json(['error'=>$error]);
    }

    public function getSatisfied($token,GlobalMethods $globalMethods)
    {
        $token = \Crypt::decrypt($token);
        $ticket_message  = TicketMessage::find($token);
        $ticket_statisfed = [
            'satisfied' => 1
        ];
        $query_flag = $ticket_message->update($ticket_statisfed);
        //checking if query executed successfully//
        if ($query_flag) 
        {
            $notification = 'We are glad that you are satisfied with our response/service. We are always open to suggestions regarding how we can serve you better.';
            $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
            return response()->json($ticket_message);
        }
    }

    public function reloadResponse (GlobalMethods $globalMethods)
    {
        $investor_id       = Auth::user()->investor_id;
        $tickect_message   = TicketMessage::where('investor_id',$investor_id)->where('deleted', 0)->orderBy('id', 'desc')->paginate(4);
        $ticket_subject    = TicketSubject::find($tickect_message->pluck('subject_id'));
        $ticket_response   = TicketResponse::where('ticket_message_id', $tickect_message->pluck('id'));
        return view('v1.views.investor_dashboard.ticket.reload')
                    ->with('progress', $globalMethods->progressBarColor())
                    ->with('width', $globalMethods->progressBarWidth())
                    ->with('title', $globalMethods->progressBarTitle())
                    ->with('ticket_message', $tickect_message)
                    ->with('ticket_response', $ticket_response)
                    ->with('ticket_subject', $ticket_subject);
    }

    //method post a user's reply
    public function postReply(Request $request,GlobalMethods $globalMethods)
    {
       try
       {
            $validator = $this->validate($request, [
                'message' => 'required',
                'ticket_message_id' => 'required'
            ]);

            $ticket_response = TicketResponse::create([
                'ticket_message_id' => intval($request->ticket_message_id),
                'message'           => $request->message,
                'responder_id'      => Auth::user()->investor_id,
            ]);

            if (!empty($ticket_response)){
                $notification = 'Your reply has been successfully recieved. We will get back to you soon!';
                $globalMethods::sendNotifications(Auth::user()->investor_id, $notification);
                $message = 'Reply sent successfully! We will get back to you soon!';
                return response()->json(['success' => $message]);
            }else{
                return response()->json([
                    'error' => 'An error has occured. Kindly try again later.',
                ]);
            }

       }
       catch(\Exception $e)
       {
            return response()->json([
                'error'=>'The message is required',
            ]);
       }
    }
    //end//

    //
    public function responseReload($token, GlobalMethods $globalMethods)
    {
        $token             = \Crypt::decrypt($token);
        $ticket_response   = TicketMessage::where('id', $token)->orderBy('id', 'desc')->first();
        return view('v1.views.investor_dashboard.ticket.responseReload') 
                ->with('progress', $globalMethods->progressBarColor())
                ->with('width', $globalMethods->progressBarWidth())
                ->with('title', $globalMethods->progressBarTitle())
                ->with('ticket_response', $ticket_response);
    }
    //end//
}
