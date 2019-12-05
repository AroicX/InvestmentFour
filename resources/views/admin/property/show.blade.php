@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 mx-auto">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body animated fadeIn delay-1s">
                <h3 class="align-items-center text-cneter f-12">Edit Property - {{$prop->title}}</h3>


                    <form action="{{ url('/admin/edit-property') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="row">
                            <input type="hidden" name="property_id" value="{{$prop->id}}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" class="form-control" type="text" name="title" value="{{$prop->title}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rentage">Rentage</label>
                                    <input id="rentage" class="form-control" type="text" name="rentage" value="{{$prop->rentage}}" required>
                                </div>
                            </div>




                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bedroom">Bedrooms</label>

                                    <input class="form-control" type="number" name="bedroom" min="1" value="{{$prop->bedroom}}" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bathroom">Bathroom</label>

                                    <input class="form-control" type="number" name="bathroom" min="1" value="{{$prop->bathroom}}" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="toilet">Toilets</label>

                                    <input class="form-control" type="number" name="toilet" min="1" value="{{$prop->toilet}}" max="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Note</label>
                            <input id="note" class="form-control" type="text" name="note" value="{{$prop->note}}">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" class="form-control" type="text" name="address" value="{{$prop->address}}">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Contry</label>

                                    <input class="form-control" type="text" name="country" value="{{$prop->country}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State</label>

                                    <input class="form-control" type="text" name="state" value="{{$prop->state}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>

                                    <input class="form-control" type="text" name="city" value="{{$prop->city}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="text" name="price" value="{{$prop->cost}}" required>
                        </div>

                        
                        <hr class="sidebar-divider d-none d-md-block">
{{-- 
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="front">Front View</label>

                                    <input class="form-control" type="file" name="front" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="side">Side View</label>

                                    <input class="form-control" type="file" name="side" required>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Back">Back View</label>

                                    <input class="form-control" type="file" name="back" required>
                                </div>
                            </div>
                           
                        </div> --}}




                        <div class="form-group">
                            {{-- <button class="btn btn-warning">Post </button> --}}
                            <button class="btn btn-facebook btn-block"> Update </button>
                        </div>

                    </form>


                </div>
            </div>
        </div>


    </div>
</div>
@endsection


@section('js')

@endsection
