@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Accounts
        </h1>
    </div>

        <div class="flex flex-row flex-wrap gap-10 ml-[80px]">
            @foreach ($accounts as $account)
                <div class="w-80 rounded overflow-hidden shadow-lg bg-white">
                    <a href="/account/{{$account['account_number']}}">
                        <div class="py-4 px-6">
                            <div class="text-gray-700 text-base">
                                Account {{ $account['account_number'] }}
                            </div>
                            <div class="font-bold text-2xl mb-1 mt-1">{{$account['currency']}}</div>
                            <p class="font-bold text-2xl mb-1">
                                {{number_format($account['balance'],2)}}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="w-80 h-[132px]  rounded overflow-hidden shadow-lg bg-white pb-1">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center pt-3 pb-1">
                    Create an account
                </h1>
                <form action="/account/create" class="text-center" method="post">
                    @csrf
                    <select id="currency" name="currency" class="font-bold text-2xl bg-white ml-6">
                        <option value="EUR">EUR</option>
                        @foreach($currencies as $currency)
                            <option value="{{$currency}}">{{$currency}}</option>
                        @endforeach
                    </select>
                    <br>
                    <input class="bg-red-600 mt-2 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 pb-1 rounded-xl space-x-2"
                           type="submit" name="withdraw" id="deposit" value="Create">
                </form>
            </div>
        </div>
@endsection
