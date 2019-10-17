@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">

        @foreach ($posts as $key => $post)

        <div class="col-lg-4">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{$post->title}}
                         <p class="black-2 x14-font-size x2-margin-top">Read time: {{App\Http\Controllers\GlobalMethods::readTime($post->content)}}  <span class="dot"></span> <span class="read-time">{{date('d-M-Y', strtotime($post->created_at))}}</span></p>
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink" x-placement="bottom-end"
                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">
                            <div class="dropdown-header">Options</div>
                            <a class="dropdown-item" href="/admin/edit-post/{{$post->id}}">Edit</a>
                            <a class="dropdown-item" href="/admin/draft-post/{{$post->id}}">Disabled</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/admin/delete-post/{{$post->id}}">Delete</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                       
                        <img src="/storage/blog/{{$post->image}}" alt="Post Image" class="img img-responsive w-100 h-50">

                </div>
            </div>

          

        </div>

        @endforeach

    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector: 'textarea' });</script>
@endsection