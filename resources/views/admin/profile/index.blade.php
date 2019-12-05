@extends('admin.layout.master')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>

    </div>


    <div class="row">

        <div class="col-lg-6">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    {{$user->name}}
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/settings-updatePassword')}}" method="POST">

                        {{csrf_field()}}
                        {{-- <h5 class=" text-gray-400 px-2 py-2">Change Password</h5> --}}

                        <div class="form-group">
                            <label for="old-password">Old Password</label>
                            <input id="old-password" class="form-control" type="password" name="old" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input id="new-password" class="form-control" type="password" name="new" required>
                        </div>

                        <div class="form-group">
                            <label for="con-password">Confirm Password</label>
                            <input id="con-password" class="form-control" type="password" name="con" required>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-facebook btn-block ">Done</button>
                        </div>




                    </form>
                </div>
            </div>



        </div>

        <div class="col-lg-6">

            <!-- Default Card Example -->
            <div class="card mb-4">
                <div class="card-header">
                    @if($user->role == 'super_admin')
                    <button class="btn btn-facebook btn-block" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo">Add Administrator</button>
                    @else

                    <h5>List of Administrators</h5>
                    @endif

                </div>
                <div class="card-body">
                    <h5 class="text-500">Administrator's</h5>

                    <ul class="list-unstyled">

                        @foreach ($admins as $key => $admin)
                        <li> {{$key + 1}}. {{$admin->name}} -
                            <span>

                                @if($admin->role == 'super_admin')
                                Super Administrator

                                @endif
                                @if($admin->role == 'normal_admin')
                                Normal Administrator
                                @endif
                                @if($admin->role == 'content_developer')
                                Content Developer
                                @endif
                                @if($admin->role == 'customer_care')
                                Customer Care
                                @endif

                            </span>

                            @if($user->role == 'super_admin')
                            <a href="#" id="{{$admin->id}}"
                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm edit-admin"><i
                                    class="fas fa-pen fa-sm text-white-50"></i></a>

                            @endif

                        </li>

                        @endforeach
                    </ul>

                </div>
            </div>



        </div>




        <div class="modal fade bd-example-modal-md" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Administrator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/admin/add-new-Administrator') }}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" class="form-control" type="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" type="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" type="password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role">
                                    <option value="content_developer">Content Developer</option>
                                    <option value="customer_care">Customer Care</option>
                                    <option value="normal_admin">Normal Administrator</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger btn-block" type="submit">Save</button>
                            </div>



                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

@endsection



@section('js')

<script>
    $(function () {

        $('.edit-admin').click(function () {
            var id = $(this).attr('id');

            console.log(id);

            return false;

            $.ajax({
                url: "/admin/get-investor/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#view_modal').modal(
                        'show'); // show bootstrap modal when complete loaded
                    $('[name="id"]').val(data.id);
                    $('[name="firstname"]').val(data.first_name);
                    $('[name="lastname"]').val(data.last_name);
                    $('[name="email"]').val(data.email);
                    $('[name="phone"]').val(data.phone);
                    $('[name="country"]').val(data.country);

                    // $('[name="measure"]').val(data.measure);
                    // $('[name="rp"]').val(data.rp);
                    // $('[name="price"]').val(data.price);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error Retrieving Data!');
                }
            });


        });
    });

</script>
@endsection
