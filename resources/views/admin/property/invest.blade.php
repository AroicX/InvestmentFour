@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 mx-auto">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body animated fadeIn delay-1s">
                    <h3 class="align-items-center text-cneter f-12">Invest in {{$property->title}}</h3>


                    <form action="{{ url('/admin/activate-property') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group">

                            <input id="property" class="form-control" type="hidden" value="{{$property->id}}"
                                name="property">
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration">Investment Duration</label>
                                    <input id="duration" class="form-control" type="number" min="1" name="duration"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slot">Investment Slot</label>
                                    <input id="slot" class="form-control" type="number" min="1" name="slots" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="renovation">Renovation Cost</label>
                                    <input id="renovation" class="form-control" type="number" min="1" name="renovation"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="management">Management Cost</label>
                                    <input id="management" class="form-control" type="number" min="1" name="management"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cost_per_slot">Cost-per-Slot</label>
                                    <input id="cost_per_slot" class="form-control" type="number" min="1"
                                        name="cost_per_slot" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profit_per_slot_on_rent">Profit-per-slot-on-rent</label>
                                    <input id="profit_per_slot_on_rent" class="form-control" type="number" min="1"
                                        name="profit_per_slot_on_rent" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="profit_per_slot_on_sell_off">Profit-per-slot-on-sell-off</label>
                                    <input id="profit_per_slot_on_sell_off" class="form-control" type="number" min="1"
                                        name="profit_per_slot_on_sell_off" required>
                                </div>
                            </div>


                            <button class="btn btn-primary btn-block">Save</button>



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
