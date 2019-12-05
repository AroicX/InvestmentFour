@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Properties Report</h1>

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
                            <th>Type</th>
                            <th>Title</th>
                            <th>Cost</th>
                            <th>Country</th>
                            <th>Rentage</th>
                            <th>Investement</th>
                        </tr>
                    </thead>

                    <tbody>


                        @foreach ($properties as $key => $property)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$property->property_type}} </td>
                            <td>{{$property->title}}</td>
                            <td>{{$property->cost}}</td>
                            <td>{{$property->country}}</td>
                            <td>
                                @if($property->rentage == 1)
                                    <span class="badge badge-pill badge-success py-1 px-2">Yes</span>
                                    @else
                                    <a style="text-decoration: none;" href="/admin/property-invest/{{$property->id}}">
                                        <span class="badge badge-pill badge-danger py-1 px-2">No</span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                            
                                    @if($property->investment)
                                    <span class="badge badge-pill badge-success py-1 px-2">Investement</span>
                                    @else
                                    <a style="text-decoration: none;" href="/admin/property-invest/{{$property->id}}">
                                        <span class="badge badge-pill badge-primary py-1 px-2">No Investement</span>
                                    </a>

                                    @endif
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


        $('[id^=response]').click(function () {
            let id = $(this).attr('id');
            id = id.replace("response", "");

            setTimeout(() => {
                $('#get-response').val(id);
            }, 1000)
            console.log(id);

        });

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
