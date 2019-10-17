@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 mx-auto">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body animated fadeIn delay-1s" >
                    <h3 class="align-items-center text-cneter f-12">Add New Post</h3>


                    <form action="{{ url('/admin/create-blog-post') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" class="form-control" type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label for="image">Add Image</label>
                            <input id="image" class="form-control" type="file" name="image">
                        </div>

                        <div class="form-group h-30">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-warning">Post </button>
                            <button class="btn btn-info">Save</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
       

    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector: 'textarea' });</script>
@endsection