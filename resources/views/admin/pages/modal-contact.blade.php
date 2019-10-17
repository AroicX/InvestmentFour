@extends('admin.layout.master')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit ContactUs</h1>
    <a href="/admin/page-control" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Back</a>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-xl-12 col-md-12 mb-4 mx-auto">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body animated fadeIn delay-1s">


            <form action="{{ url('/admin/page-control-contact') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}



              <div class="form-group h-30">
                <label for="title">Title</label>
              <input class="form-control" type="text" name="title" value="{{$contact->title}}">
              </div>
              <input type="hidden" name="contact" value="{{$contact->id}}">
              <div class="form-group h-30">
                <label for="content">Content </label>
                <textarea class="form-control" name="content" cols="20" rows="5">
                  {{$contact->content}}
              </textarea>
              </div>


              <button type="submit" class="btn btn-primary">Change</button>


            </form>


          </div>
        </div>
      </div>


    </div>
  </div>
  @endsection

