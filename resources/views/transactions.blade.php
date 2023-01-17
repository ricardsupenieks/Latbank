@extends('layout')

@section('content')
<body class="text-gray-900 tracking-wider leading-normal">

<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
    <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
       Transactions
    </h1>
    <div class="flex flex-col gap-20">
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black">Bank transactions</h1>
            <table id="bank" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                <tr>
                    <th data-priority="1">Transferee</th>
                    <th data-priority="2">Transferor</th>
                    <th data-priority="3">Action</th>
                    <th data-priority="4">Amount</th>
                    <th data-priority="6">Date</th>
                    <th data-priority="7">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>
                        @if(isset($transaction['account_to']))
                            {{$transaction['transferee']}} ( {{$transaction['account_to']}} )
                        @endif
                    </td>
                    <td>
                        @if(isset($transaction['account_from']))
                            {{$transaction['transferor']}} ( {{$transaction['account_from']}} )
                        @endif
                    </td>
                    <td>{{ucfirst($transaction['transaction'])}}</td>
                    <td>{{number_format($transaction['amount'] / 100,  2)}} {{$transaction['currency']}}</td>
                    <td>{{strtok($transaction['created_at'], ' ')}}</td>
                    <td>{{substr($transaction['created_at'], strpos($transaction['created_at'], " ") + 1)}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white mb-20">
            <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black">Crypto transactions</h1>
            <table id="crypto" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                <tr>
                    <th data-priority="1">Account</th>
                    <th data-priority="2">Crypto</th>
                    <th data-priority="3">Transaction</th>
                    <th data-priority="4">Amount</th>
                    <th data-priority="5">Price</th>
                    <th data-priority="6">Date</th>
                    <th data-priority="7">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cryptoTransactions as $cryptoTransaction)
                    <tr>
                        <td>{{$cryptoTransaction['account_number']}}</td>
                        <td>{{$cryptoTransaction['crypto']}}</td>
                        <td>{{ucfirst($cryptoTransaction['transaction'])}}</td>
                        <td>{{number_format($cryptoTransaction['amount'])}}</td>
                        <td>{{number_format($cryptoTransaction['price'] / 100, 2)}} {{$transaction['currency']}}</td>
                        <td>{{strtok($cryptoTransaction['created_at'], ' ')}}</td>
                        <td>{{substr($cryptoTransaction['created_at'], strpos($cryptoTransaction['created_at'], " ") + 1)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        var table = $('#bank').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();

        var table = $('#crypto').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });
</script>
@endsection
