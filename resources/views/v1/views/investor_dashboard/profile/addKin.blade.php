@extends('v1.master.investor')

@section('title', 'add information')

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
    <div class="container-fluid x1-margin-bottom x9-width x14-font-size">
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
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border">
                            <h1 class="text-center grey bold">Add Information</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!-- START: current page icon -->
                    <div class="row text-center border-right border-left no-margin-top  animated fadeIn delay-2s">
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor off-color  text-left x16-font-size x1-margin"> <i class="far fa-user"></i> User Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding header-bg">
                            <span class="hand-cursor x16-font-size white bold x1-margin"> <i class="fas fa-child"></i> N-Kin Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor off-color text-left x16-font-size x1-margin"> <i class="far fa-building"></i> Bank Information</span>
                        </div>
                    </div>
                    <!-- END -->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius text-center x3-padding x2-margin-bottom form-border animated fadeIn delay-2s">
                            <form action="{{ route('addKin') }}" method="post" class="x12-font-size x8-width center">
                            @csrf() <!--csrf() field-->
                                <div class="x10-width text-left">
                                    <div class="form-group text-left x10-margin-top">
                                        <label for="fullName" class="grey normal x4-margin-left">Full name</label>
                                        <input type="text" name="fullName" id="fullName" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ $kin_info === Null ? e(Request::old('fullName')) : e(ucwords($kin_info->full_name)) }}" {{ $kin_info === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('fullName'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('fullName')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x4-margin-top">
                                        <label for="email" class="grey normal x4-margin-left">Email</label>
                                        <input type="email" name="email" id="email" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ $kin_info === Null ? e(Request::old('email')) : e($kin_info->email) }}" {{ $kin_info === Null ? '' : 'disabled' }} />
                                        @if($errors -> has('email'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('email')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left">
                                        <label for="phone" class="grey normal x4-margin-left">Phone</label>
                                        <input type="number" name="phone" id="phone" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ $kin_info === Null ? e(Request::old('fullName')) : e($kin_info->phone) }}" {{ $kin_info === Null ? '' : 'disabled' }} />
                                        @if($errors -> has('phone'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('phone')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x4-margin-top">
                                        <label for="address" class="grey normal x4-margin-left">Address</label>
                                        <input type="text" name="addressed" id="address" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value="{{ $kin_info === Null ? e(Request::old('address')) : e(ucfirst($kin_info->address)) }}" {{ $kin_info === Null ? '' : 'disabled' }}/>
                                        @if($errors -> has('address'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('address')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x4-margin-top">
                                        <label for="country" class="grey normal x4-margin-left">Country</label>
                                        <select name="country" id="country" class="form-control input-lg x4-margin-left x9-width no-radius grey" {{$kin_info === Null ? '' : 'disabled'}}>
                                            <option value="{{!empty(Request::old('country')) ? Request::old('country') : $kin_info === Null ? '' : $kin_info->country }}" selected>{{!empty(Request::old('country')) ? Request::old('country') : $kin_info === Null ? 'Select Country' : e(ucfirst($kin_info->country)) }}</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country}}">{{e(ucfirst($country))}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors -> has('country'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('country')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-left x4-margin-top">
                                        <label for="relationship" class="grey normal x4-margin-left">Relationship</label>
                                        <select name="relation" id="relation" class="form-control input-lg x4-margin-left x9-width no-radius grey" {{ $kin_info === Null ? '' : 'disabled' }}>
                                            <option value="{{!empty(Request::old('relation')) ? Request::old('relation') : $kin_info === Null ? '' : $kin_info->relationship }}" selected>{{!empty(Request::old('relation')) ? Request::old('relation') : $kin_info === Null ? 'Select Relationship' : e(ucfirst(App\Http\Controllers\GlobalMethods::getRelationship($kin_info->relationship))) }}</option>
                                            @foreach($relationships as $relationship)
                                                <option value="{{$relationship->id}}">{{ucfirst($relationship->type)}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors -> has('relation'))
                                            <span class="maroon normal x4-margin-left">{{$errors -> first('relation')}} <i class="fa fa-times"></i></span>
                                        @endif
                                    </div>
                                    <div class="form-group text-right x5-margin-top x4-margin-left x6-padding-right">
                                        @if (!$kin_info) 
                                            <a href="{{ route('addPersonal') }}" class="pull-left btn btn-default no-radius btn-lg maroon"> <i class="fas fa-arrow-left animated wobble delay-4s slower infinite"></i> Back</a>
                                            <button class="btn btn-info btn-lg no-radius" type="submit">
                                                Save and Continue <i class="fas fa-arrow-right"></i>
                                            </button>
                                        @else
                                            <div class="text-left">
                                                <a href="{{ route('addPersonal') }}" class="btn btn-default btn-lg no-radius maroon"> <i class="fas fa-arrow-left animated wobble delay-4s slower infinite"></i> Back</a>
                                                <a href=" {{ route('addBank') }} " class="pull-right btn btn-default btn-lg no-radius light-blue"> Continue <i class="fas fa-arrow-right animated wobble delay-4s slower infinite"></i> </a>
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