@extends('layout')

@section('content')
    <div class="flex flex-row m-10">
        @foreach ($accounts as $account)
                <div class="w-80 rounded overflow-hidden shadow-lg mr-10">
                    <a href="/account/{{$account['account_number']}}">
                        <div class="px-6 py-4">
                            <div class="text-gray-700 text-base">Account {{ $account['account_number'] }}</div>
                            <p class="font-bold text-2xl ">
                                {{$account['currency']}}
                            </p>
                            <p class="font-bold text-2xl mb-1">
                                {{$account['balance']}}
                            </p>
                        </div>
                    </a>
                </div>
        @endforeach
        <div class="w-80 rounded overflow-hidden shadow-lg">
            <a href="/account/create">
                <p class="font-bold text-2xl mb-2 py-6 text-center mt-5">
                    Add new account
                </p>
            </a>
        </div>
    </div>
@endsection
