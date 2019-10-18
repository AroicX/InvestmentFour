@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tickets Control</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more
        information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
            DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tickets</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>Satisfied</th>
                            <th>Response</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                   
                    <tbody>

                        @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{$ticket->id}}</td>
                            <td>{{$ticket->ticket_subject->subject}}</td>
                            <td>{{$ticket->message}}</td>
                            <td>
                                @if ($ticket->satisfied == 0)
                                <span class="badge badge-pill badge-danger">No</span>
                                @else
                                <span class="badge badge-pill badge-success">Yes</span>

                                @endif
                            </td>
                            <td>
                                @foreach($responses as $response)
                                    @if($ticket->id != $response->ticket_message_id)
                                    {{-- <span class="badge badge-pill badge-danger">No</span> --}}
                                    @else
                                    <span class="badge badge-pill badge-success">Yes</span>
    
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$ticket->created_at}}</td>
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
                                        <a class="dropdown-item" href="/admin/ticket-edit/{{$ticket->id}}" >Reply</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="/admin/ticket-delete/{{$ticket->id}}">Delete</a>
                                    </div>
                                </div></button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

</div>
@endsection


@section('js')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('[id^=response]').click(function () {
            let id = $(this).attr('id');
            id = id.replace("response", "");

           setTimeout(()=>{
            $('#get-response').val(id);
           },1000)
            console.log(id);

        });

    });

</script>
@endsection
