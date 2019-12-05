@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User Report</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reports</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($investors as $key => $investor)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$investor->first_name}} {{$investor->last_name}}</td>
                            <td>{{$investor->email}}</td>
                            <td>{{$investor->phone}}</td>
                            <td>{{$investor->country}}</td>
                            <td>
                                @if($investor->active != 1)
                                <span class="badge badge-pill badge-danger">No</span>
                                @else
                                <span class="badge badge-pill badge-success">Yes</span>

                                @endif

                            </td>
                            <td>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink" x-placement="bottom-end"
                                        style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">
                                        <div class="dropdown-header">Options</div>
                                        <a class="dropdown-item edit-investor" href="#" id="{{$investor->id}}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/users-report-deactive/{{$investor->id}}">
                                            @if($investor->active != 1)
                                            Activate
                                            @else

                                            Deactivate
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" style="">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit investor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-close"></i></button>
                </div>
                <form action="{{ url('admin/users-report-edit') }}" method="post"
                      enctype="multipart/form-data" name="form" id="form">
                    <input type="hidden" name="id" autocomplete="off" style="background:#ffffff;"
                           class="form-control" placeholder="" required>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="modal-body">
              
                            <div class="form-group">

                                <input  class="form-control"  type="hidden" name="id">
                            </div>

                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input  class="form-control" type="text" name="firstname">
                            </div>

                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input  class="form-control" type="text" name="lastname">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input  class="form-control" type="text" name="phone">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input  class="form-control" type="email" name="email">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input  class="form-control" type="text" name="country">
                            </div>




                           
                                <button type="submit" class="btn btn-facebook btn-block"
                                        >Update
                                </button>
                            
                        </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection


@section('js')

{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });


        // $('[id^=response]').click(function () {
        //     let id = $(this).attr('id');
        //     id = id.replace("response", "");

        //     setTimeout(() => {
        //         $('#get-response').val(id);
        //     }, 1000)
        //     console.log(id);

        // });

    });

    //Ajax Load data from ajax
    $(function () {

        $('.edit-investor').click(function () {
            var id = $(this).attr('id');

            // console.log(id);

            $.ajax({
                url: "/admin/get-investor/" + id,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    console.log(data);
                    $('#view_modal').modal('show'); // show bootstrap modal when complete loaded
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
