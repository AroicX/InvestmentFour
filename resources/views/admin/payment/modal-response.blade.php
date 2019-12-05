
@extends('admin.layout.master')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Ticket</h1>
    <a href="/admin/ticket-control" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Back</a>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-xl-12 col-md-12 mb-4 mx-auto">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body animated fadeIn delay-1s">


            <form action="{{ url('/admin/ticket-control-responed') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
  
            <input type="hidden" id="get-response" name="id" value="{{$ticket->id}}">

            <p>Subject: {{$ticket->ticket_subject->subject}}</p>
            <p>Message: {{$ticket->message}}</p>

              
              <div class="form-group h-30">
                  <label for="Message">Response</label>
                  <textarea class="form-control" name="message" cols="20" rows="5">
                      
                  </textarea>
              </div>
          
  
              <button type="submit" class="btn btn-primary">Upload</button>
  
  
          </form>

            
       <div class="mx-auto my-5">
         <h2>Responses: </h2>

         @foreach ($responses as $res)
         <blockquote class="blockquote">
         <p class="mb-0">{{$res->message}}</p>
             <footer class="blockquote-footer">Administrator <cite title="Source Title">{{$res->created_at}}</cite></footer>
           </blockquote>
         @endforeach
      
       </div>
          

          </div>
        </div>
      </div>


    </div>
  </div>
  @endsection


