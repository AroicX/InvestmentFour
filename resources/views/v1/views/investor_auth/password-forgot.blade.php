@extends('v1.master.public')

@section('title', 'forgot-password')

<!--START: navbar-->
<section class="navbar-fixed-top no-margin no-padding x10-width">
    <div class="container-fluid no-padding no-margin ">
        <div class="row no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-lg-12 no-margin no-padding">
                @include('v1.components.navigations.homenavbar')
            </div>
        </div>
    </div>
</section>
<!--END: navbar-->

@section('form')
<section class="no-margin-right no-margin-left x2-margin-bottom margin-top-header">
    <div class="container-fluid no-margin text-left x5-padding-top x2-padding-bottom">
    @if(session('status'))
            <div class="row x1-padding mini-width center x3-radius alert alert-success animated fadeIn delay-1s">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size">{{session('status')}} <i class="fa fa-check-circle animated fadeIn delay-2s"></i></label>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="row x1-padding mini-width center x3-radius alert alert-warning animated fadeIn delay-1s">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding">
                    <label for="status" class="x12-font-size maroon">{{session('error')}} <i class="fas fa-info-circle animated fadeIn delay-2s x14-font-size normal-text"></i></label>
                </div>
            </div>
        @endif
        <div class="row x1-padding no-margin form-border mini-width center x3-radius white-bg animated fadeIn slow">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <div class="x2-margin text-center">
                    <i class="fas fa-key large-icon light-blue 3dicon animated swing slower"></i>
                </div>
                <form action="{{ route('password-forgot') }}" method="post" id="login_form">
                    @csrf() <!--csrf() field-->
                    <div class="form-group">
                        <label for="email" class="grey normal">
                            Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control input-lg no-radius" placeholder="Email" value="{{ Request::old('email') }}"/>
                        @if($errors -> has('email'))
                            <span class="maroon normal">{{$errors -> first('email')}} <i class="fa fa-times"></i></span>
                        @endif
                    </div>
                    <div class="form-group x8-margin-top">
                        <button class="btn btn-info btn-lg no-radius btn-20" type="submit">
                            <object data="your.svg" type="image/svg+xml" id="gif" style="visibility:hidden" class="svg-30 no-padding">
                                <img src="/svg/index.circle-slack-loading-icon.svg"/>
                            </object>
                            Reset Password <i class="fas fa-redo-alt"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
