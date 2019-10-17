@extends('admin.layout.master')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Member <b class="text-uppercase">{{$team->name}}</b> </h1>
        <a href="/admin/page-control" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Back</a>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-xl-12 col-md-12 mb-4 mx-auto">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body ">


                        <form action="{{ url('/admin/page-control-team') }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group">
                                <label for="team_role">Team Roles</label>
                                <select class="form-control" name="team_role" id="">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <img class="img-responsive rounded-circle" width="200px" height="200px"
                                    src="/images/{{$team->image_file}}" alt="">
                                <br />

                                <label for="image">Image</label>
                                <input id="image" class="form-control" type="file" name="image">
                            </div>

                            <input type="hidden" name="id" value="{{$team->id}}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="text" name="name" value={{$team->name}}>
                            </div>

                            <div class="form-group">
                                <label for="position">Position</label>
                                <input id="position" class="form-control" type="text" name="position"
                                    value={{$team->position}}>
                            </div>

                            <div class="form-group">
                                <label for="facebook_link">Facebook</label>
                                <input id="facebook_link" class="form-control" type="text" name="facebook_link"
                                    value={{$team->facebook_link}}>
                            </div>
                            <div class="form-group">
                                <label for="twitter_link">Twitter</label>
                                <input id="twitter_link" class="form-control" type="text" name="twitter_link"
                                    value={{$team->twitter_link}}>
                            </div>

                            <div class="form-group">
                                <label for="instagram_link">Instagram</label>
                                <input id="instagram_link" class="form-control" type="text" name="instagram_link"
                                    value={{$team->instagram_link}}>
                            </div>

                            <div class="form-group">
                                <label for="discord_link">Discord</label>
                                <input id="discord_link" class="form-control" type="text" name="discord_link"
                                    value={{$team->discord_link}}>
                            </div>




                            <button type="submit" class="btn btn-primary">Update</button>


                        </form>


                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection
