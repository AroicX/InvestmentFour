@extends('v1.master.investor')

@section('title', 'potfolio')

@section('nav')
<section class=" navbar-fixed-top no-margin x10-width">
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
            <div class="col-md-3 col-sm-12 col-lg-3 x2-margin-bottom x5-padding-top white-bg form-border text-center no-padding-left no-padding-right animated fadeIn slow">
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
                    <!--START: result row-->
                    <div class="row no-padding white-bg form-border animated fadeIn slower">
                       <div class="col-md-12 col-sm-12 col-lg-12">
                            <h3 class="light-blue x7-bold">{{strtoupper($transactions->pluck('order')->pluck('investment')->pluck('property_upload')->pluck('title')->first())}}</h3>
                            <h4 class="grey x4-bold"> Transaction History</h4>
                       </div>
                    </div>
                    <div class="row no-padding  border-left border-right  white-bg animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 x1-padding-top">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="result" class="grey x6-bold">
                                                Transaction Date
                                            </label>
                                            <select name="result" id="" class="form-control">
                                                <option value="11/10/2019">11/10/2019</option>
                                                <option value="10/10/2019">10/10/2019</option>
                                                <option value="01/02/2019">01/02/2019</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-lg-6  text-left">
                                        <div class="input-group pull-right">
                                            <label for="result" class="grey x6-bold">
                                                Show entries
                                            </label>
                                            <select name="result" id="" class="form-control">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row no-padding white-bg form-border no-padding  animated fadeIn delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <table class="table table-responsive table-stripped table-hover x2-margin-top">
                                <thead>
                                    <tr class="text-center header-bg">
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Payment Type</th>
                                    </tr>
                                </thead>
                                @foreach($transactions as $transaction)
                                    <tr class="grey">
                                        <td> {!! $transaction->successful == 1? 'Suceessful <i class="fas fa-check green"></i>' : 'Failed <i class="fas fa-times maroon"></i> ' !!} </td>
                                        <td> &#8358;{{number_format($transaction->amount, 2)}} </td>
                                        <td> {{$transaction->created_at}} </td>
                                        <td> {{$transaction->type}} </td>
                                    </tr>
                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                    <!--END: result row-->
                    <div class="row x1-margin-top animated fadeIn slow delay-1s">
                        <div class="col-md-12 col-sm-12 col-lg-12 x2-padding-top form-border white-bg bottom-border-radius">
                            <a href="" class="btn btn-primary btn-lg x2-margin-right x2-margin-bottom no-radius">Export as Excel <i class="fas fa-file-excel"></i></a>
                            <a href=" {{route('generatepdf', \Crypt::encrypt($transactions->pluck('order')->pluck('id')))}} " class="btn btn-primary btn-lg x2-margin-bottom no-radius">Export as Pdf <i class="fas fa-file-pdf"></i></a>
                        </div>
                    </div>
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