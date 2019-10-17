@extends('v1.master.public')

@section('title', 'blog')

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
<section>
    <div class="container-fluid x8-width no-padding-top no-margin-top-header x2-margin-bottom animated fadeIn slow delay-1s">
        <div class="row white-bg form-border bottom-border-radius">
            <div class="col-md-12 col-sm-12 col-lg-12 x1-padding">
                @if($blogs)
                    @foreach($blogs as $blog_post)
                        <div class="x8-width center"> <!--START: div contains contents of the blog post-->
                            <h1 class="black-2 bolder heading-2 no-margin-top press-heading">{!! ucfirst($blog_post->title) !!}</h1>
                            <p class="black-2 x14-font-size x2-margin-top">Read time: {{App\Http\Controllers\GlobalMethods::readTime($blog_post->content)}}  <span class="dot"></span> <span class="read-time">{{date('d-M-Y', strtotime($blog_post->created_at))}}</span></p>
                            <img src="/storage/blog/{{$blog_post->image}}" alt="Post Image" class="img img-responsive img-square press-post-image">
                            <p class="x14-font-size black-2 x2-margin-top">
                                {!! nl2br($blog_post->content) !!}
                            </p>
                        </div> <!--END-->
                    @endforeach
                @endif
            </div>
            @if(App\Http\Controllers\AppController::getLastPosts(\Crypt::encrypt($blogs->pluck('id')->first())))
            <div class="col-md-12 col-sm-12 col-lg-12 x2-padding">
                <div class="container-fluid x1-margin-top x5-margin-bottom">
                    <div class="row x8-margin-top">
                        @foreach(App\Http\Controllers\AppController::getLastPosts(\Crypt::encrypt($blogs->pluck('id')->first())) as $posts)
                            <div class="col-md-4 col-sm-12 col-lg-4">
                                <div class="panel panel-default cast-shadow">
                                    <div class="panel-heading no-padding">
                                        <img src="/storage/blog/{{$posts->image}}" alt="post-image" class="img img-responsive blog-post-images blurred">
                                        <h3 class="text-center no-margin x2-padding black-2 bold">{{ ucfirst($posts->title) }}</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p class="black-2">
                                            {{ str_limit($posts->content, 50) }}
                                        </p>
                                        <p class="black-2 text-left no-margin-bottom"> <i class="far fa-clock light-blue"></i> Read time: {{App\Http\Controllers\GlobalMethods::readTime($posts->content)}}</p>
                                    <p class="black-2 text-left no-margin-top"> <i class="far fa-calendar light-blue"></i> {{date('d-M-Y', strtotime($posts->created_at))}}</p>
                                        <a href="{{route('getpresspost', \Crypt::encrypt($posts->id))}}" class="btn btn-info no-radius">Read More</a>
                                        <i class="pull-right {{$posts->lead_post ? 'fas' : 'far'}} fa-star x3-margin-top light-blue" title="{{$posts->lead_post ? 'Lead Post' : 'Normal Post'}}"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
</section>
@endsection