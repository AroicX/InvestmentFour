@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Page Control</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>



    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->


        <div class="col-xl-12 col-md-6 mb-4">

            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#aboutUs"
                                aria-expanded="true" aria-controls="aboutUs">
                                About Us
                            </button>
                        </h5>
                    </div>

                    <div id="aboutUs" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">About Page</h1>
                                <a href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                        class="fas fa-pen fa-sm text-white-50"></i></a>
                            </div>
                            <img class="img-responsive w-100" src="/images/{{$about->header_image}}" alt="header image">
                            <p><b>Summary:</b> {!! $about->summary !!}</p>
                            <p><b>Who we are:</b> {!! $about->who_we_are !!}</p>
                            <p><b>What we do:</b> {!! $about->what_we_do !!}</p>
                            <p><b>Our Essence:</b> {!! $about->our_essence !!}</p>
                            {{-- {{$about}} --}}
                        </div>
                    </div>
                </div>



                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#contactus"
                                aria-expanded="false" aria-controls="contactus">
                                Contact Us
                            </button>
                        </h5>
                    </div>
                    <div id="contactus" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <h1 class="h3 mb-0 text-gray-800">ContactUs Page</h1>

                            </div>

                            @foreach ($contact as $item)
                            <ul>
                                <li>Title: {{$item->title}}</li>
                                <li>Content: {{$item->content}} <a href="/admin/page-control-contact/{{$item->id}}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                            class="fas fa-pen fa-sm text-white-50"></i></a></li>


                            </ul>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#team"
                                aria-expanded="false" aria-controls="team">
                                Team
                            </button>
                        </h5>
                    </div>
                    <div id="team" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    @foreach ($team as $mem)

                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <a style="text-decoration: none;" href="/admin/page-control-team/{{$mem->id}}">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div
                                                                class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                {{$mem->name}}</div>
                                                            <div
                                                                class=" mb-0 font-weight-bold text-gray-800 text-uppercase">
                                                                {{$mem->position}}</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <img class="img-responsive rounded-circle " width="50px"
                                                                height="50px" src="/images/{{$mem->image_file}}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>



    </div>
</div>

</div>




@include('admin.pages.modal-about')
{{-- @include('admin.pages.modal-contact') --}}

@endsection



@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });

</script>
@endsection
