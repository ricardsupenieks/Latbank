@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Accounts
        </h1>
    </div>
        <div class="flex flex-row flex-wrap gap-10 ml-[80px] mb-[600px]">
            @foreach ($accounts as $account)
                <div class="w-80 rounded overflow-hidden shadow-lg bg-white">
                    <a href="/account/{{$account['account_number']}}">
                        <div class="py-4 px-6">
                            <div class="text-gray-700 text-base">
                                Account {{$account['account_number']}}
                            </div>
                            <div class="font-bold text-2xl mb-1 mt-1">
                                {{$account['currency']}}
                            </div>
                            <p class="font-bold text-2xl mb-1">
                                {{number_format($account['balance'] / 100, 2)}}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
            <div class="w-80 h-[132px] rounded overflow-hidden shadow-lg bg-white pb-1">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center pt-3 pb-1">
                    Create an account
                </h1>
                <form action="/account/create" class="text-center" method="post">
                    @csrf
                    <select id="currency" name="currency" class="font-bold text-2xl bg-white ml-6">
                        @foreach($currencies as $currency)
                            <option value="{{$currency}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$currency}}</option>
                        @endforeach
                    </select>
                    <br>
                    <input class="bg-red-600 mt-2 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 pb-1 rounded-xl space-x-2"
                           type="submit" name="create" id="create" value="Create">
                </form>
            </div>
        </div>
@endsection
