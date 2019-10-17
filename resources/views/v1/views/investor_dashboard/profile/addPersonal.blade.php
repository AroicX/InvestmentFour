@extends('v1.master.investor')

@section('title', 'ticket')

@section('nav')
<section class=" navbar-fixed-top no-margin x10-width animated fadeIn slower">
    <div class="container-fluid no-margin no-padding">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                @include('v1.components.navigations.investorNav.genNav')
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<section>
    <div class="container-fluid flex x1-margin-bottom x9-width">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slower">
                <div class="x5-padding-bottom x0-margin-left x0-margin-right border-bottom">
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
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border x2-radius">
                            <h1 class="text-center grey bold">Add Information</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <div class="row text-center border-right border-left white-bg no-margin-top animated fadeIn delay-2s">
                        <div class="col-md-4 col-sm-12 col-lg-4 header-bg x2-padding">
                            <span class="hand-cursor bold text-left x16-font-size x1-margin"> <i class="far fa-user"></i> User Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor x16-font-size off-color x1-margin"> <i class="fas fa-child"></i> N-Kin Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor off-color text-left x16-font-size x1-margin"> <i class="far fa-building"></i> Bank Information</span>
                        </div>
                    </div>
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius text-center x3-padding-left x3-padding-right x3-padding-top x3-padding-bottom x2-margin-bottom form-border animated fadeIn delay-2s">
                            <form action="{{ route('addPersonal') }}" method="post" class="x12-font-size x8-width center">
                            @csrf() <!--csrf() field-->
                                @if(session('error'))
                                        <div class="form-group text-center no-padding alert alert-warning animated fadeIn delay-1s">
                                            <label for="status" class="x12-font-size maroon">{{session('error')}} <i class="far fa-frown-open animated fadeIn delay-2s x14-font-size normal-text"></i></label>
                                        </div>
                                @endif
                                <div class="x10-width text-left">
                                    <div class="form-group text-left x10-margin-top">
                                        <label for="firstName" class="grey normal x4-margin-left">First name</label>
                                        <input type="text" name="firstName" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ Auth::user()->first_name === Null ? e(Request::old('firstName')) : e(ucfirst(Auth::user()->first_name)) }}"  {{ Auth::user()->first_name === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('firstName'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('firstName')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x3-margin-top">
                                        <label for="lastName" class="grey normal x4-margin-left">Last name</label>
                                        <input type="text" name="lastName" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ Auth::user()->last_name === Null ? e(Request::old('lastName')) : e(ucfirst(Auth::user()->last_name)) }}"  {{ Auth::user()->last_name === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('lastName'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('lastName')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x3-margin-top">
                                        <label for="address" class="grey normal x4-margin-left">Address</label>
                                        <input type="text" name="addresss" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ Auth::user()->address === Null ? e(Request::old('address')) : e(ucfirst(Auth::user()->address)) }}"  {{ Auth::user()->address === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('address'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('address')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x3-margin-top">
                                        <label for="state" class="grey normal x4-margin-left">State</label>
                                        <select name="state" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" {{Auth::user()->state === Null ? '' : 'disabled'}}>
                                            <option value="{{Request::old('state') === '' ? '' : Auth::user()->state === Null ? Request::old('state') : Auth::user()->state }}" selected> {{Request::old('state') === '' ? 'Select State' : Auth::user()->state === Null ? Request::old('state') : e(ucfirst(Auth::user()->state)) }}</option>
                                            <option value="Abuja">Abuja, FCT</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Port Harcourt">Port Harcourt</option>
                                        </select>
                                        @if($errors -> has('state'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('state')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x3-margin-top">
                                        <label for="city" class="grey normal x4-margin-left">City</label>
                                        <input type="text" name="city" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ Auth::user()->city === Null ? e(Request::old('city')) : e(ucfirst(Auth::user()->city)) }}"  {{ Auth::user()->city === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('city'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('city')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group x3-margin-top x2-margin-right">
                                        @if (Auth::user()->first_name === Null && Auth::user()->last_name === Null && Auth::user()->adress === Null  && Auth::user()->state === Null && Auth::user()->city === Null)
                                            <div class="text-right">
                                                <button class="btn btn-info btn-lg no-radius x4-margin-right" type="submit">Save and continue <i class="fas fa-arrow-right normal"></i></button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <a href="{{ route('addKin') }}" class="x4-margin-right btn btn-default btn-lg no-radius light-blue">Continue <i class="fas fa-arrow-right animated wobble delay-4s slower infinite"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--END: result row-->
                </div>
                <!--END: nav result container-->
            </div>
            <!--END: main content column-->
        </div>
        <!--END: overall row-->
    </div>
    <!--END: overall container-->
</section>
@endsection