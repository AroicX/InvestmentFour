@extends('admin.layout.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Payment Control</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Payment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Transfer Amount</th>
                            <th>Transfer Note </th>
                            <th>Transfer Reference </th>
                            <th>Recipient Code </th>
                            <th>Bank Code or Slug</th>
                            <th>Account Number</th>
                            <th>Account Name </th>
                            <th>Email Address </th>
                        </tr>
                    </thead>

                    <tbody>


                        @if($invest)
                        @foreach ($invest as $key => $payment)

                        <?php
                            $bankInfo = \App\BankDetail::where('investor_id',$payment->order[0]->investor_id)->first();
                          ?>


                        <tr>
                            <td> {{ $payment->order[0]->transaction[0]->amount }}</td>
                            <td> You have been successfully paid
                                &#8358;{{e(number_format(doubleval($payment->order[0]->transaction[0]->amount), 2))}}
                                for your investment !</td>
                            <td> {{ $payment->amount }}</td>
                            <td> {{ $payment->amount }}</td>
                            <td>
                                <?php
                                  $getBank = \App\Bank::where('bank_id',$bankInfo->bank_id)->first();
                                  
                                  echo $getBank->bank;
                                ?>
                            </td>
                            <td>
                                <?php
                                  $getBankDetails = \App\BankDetail::where('investor_id',$payment->order[0]->investor_id)->first();
                                  
                                  echo  Crypt::decrypt($getBankDetails->acc_number);
                                ?>
                            </td>
                            <td> {{ $payment->order[0]->investor->first_name .' '. $payment->order[0]->investor->last_name }}
                            </td>
                            <td> {{ $payment->order[0]->investor->email }}</td>
                        </tr>

                        @endforeach

                        @else
                        <div class="alert alert-primary" role="alert">
                            <p class="alert">No Payment due Yet.</p>
                        </div>

                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
@endsection


@section('js')

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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

</script>
@endsection
