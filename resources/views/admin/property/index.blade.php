@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-400">Property Control {{count($properties)}}</h1>
        <a href="/admin/add-property" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add Property</a>
    </div>


    <div class="row">
        @foreach ($properties as $item)
        <div class="col-md-4">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase">{{$item->title}}</h6>

                    @if($item->investment)
                    <a style="text-decoration: none;" class="edit-investment" href="#" id="{{$item->id}}">
                        <span class="badge badge-pill badge-success py-1 px-2">Investement</span>
                    </a>
                    @else
                    <a style="text-decoration: none;" href="/admin/property-investment/{{$item->id}}">
                        <span class="badge badge-pill badge-primary py-1 px-2">Add Investement</span>
                    </a>

                    @endif
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end"
                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">

                            <a class="dropdown-item" href="/admin/edit-property/{{$item->id}}">Edit</a>
                           @if($item->active === 1)
                           <a class="dropdown-item" href="/admin/delete-property/{{$item->id}}"
                            onclick="javascript:confirm('Are you sure you want to deactivate property? ')">Deactivate</a>
                            @else 
                            <a class="dropdown-item" href="/admin/act-property/{{$item->id}}" >Activate</a>
                           @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item disabled" href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <img class="img-responsive w-100"
                        src="/images/{{$item->property_type}}/{{$item->property_upload_image->front_image}}"
                        alt="{{$item->title}}" height="200px !important">

                    <ul class="property-list">
                        <li class="mx-2 my-2"> <i class="fas fa-bed"></i> {{$item->bedroom}} </li>
                        <li class="mx-2 my-2"> <i class="fas fa-bath"></i> {{$item->bathroom}} </li>
                        <li class="mx-2 my-2"> <i class="fas fa-toilet"></i> {{$item->toilet}} </li>
                    </ul>

                    <div class="card-text">
                        <p> Price: ${{$item->cost}}</p>
                        <p> Note: {{$item->note}}</p>
                        <p> Location: <span>{{$item->state}}/{{$item->city}}</span></p>
                    </div>

                    @if($item->active != 1)
                       <span class="badge badge-pill badge-danger py-1 px-2">Property Not Active</span>
                    @endif


                
                </div>
            </div>

        </div>
        @endforeach
    </div>


    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Investment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                            class="fa fa-close"></i></button>
                </div>

                <div class="modal-body">
                    <form action="{{ url('/admin/edit-investment') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="form-group">

                            <input id="investment" class="form-control" type="hidden" value="" name="investment">
                        </div>



                        <div class="form-group">
                            <input id="active-input" type="checkbox" name="active" > 
                            <label for="">Active</label>
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
                                    <label for="avail_slots">Available Slots</label>
                                    <input id="avail_slots" class="form-control" type="number" min="1"
                                        name="avail_slots" required>
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


    <style>
        .property-list {
            position: relative;
            top: 10px;
            left: -40px;
            display: flex;
            color: #4e73df !important;

        }

        .property-list li {
            font-size: 18px !important;
            list-style: none;
            letter-spacing: 1px;
            s
        }

    </style>


</div>
@endsection



@section('js')

<script>
    //Ajax Load data from ajax
    $(function () {

        $('.edit-investment').click(function () {
            var id = $(this).attr('id');

            // console.log(id);

            $.ajax({
                url: "/admin/get-investment/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#view_modal').modal(
                        'show'); // show bootstrap modal when complete loaded
                    $('[name="investment"]').val(data.id);
                    $('[name="duration"]').val(data.investment_duration);
                    $('[name="slots"]').val(data.slots);
                    $('[name="avail_slots"]').val(data.avail_slots);
                    $('[name="renovation"]').val(data.renovation_cost);
                    $('[name="management"]').val(data.management_cost);
                    $('[name="cost_per_slot"]').val(data.cost_per_slot);
                    $('[name="profit_per_slot_on_rent"]').val(data.profit_per_slot_on_rent);
                    $('[name="profit_per_slot_on_sell_off"]').val(data
                        .profit_per_slot_on_sell_off);
                    if(data.active === 1){
                        $('#active-input').prop("checked", true);
                    }
                    console.log(data.active);
                    // $('[name="measure"]').val(data.measure);
                    // $('[name="rp"]').val(data.rp);
                    // $('[name="price"]').val(data.price);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Retrieving Data!');
                }
            });


        });
    });

</script>
@endsection
