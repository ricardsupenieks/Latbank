@extends('layout')

@section('content')
<body class="text-gray-900 tracking-wider leading-normal">


<!--Container-->
<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">

    <!--Title-->
    <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
       Transactions
    </h1>


    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Receiver</th>
                <th data-priority="2">Action</th>
                <th data-priority="3">Amount</th>
                <th data-priority="4">Currency</th>
                <th data-priority="5">Date</th>
                <th data-priority="5">Time</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{$transaction['receiver']}}</td>
                <td>{{ucfirst($transaction['transaction'])}}</td>
                <td>{{number_format($transaction['amount'],2)}}</td>
                <td>{{$transaction['currency']}}</td>
                <td>{{strtok($transaction['created_at'], ' ')}}</td>
                <td>{{substr($transaction['created_at'], strpos($transaction['created_at'], " ") + 1)}}</td>
            </tr>
            @endforeach
            </tbody>

        </table>

    </div>

</div>






<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        var table = $('#example').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });
</script>
@endsection
