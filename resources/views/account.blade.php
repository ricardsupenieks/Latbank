@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Account overview
        </h1>
    </div>
    <div class="flex items-start">
        <div class="flex flex-col">
            <div class="flex flex-row items-center py-8 mx-20 lg:py-0">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black">
                            Account: {{$account['account_number']}}
                        </h1>
                        <div class="flex flex-row font-bold mb-1 mt-1">
                            <div class="truncate">
                                <p class="text-5xl mt-1">{{$account['currency']}}</p>
                                <p class="max-w-[298px] text-3xl truncate"> {{number_format($account['balance'],2)}}</p>
                            </div>
                            <div class="flex flex-col font-bold text-sm mb-1 mt-1 right-0 gap-4">
                                <div x-data="{deposit_form: false}">
                                    <button class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl"
                                               type="button" name="deposit" id="deposit"
                                            @click="deposit_form = true"
                                    >
                                        Deposit
                                    </button>

                                    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="deposit_form" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': deposit_form }">
                                        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="deposit_form" @click.away="deposit_form = false">
                                            <div class="flex justify-between items-center pb-3">
                                                <p class="text-2xl font-bold">Deposit</p>
                                                <div class="cursor-pointer z-50" @click="deposit_form = false">
                                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                                                </div>
                                            </div>

                                            <form action="{{$account['account_number']}}/deposit" method="post">
                                                @csrf
                                                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter amount</label>
                                                <input type="text" name="amount" id="amount" placeholder="5.00" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <label for="account" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Enter Code {{$code['id']}}</label>
                                                <input type="password" name="code_input" id="code_input" placeholder="••••••" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                                <div class="flex justify-end pt-2 gap-2">
                                                    <button type="button" class="modal-close text-red-700 hover:text-blue-800" @click="deposit_form = false">Cancel</button>
                                                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Deposit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                                <div x-data="{withdraw_form: false}">
                                    <button class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl"
                                               type="button" name="withdraw" id="withdraw"
                                            @click="withdraw_form = true"
                                    >
                                        Withdraw
                                    </button>

                                    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="withdraw_form" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': withdraw_form }">
                                        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="withdraw_form" @click.away="withdraw_form = false">
                                            <div class="flex justify-between items-center pb-3">
                                                <p class="text-2xl font-bold">Withdraw</p>
                                                <div class="cursor-pointer z-50" @click="withdraw_form = false">
                                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                                                </div>
                                            </div>

                                            <form action="{{$account['account_number']}}/withdraw" method="post">
                                                @csrf
                                                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter amount</label>
                                                <input type="text" name="amount" id="amount" placeholder="5.00" class=" bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <label for="account" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Enter Code {{$code['id']}}</label>
                                                <input type="password" name="code_input" id="code_input" placeholder="••••••" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                                <div class="flex justify-end pt-2 gap-2">
                                                    <button type="button" class="modal-close text-red-700 hover:text-blue-800" @click="withdraw_form = false">Cancel</button>
                                                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Withdraw</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div x-data="{close_form: false}">
                                    <button class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl"
                                            type="button" name="close" id="close"
                                            @click="close_form = true"
                                    >
                                        Close
                                    </button>

                                    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="close_form" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': close_form }">
                                        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="close_form" @click.away="close_form = false">
                                            <div class="flex justify-between items-center pb-3">
                                                <p class="text-2xl font-bold">Close account</p>
                                                <div class="cursor-pointer z-50" @click="close_form = false">
                                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                                                </div>
                                            </div>

                                            <form action="{{$account['account_number']}}/close" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <label for="account" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Enter Code {{$code['id']}}</label>
                                                <input type="password" name="code_input" id="code_input" placeholder="••••••" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                                <div class="flex justify-end pt-2 gap-2">
                                                    <button type="button" class="modal-close text-red-700 hover:text-blue-800" @click="close_form = false">Cancel</button>
                                                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close account</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="py-5">--}}
{{--                            Opened on : {{strtok($account['created_at'], ' ')}} | {{substr($account['created_at'], strpos($account['created_at'], " ") + 1)}}--}}
{{--                        </div>--}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600 font-small">*{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex items-center relative mt-[72px] mx-20">
                    <table class="text-sm text-gray-500 dark:text-gray-400 shadow-md w-full">
                        <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t-sm sticky top-0">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    <a href="/crypto/portfolio/{{$account['id']}}">Crypto wallet</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-black">
                        @foreach($cryptos as $crypto)
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white text-start">
                                    <a href="/crypto/{{$crypto['crypto_id']}}">
                                        <img class="object-scale-down h-7 w-7 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['crypto_id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-20 container w-full md:w-4/5 xl:w-3/5 mx-auto pr-20">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded-lg shadow bg-white">
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
                            <td>{{number_format($transaction['amount'],  2)}} {{$transaction['currency']}}</td>
                            <td>{{strtok($transaction['created_at'], 'T')}}</td>
                            <td>{{strtok(substr($transaction['created_at'], strpos($transaction['created_at'], "T") + 1), '.')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded-lg shadow bg-white mb-10">
                <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black">Crypto transactions</h1>
                <table id="crypto" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                    <tr>
                        <th data-priority="1">Account</th>
                        <th data-priority="2">Crypto</th>
                        <th data-priority="3">Transaction</th>
                        <th data-priority="4">Amount</th>
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
                            <td>{{strtok($transaction['created_at'], 'T')}}</td>
                            <td>{{strtok(substr($transaction['created_at'], strpos($transaction['created_at'], "T") + 1), '.')}}</td>
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
