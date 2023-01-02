@extends('layout')

@section('content')
    <div class="flex flex-row m-10">
        @foreach ($accounts as $account)
                <div class="w-80 rounded overflow-hidden shadow-lg mr-10 bg-white">
                    <a href="/account/{{$account['account_number']}}">
                        <div class="px-6 py-4">
                            <div class="text-gray-700 text-base">Account {{ $account['account_number'] }}</div>
                            <form action="/exchange" class="my-2" method="get">
                                <select onchange="this.form.submit()" id="currency" name="currency" class="font-bold text-2xl bg-white">
                                    <option value="current_currency">{{$account['currency']}}</option>
                                    @if($account['currency'] !== 'EUR')
                                        <option value="EUR">EUR</option>
                                    @endif
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency}}">{{$currency}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="account_id" id="account_id" value={{$account['id']}}>
                            </form>
                            <p class="font-bold text-2xl mb-1">
                                {{number_format($account['balance'],2)}}
                            </p>
                        </div>
                    </a>
                </div>
        @endforeach
        <div class="w-80 rounded overflow-hidden shadow-lg bg-white">
            <a href="/account/create">
                <p class="font-bold text-2xl mb-2 py-6 text-center mt-6">
                    Add new account
                </p>
            </a>
        </div>
    </div>
@endsection
