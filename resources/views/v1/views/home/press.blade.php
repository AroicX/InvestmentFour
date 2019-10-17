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
        <div class="row no-padding x1-margin-bottom transparent">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center no-padding no-margin text-center">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-lg-3 no-padding">
                            <div class="panel noborder no-margin transparent">
                                <div class="panel-heading navbar-bg no-radius">
                                    <h4 class="white bold heading-2"> <i class="far fa-newspaper"></i> Headlines</h4>
                                </div>
                                <div class="panel-body no-padding no-radius">
                                    @if(App\Http\Controllers\AppController::getLeadPosts($blogs->pluck('id')->first()))
                                        <ul class="list-group no-border no-margin">
                                            @foreach(App\Http\Controllers\AppController::getLeadPosts($blogs->pluck('id')->first()) as $blog_posts)
                                                <li class="list-group-item nav-zoom blog-list x4-padding text-left x13-font-size"> <a href="{{route('getpresspost', \Crypt::encrypt($blog_posts->id))}}" class="normal-link block"> {!! nl2br(substr(ucfirst($blog_posts->title), 0, 15)) !!} </a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-lg-9 no-padding">
                            <figure id="post-header-img">
                                <img src="/images/{!! nl2br($blogs->pluck('image')->first()) !!}" alt="Post Image" title="Post Image" class="img img-responsive"/>
                                <a href="{{route('getpresspost', \Crypt::encrypt($blogs->pluck('id')->first()))}}"><figcaption class="press-figcaption x16-font-size no-margin"> {{strtoupper($blogs->pluck('title')->first())}} </figcaption></a>
                            </figure>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row no-padding-left no-padding-right x5-padding-bottom white-bg form-border x4-radius blog-page-margin-top">
            <h3 class="bolder grey about-margin x2-margin-left x3-margin-top heading-2"> <span class="light-blue">BLO</span>G </h3>
            <div class="col-md-12 col-sm-12 col-lg-12 text-left">
              <!-- START: container for blog posts -->
              <div class="container-fluid">
                <div class="row">
                    @if(App\Http\Controllers\AppController::getAllBlogPost(\Crypt::encrypt($blogs->pluck('id')->first())))
                        @foreach(App\Http\Controllers\AppController::getAllBlogPost(\Crypt::encrypt($blogs->pluck('id')->first())) as $blogPosts)
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="panel panel-default cast-shadow" style="border:0">
                                <div class="panel-heading no-padding" style="border:0">
                                    <img src="storage/blog/{{$blogPosts->image}}" alt="Post image" class="img img-responsive blurred blog-post-images">
                                    <h4 class="black-2 bolder text-center grey-bg-light no-margin x3-padding"> {!! ucfirst($blogPosts->title) !!} </h4>
                                </div>
                                <div class="panel-body x1-padding-top">
                                    <p class="black-2 text-left"> {!!str_limit($blogPosts->content, 80)!!} </p>
                                    <p class="black-2 text-left no-margin-bottom"> <i class="far fa-clock light-blue"></i> Read time: {{App\Http\Controllers\GlobalMethods::readTime($blogPosts->content)}}</p>
                                    <p class="black-2 text-left no-margin-top"> <i class="far fa-calendar light-blue"></i> {{date('d-M-Y', strtotime($blogPosts->created_at))}}</p>
                                    <a href="{{route('getpresspost', \Crypt::encrypt($blogPosts->id))}}" class="btn btn-info no-radius">Read More</a>
                                    <i class="pull-right {{$blogPosts->lead_post ? 'fas' : 'far'}} fa-star x3-margin-top light-blue" title="{{$blogPosts->lead_post ? 'Lead Post' : 'Normal Post'}}"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
              </div>
              <!-- END -->
              <!-- START: blog post pagination links -->
              <div class="text-right x3-margin-top">
                {!! App\Http\Controllers\AppController::getAllBlogPost(\Crypt::encrypt($blogs->pluck('id')->first()))->links() !!}
              </div>
              <!-- END -->
            </div>
        </div>
    </div>
    
</section>
@endsection