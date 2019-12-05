@extends('v1.master.investor')

@section('title', 'potfolio')

@section('nav')
<section class="navbar-fixed-top no-margin x10-width">
    <div class="container-fluid no-margin no-padding">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding ">
                @include('v1.components.navigations.investorNav.genNav')
            </div>
        </div>
    </div>
</section>
@endsection

<!--START: disable-account modal-->
<div id="warningModal" class="modal animated slideInDown slower delay-2s x5-margin-top x10-margin-left" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <div class="modal-header navbar-bg">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title bolder white x14-font-size"><i class="fas fa-info-circle"></i> <span class="title">Update Report</span></h4>
            </div>
            <div class="modal-body grey-bg-light">
                <p class="lead x14-font-size text-left grey x2-padding no-margin">
                    <span class="display-text x14-font-size"> Sorry you cannot purchase any property until you have supplied the following information;</span>
                </p>
                <p class="lead x14-font-size grey x2-padding-left">
                    - Personal Information <i class="fas fa-times-circle maroon "> </i>
                </p>
                <p class="lead x14-font-size grey x2-padding-left">
                    - Kin Information <i class="fas fa-times-circle maroon "> </i>
                </p>
                <p class="lead x14-font-size grey x2-padding-left">
                    - Bank Information <i class="fas fa-times-circle maroon "> </i>
                </p>
            </div>
            <div class="modal-footer grey-bg-light">
                <button type="button" class="btn btn-danger btn-lg no-radius no-delete x14-font-size" data-dismiss="modal"> <span class="no">Cancel</span> <i class="fa fa-times"></i> </button>
            </div>
        </div>
    </div>
</div>
<!--END: disable-account modal-->

@section('content')
<section>
    <div class="container-fluid flex x1-margin-bottom x9-width x14-font-size">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slow">
                <div class="x5-padding-bottom x0-margin-left x0-margin-right border-bottom ">
                    <i class="fas fa-user-circle large-icon light-blue"></i>
                    <h4 class="grey">{{lcfirst(Auth::user()->email)}}</h4>
                    <div class="progress x3-margin">
                        <div class="progress-bar {{$progress}} {{$width}}" role="progressbar"
                            aria-valuemin="0" aria-valuemax="100">
                            <span class="text-center">{{e($title)}}</span>
                        </div>
                    </div> 
                </div>
                @include('v1.components.navigations.asidenav')
            </div>
            <!--START: main content column-->
            <div class="col-md-8 col-sm-12 col-lg-8 margin-left-content x2-margin-bottom no-padding">
                <!--START: nav result container-->
                <div class="container-fluid">
                    <!--START: result row-->
                    <div class="row no-padding animated fadeIn slower">
                       <div class="col-md-8 col-sm-12 col-lg-8 form-border bottom-border-radius no-padding white-bg x1-margin-bottom">
                            <form action="{{route('offerInvestpost')}}" method="post">
                            @csrf() <!--csrf() field-->
                                <h1 class="grey bold text-center white-bg border-bottom no-margin x2-padding">Payment</h1>
                                <!--START: property information row-->
                                <div class="border-bottom x2-padding">
                                    <h3 class="grey"> <span class="light-blue underline-text bolder">Property Inf</span>ormation</h3>
                                    <p class="lead grey x2-margin-left x4-margin-top property-list"> <i class="far fa-building property-icon"></i> {{ucfirst($property->title)}} </p>
                                    <p class="lead grey x2-margin-left property-list"> <i class="fas fa-map-marker property-icon"></i> {{ucfirst($property->address)}}</p>
                                    <p class="lead grey x2-margin-left">
                                        <span class="property-list border-right x3-padding-right" title="Bedroom" alt="Bedroom"><span class="property-icon"><i class="fas fa-bed property-icon"></i> Bedroom: {{ucfirst($property->bedroom)}}</span></span>
                                        <span class="property-list border-right x3-padding-right x2-padding-left" title="Bathroom" alt="Bathroom"> <span class="property-icon"><i class="fas fa-bath"></i> Bathroom: {{ucfirst($property->bathroom)}}</span> </span>
                                        <span class=" property-list x3-padding-right x2-padding-left" title="Toilet" alt="Toilet"><span class="property-icon"><i class="fas fa-toilet"></i> Toilet: {{ucfirst($property->toilet)}}</span></span>
                                    </p>
                                    <div class="form-group x2-margin-left">
                                       <span class="grey lead"> {!! ($property->rentage == 0? '<i class="fas fa-times-circle maroon"></i>' : '<i class="fas fa-check-circle green"></i>') !!} Rentage</span>
                                    </div>
                                    <div class="form-group x2-margin-left">
                                        <span class="lead"><input class="checkbox-size" type="checkbox" name="terms" id="terms"> <a href="#" class="normal-link">Terms and Conditions</a></span>
                                        @if($errors->has('terms'))
                                            <p class="maroon x11-font-size">{{$errors->first('terms')}}</p>
                                        @endif
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar {{App\Http\Controllers\GlobalMethods::avail_slots_progressBar($property->investment->avail_slots, $property->investment->slots)}}" role="progressbar" aria-valuenow="70"
                                            aria-valuemin="0" aria-valuemax="100">
                                            <span class="lead x12-font-size x2-padding ">{{$property->investment->avail_slots}}/{{$property->investment->slots}} slot(s) left</span>
                                        </div>
                                    </div>  
                                </div><!--END: property information row-->
                                <!--START: pricing row-->
                                <div class="border-bottom x2-padding x2-margin-top">
                                    <h3 class="grey"> <span class="light-blue underline-text bold">Pri</span>cing</h3>
                                    <script>
                                        $(document).ready(function() {
                                            $('#slot').change(function() {
                                                let slot   = $("#slot :selected").val()
                                                let propertyCost = {{$property->investment->cost_per_slot}}; //get property cost
                                                let mngmentCost  = {{$property->investment->management_cost}}; //get management cost
                                                let renovtnCost  = {{$property->investment->renovation_cost}}; //get renovation cost

                                                //below script is for roi
                                                let rent      = {{$property->investment->profit_per_slot_on_rent}}; //get rent amount
                                                let sell      = {{$property->investment->profit_per_slot_on_sell_off}}; //get sell-off amount

                                                propertyCost  = slot * propertyCost; //multiply property cost by slot purchased
                                                mngmentCost   = slot * mngmentCost; //multiply managament cost by slot purchased
                                                renovtnCost   = slot * renovtnCost; //multiply renovation cost (if any) by slot purchased
                                                rent          = slot * rent;        //multiply income on rent by slot purchased
                                                sell          = slot * sell;        //multiply income on sell-off by slot purchased

                                                //below script gets totals
                                                let totalCost   = propertyCost + mngmentCost + renovtnCost; //get cost for all pricing costs
                                                let subTotal    = rent + sell; //gets summation of rent & sell profit for roi
                                                let returnTotal = subTotal + propertyCost; // gets total roi
                                                //end


                                                $('#propertyCost').html('&#8358;'+propertyCost);
                                                $('#managementCost').html('&#8358;'+mngmentCost);
                                                $('#renovationCost').html('&#8358;'+renovtnCost);
                                                $('#totalCost').html('&#8358;'+totalCost);
                                                $('#rent').html('&#8358;'+rent+'<span class="pull-right">(per/year)</span>');
                                                $('#sell').html('&#8358;'+sell);
                                                $('#subTotal').html('&#8358;'+subTotal);
                                                $('#returnTotal').html('&#8358;'+ returnTotal);

                                                $('#propCost').val(propertyCost);
                                                $('#renovCost').val(renovtnCost);
                                                $('#mngCost').val(mngmentCost);
                                            });
                                        });
                                    </script>
                                    <!--START: hidden fields for cost-->
                                    <input type="hidden" name="property_cost" id="propCost" value="{{$property->investment->cost_per_slot}}"/>
                                    <input type="hidden" name="renovation_cost" id="renovCost" value="{{$property->investment->renovation_cost}}"/>
                                    <input type="hidden" name="management_cost" id="mngCost" value="{{$property->investment->management_cost}}">
                                    <input type="hidden" name="investment_id" value="{{\Crypt::encrypt($property->investment->id)}}">
                                    <!--END: hidden fields for cost-->
                                    <table class="table table-responsive table-stripped table-hover grey x5-margin-top x14-font-size">
                                        <tr class="info">
                                            <td>Pick Slot(s)</td>
                                            <td>
                                                <select name="slot" id="slot" class="form-control">
                                                    @for($count = 1; $count <= $property->investment->avail_slots; $count ++)
                                                    <option value="{{Request::old('slot') == '' || Request::old('slot') == Null ? $count : Request::old('slot')}}">{{Request::old('slot') == '' || Request::old('slot') == Null ? $count : Request::old('slot') }}</option>
                                                    @endfor
                                                </select>
                                                @if($errors->has('slot'))
                                                    <p class="maroon x11-font-size">{{$errors->first('slot')}}</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Property Cost</td>
                                            <td id="propertyCost">
                                            &#8358;{{number_format($property->investment->cost_per_slot, 1)}}</td>
                                        </tr>
                                        <tr class="warning">
                                            <td>Renovation Cost</td>
                                            <td id="renovationCost">&#8358;{{number_format($property->investment->renovation_cost, 1)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Management Cost</td>
                                            <td id="managementCost">&#8358;{{number_format($property->investment->management_cost, 1)}}</td>
                                        </tr>
                                        <tr class="info x9-bold">
                                            <td>Total Cost</td>
                                            <td id="totalCost">&#8358;{{number_format($totalCost = App\Http\Controllers\GlobalMethods::sumThree($property->investment->cost_per_slot,$property->investment->renovation_cost,$property->investment->management_cost), 1)}}</td>
                                        </tr>
                                    </table>
                                </div> <!--END: pricing row-->
                                 <!--START: roi row-->
                                 <div class="border-bottom x2-padding x2-margin-top">
                                    <h3 class="grey"> <span class="light-blue underline-text bold">Return on Inve</span>stment</h3>
                                    <table class="table table-responsive table-stripped table-hover grey x5-margin-top x14-font-size">
                                        <tr class="info">
                                            <td>Investment Duration</td>
                                            <td>{{$property->investment->investment_duration}} year (s)</td>
                                        </tr>
                                        <!-- checking if property has rentage feature -->
                                        @if($property->rentage != 0)
                                        <tr>
                                            <td>Profit on rent</td>
                                            <td id="rent">&#8358;{{$rent = number_format($property->investment->profit_per_slot_on_rent, 1)}} <span class="pull-right">(per/year)</span></td>
                                        </tr>
                                        @else
                                        <?php $rent = 0; ?>
                                        @endif
                                        <tr class="{{$property->renatge == 0 ? '' : 'info'}}">
                                            <td>Profit on sell-off</td>
                                            <td id="sell">&#8358;{{$sell = number_format($property->investment->profit_per_slot_on_sell_off, 1)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub-total</td>
                                            <td id="subTotal">&#8358;{{$subTotal = number_format(App\Http\Controllers\GlobalMethods::remove_format($sell) + App\Http\Controllers\GlobalMethods::remove_format($rent),1)}}</td>
                                        </tr>
                                        <tr class="x9-bold info">
                                            <td>Total</td>
                                            <td id="returnTotal">&#8358;{{number_format(App\Http\Controllers\GlobalMethods::sum($property->investment->cost_per_slot, App\Http\Controllers\GlobalMethods::remove_format($subTotal)))}}</td>
                                        </tr>
                                    </table>
                                </div> <!--END: roi row-->
                                 <!--START: payment options row-->
                                 <div class="x2-padding x2-margin-top x14-font-size">
                                    <h3 class="grey"> <span class="light-blue underline-text bold">Payment Op</span>tions</h3>
                                    <div class="form-group x2-margin-left grey x2-padding">
                                        <select name="payment_option" id="payment_option" class="form-control custom">
                                            <option value="btc">BTC</option>
                                            <option value="card">Card</option>
                                            <option value="smartcash">Smartcash</option>
                                        </select>
                                        @if($errors->has('payment_option'))
                                            <p class="maroon x11-font-size"> {{$errors->first('payment_option')}} </p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <!-- START: checking if user is fully verified -->
                                        @if(App\Http\Controllers\GlobalMethods::verified())
                                            <button type="submit" class="btn btn-success btn-lg no-radius">Proceed <i class="fas fa-check"></i></button>
                                        @else
                                            <button type="button" class="btn btn-success btn-lg no-radius" data-toggle="modal" data-target="#warningModal">Proceed <i class="fas fa-check"></i></button>
                                        @endif
                                        <!-- END -->
                                    </div>
                                </div> <!--END: payment options row-->
                            </form>
                       </div>
                       <div class="col-md-4 col-sm-12 col-lg-4 form-border white-bg no-padding">
                            <figure class="border-bottom"><!--START: front image-->
                                <img src="/images/{{$property->property_type}}/{{$property->property_upload_image->front_image}}" alt="property_front_view" class="img img-responsive img-thumbnail image x10-width" />
                            </figure><!--END: front image-->
                            <figure class="border-bottom"><!--START: side image-->
                                <img src="/images/{{$property->property_type}}/{{$property->property_upload_image->side_image}}" alt="property_side_view" class="img img-responsive img-thumbnail image x10-width" />
                            </figure><!--END: side image-->
                            <figure class="border-bottom"><!--START: back image-->
                                <img src="/images/{{$property->property_type}}/{{$property->property_upload_image->back_image}}" alt="property_back_view" class="img img-responsive img-thumbnail image x10-width" />
                            </figure><!--END: back image-->
                       </div>
                    </div>
                </div><!--END: nav result container-->
            </div><!--END: main content column-->
        </div><!--END: overall row-->
    </div><!--END: overall container-->
</section>
@endsection