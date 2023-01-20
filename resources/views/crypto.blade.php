@extends('layout')

@section('content')
    <div class="flex flex-row mx-[200px] gap-7 items-start justify-center mb-[600px]">
        <div class="flex flex-col min-w-7xl mt-10 font-semibold bg-white rounded py-5 px-5">
            <div class="flex flex-row max-w-lg">
                <div class="text-5xl font-semibold">
                    <img class="object-scale-down h-16 w-16 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                    <span class="text-black">{{$crypto['name']}} {{$crypto['symbol']}}</span>
                </div>
            </div>
            <div class="flex flex-row text-8xl mt-10 items-start gap-2">
                €{{number_format($crypto['quote']['EUR']['price'], 2)}}
                    @if($crypto['quote']['EUR']['percent_change_24h'] > 0)
                        <span class="bg-green-400 px-3 py-1 rounded-lg text-3xl text-white">
                            {{number_format($crypto['quote']['EUR']['percent_change_24h'])}}%
                        </span>
                    @else
                        <span class="bg-red-600 px-3 py-1 rounded-lg text-3xl text-white">
                            {{number_format($crypto['quote']['EUR']['percent_change_24h'], 2)}}%
                        </span>
                    @endif
            </div>
            <div class="flex flex-row justify-around mt-4 border-t-2 border-black">
                <div class="flex flex-col pt-2">
                    <div class="text-center text-gray-500 font-medium">Circulating Supply</div>
                    <div class="text-center">{{number_format($crypto['circulating_supply'])}} {{$crypto['symbol']}}</div>
                </div>
                <div class="flex flex-col pt-2">
                    <div class="text-center text-gray-500 font-medium">Market Cap</div>
                    <div class="text-center">€{{number_format($crypto['quote']['EUR']['market_cap'])}}</div>
                </div>
                <div class="flex flex-col pt-2">
                    <div class="text-center text-gray-500 font-medium">24h Volume</div>
                    <div class="text-center">€{{number_format($crypto['quote']['EUR']['volume_24h'])}}</div>
                </div>
            </div>
        </div>
        <div class="mt-10 bg-white rounded p-1 max-w-[242px]">
            <div class="flex flex-row">
                <button type="button" name="buy_button" id="buy_button" class="bg-white font-bold py-2 px-4">BUY</button>
                <button type="button" name="sell_button" id="sell_button" class="bg-white font-bold py-2 px-4">SELL</button>
            </div>

            <div id="buy_appear" class="p-2">
                <form action="/crypto/{{$crypto['id']}}/buy" method="get">
                    @csrf
                    <label for="account" class="block text-center my-2 text-sm font-medium text-gray-900 dark:text-white">Buy with</label>
                    <select name="account" id="account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" disabled selected>Choose an account</option>
                        @foreach ($accounts as $account)
                            <option value="{{$account['account_number']}}">Account: {{$account['account_number']}} | {{number_format($account['balance'],2)}} {{$account['currency']}}</option>
                        @endforeach
                    </select>

                    <label for="amount" class="block my-2 text-center text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                    <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <div x-data="{code_form: false}">
                        <button type="button" class="mt-2 mb-1 w-full text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                @click="code_form = true"
                        >
                            Buy
                        </button>

                        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="code_form" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': code_form }">
                            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="code_form" @click.away="code_form = false">
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold">Code confirmation</p>
                                    <div class="cursor-pointer z-50" @click="code_form = false">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                                    </div>
                                </div>
                                <form>
                                    @csrf
                                    <label for="account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Code {{$code['id']}}</label>
                                    <input type="password" name="code_input" id="code_input" placeholder="••••••" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </form>
                                <div class="flex justify-end pt-2 gap-2">
                                    <button type="button" class="modal-close text-red-700 hover:text-blue-800" @click="showModal = false">Cancel</button>
                                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

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

            <div id="sell_appear" class="hidden p-2">
                <form action="/crypto/{{$crypto['id']}}/sell" method="get">
                    @csrf
                    <label for="account" class="block my-2 text-center text-sm font-medium text-gray-900 dark:text-white">Sell from</label>
                    <select name="account" id="account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="" disabled selected>Choose an account</option>
                        @foreach ($cryptoAccounts as $cryptoAccount)
                            <option value="{{$cryptoAccount['account_number']}}">Account: {{$cryptoAccount['account_number']}} | {{number_format($cryptoAccount['balance'],2)}} {{$cryptoAccount['currency']}}</option>
                        @endforeach
                    </select>

                    <label for="amount" class="block my-2 text-center text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                    <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    <div x-data="{code_form: false}">
                        <button type="button" class="mt-2 mb-1 w-full text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                @click="code_form = true"
                        >
                            Sell
                        </button>

                        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="code_form" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': code_form }">
                            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="code_form" @click.away="code_form = false">
                                <div class="flex justify-between items-center pb-3">
                                    <p class="text-2xl font-bold">Code confirmation</p>
                                    <div class="cursor-pointer z-50" @click="code_form = false">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                                    </div>
                                </div>
                                <form>
                                    @csrf
                                    <label for="account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Code {{$code['id']}}</label>
                                    <input type="password" name="code_input" id="code_input" placeholder="••••••" maxlength="6" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </form>
                                <div class="flex justify-end pt-2 gap-2">
                                    <button type="button" class="modal-close text-red-700 hover:text-blue-800" @click="showModal = false">Cancel</button>
                                    <button type="submit" class="text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sell</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

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
    </div>

    <script type="text/javascript">
        $("#buy_button").click(
            function()
            {
                $("#sell_appear").hide();
                $("#buy_appear").show();
            }
        );

        $("#sell_button").click(
            function()
            {
                $("#buy_appear").hide();
                $("#sell_appear").show();
            }
        );
    </script>
@endsection
