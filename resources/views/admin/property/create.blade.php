@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 mx-auto">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body animated fadeIn delay-1s">
                    <h3 class="align-items-center text-cneter f-12">Add Property</h3>


                    <form action="{{ url('/admin/add-property') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input id="title" class="form-control" type="text" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rentage">Rentage</label>
                                  <input type="checkbox" class="form-checkbox" name="rentage" value="1"> Yes 
                                  <input type="checkbox" name="rentage" value="0"> No 
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Property Type</label>

                                    <select class="form-control" name="type" required>
                                        @foreach ($types as $type)
                                        <option value="{{$type->type}}">{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region">Property Region</label>

                                    <select class="form-control" name="region" required>
                                        @foreach ($regions as $region)
                                        <option value="{{$region->region}}">{{$region->region}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bedroom">Bedrooms</label>

                                    <input class="form-control" type="number" name="bedroom" min="4" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bathroom">Bathroom</label>

                                    <input class="form-control" type="number" name="bathroom" min="4" max="10" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="toilet">Toilets</label>

                                    <input class="form-control" type="number" name="toilet" min="4" max="10" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Note</label>
                            <input id="note" class="form-control" type="text" name="note">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input id="address" class="form-control" type="text" name="address">
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="country">Contry</label>

                                    <input class="form-control" type="text" name="country" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State</label>

                                    <input class="form-control" type="text" name="state" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city">City</label>

                                    <input class="form-control" type="text" name="city" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input class="form-control" type="text" name="price" required>
                        </div>

                        
                        <hr class="sidebar-divider d-none d-md-block">

                        
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
                           
                        </div>




                        <div class="form-group">
                            {{-- <button class="btn btn-warning">Post </button> --}}
                            <button class="btn btn-facebook btn-block">Save</button>
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
