@extends('layout')

@section('content')
    <section class="">
        <div class="flex flex-row items-center justify-center px-6 py-8 mx-auto mt-20 lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black">
                        Account: {{$account['account_number']}}
                    </h1>
                    <div class="">
                        Balance : {{number_format($account['balance'],2)}} {{$account['currency']}}
                    </div>
                    <div class="py-5">
                        Opened on : {{strtok($account['created_at'], ' ')}} | {{substr($account['created_at'], strpos($account['created_at'], " ") + 1)}}
                    </div>
                    <div class="flex flex-row space-x-2">
                        <form class="space-y-4 md:space-y-6 " action="/account/deposit" method="post">
                            @csrf
                            <input class="hidden" name="id" value="{{$account['id']}}">
                            <label>Enter amount:<br>
                                <input class="number" name="amount" placeholder="0.00">
                            </label>
                            <div>
                                <input class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                                       type="submit" name="deposit" id="deposit" value="Deposit">
                                <input class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                                       type="submit" name="withdraw" id="deposit" value="Withdraw">
                            </div>
                        </form>
                    </div>
                    <a href="/crypto/portfolio/{{$account['id']}}">Crypto portfolio</a>
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
    </section>

@endsection
