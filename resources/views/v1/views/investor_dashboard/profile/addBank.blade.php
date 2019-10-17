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
    <div class="container-fluid flex x1-margin-bottom x9-width x14-font-size">
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
                @if(session('title') && session('body'))
                    <div class="modal show animated slideDown slow x5-margin-top x10-margin-left" id="myModal">
                        <div class="modal-dialog no-radius">
                            <div class="modal-content">
                                <div class="modal-header navbar-bg">
                                    <button class="close  no-radius btn btn-primary" data-dismiss="modal" onclick = "$('.modal').removeClass('show').addClass('fade');"></button>
                                    <h4 class="white bold no-margin x16-font-size"> <i class="fas fa-info-circle"></i> {{session('title')}}</h4>
                                </div>
                                <div class="modal-body grey-bg-light">
                                    <p class="lead transparent x14-font-size">{{session('body')}}</p>
                                </div>
                                <div class="modal-footer grey-bg-light">
                                    <button class="btn btn-danger btn-den btn-lg no-radius white" data-dismiss="modal" onclick = "$('.modal').addClass('animated fadeOut slower').removeClass('show');"> Close <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!--START: nav result container-->
                <div class="container-fluid">
                    <!--START: heading row-->
                    <div class="row no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg form-border x2-radius">
                            <h1 class="text-center grey bold">Add Information</h1>
                        </div>
                    </div>
                    <!--END: heading row-->
                    <!-- START: current page icon -->
                    <div class="row text-center border-right border-left no-margin-top animated fadeIn delay-2s">
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor off-color  text-left x16-font-size x1-margin"> <i class="far fa-user"></i> User Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding">
                            <span class="hand-cursor x16-font-size off-color x1-margin"> <i class="fas fa-child"></i> N-Kin Information</span>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4 x2-padding header-bg">
                            <span class="hand-cursor white bold text-left x16-font-size x1-margin"> <i class="far fa-building"></i> Bank Information</span>
                        </div>
                    </div>
                    <!-- END -->
                    <!--START: result row-->
                    <div class="row no-padding x1-margin-bottom ">
                        <div class="col-md-12 col-sm-12 col-lg-12 white-bg bottom-border-radius text-center x3-padding x2-margin-bottom form-border animated fadeIn delay-2s">
                            <form action=" {{ route('addBank') }} " method="post" class="x12-font-size x8-width center x15-padding-bottom">
                            @csrf() <!--csrf() field-->
                                <div class="form-group text-left x10-margin-top">
                                    <label for="accName" class="grey normal x4-margin-left">Account name</label>
                                    <input type="text" name="acc_name" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value=" {{ $bank_detail === Null ? e(Request::old('acc_name')) : e(ucwords(Crypt::decrypt($bank_detail->acc_name))) }} " {{ $bank_detail === Null ? '' : 'disabled' }}/>
                                    @if ($errors->has('acc_name'))
                                        <span class="maroon normal x4-margin-left">{{$errors -> first('acc_name')}} <i class="fa fa-times"></i></span>
                                    @endif
                                    @if (session('error'))
                                        <span class="maroon normal x4-margin-left">{{session('error')}} <i class="fa fa-times"></i></span>
                                    @endif
                                </div>
                                <div class="form-group text-left x3-margin-top">
                                    <label for="acc_number" class="grey normal x4-margin-left">Account number</label>
                                    <input type="{{ $bank_detail === Null ? 'number' : Request::old('acc_number') === '' ? 'number' : 'text' }}" name="acc_number" id="" class="form-control input-lg x4-margin-left x9-width no-radius grey" placeholder="Type here" value=" {{ $bank_detail === Null ? e(Request::old('acc_number')) : e(ucfirst(Crypt::decrypt($bank_detail->acc_number))) }} " {{ $bank_detail === Null ? '' : 'disabled' }}/>
                                    @if ($errors->has('acc_number'))
                                        <span class="maroon normal x4-margin-left">{{$errors -> first('acc_number')}} <i class="fa fa-times"></i></span>
                                    @endif
                                </div>
                                <div class="form-group text-left x3-margin-top">
                                    <label for="bankName" class="grey normal x4-margin-left">Bank</label>
                                    <select name="bank" id="bank" class="form-control input-lg x4-margin-left x9-width no-radius grey" {{$bank_detail === Null ? '' : 'disabled'}}>
                                    <option value="{{!empty(Request::old('bank')) ? Request::old('bank') : $bank_detail === Null ? '' : $bank_detail->bank }}" selected>{{!empty(Request::old('bank')) ? Request::old('bank') : $bank_detail === Null ? 'Select Bank' : e(ucfirst(App\Http\Controllers\GlobalMethods::getStaticBank($bank_detail->bank_id))) }}</option>
                                    @for($count = 0; $count < count($bank_id); $count++)
                                        <option value=" {{$bank_id[$count]}} ">{{e(ucfirst($bank[$count]))}}</option>
                                    @endfor
                                    </select>
                                    @if ($errors->has('bank'))
                                        <span class="maroon normal x4-margin-left">{{$errors -> first('bank')}} <i class="fa fa-times"></i></span>
                                    @endif
                                </div>
                                <div class="form-group text-right x5-margin-top x5-margin-right x4-margin-left">
                                    @if (!$bank_detail)
                                        <a href="{{ route('addKin') }}" class="pull-left btn btn-default btn-lg no-radius"> <i class="fas fa-arrow-left"></i> Back</a>
                                        <button class="btn btn-info btn-lg no-radius" type="submit">
                                            Save and Exit <i class="fas fa-check-circle"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('addKin') }}" class="pull-left btn btn-default btn-lg maroon no-radius"> <i class="fas fa-arrow-left animated wobble delay-4s slower infinite"></i> Back</a>
                                        <a class="btn btn-default no-radius btn-lg light-blue" href=" {{  route('info') }} ">
                                            Done <i class="fas fa-check"></i>
                                        </a>
                                    @endif
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