@extends('layout')

@section('content')
        <section class="">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Account: {{$account['account_number']}}
                        </h1>
                        <div class="pb-10">
                            Balance : {{$account['balance']}} {{$account['currency']}}
                        </div>
                        <div class="flex flex-row space-x-2">
                            <form class="space-y-4 md:space-y-6 " action="/account/deposit" method="post">
                                @csrf
                                <input class="hidden" name="id" value="{{$account['id']}}">
                                <label>Enter amount:<br>
                                    <input class="number" name="amount" placeholder="0.00">
                                </label>
                                <div>
                                    <input class="bg-red-500 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                                            type="submit" name="deposit" id="deposit" value="Deposit">
                                    <input class="bg-red-500 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                                            type="submit" name="withdraw" id="deposit" value="Withdraw">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
