@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Your portfolio
        </h1>
    </div>

    <div class="flex justify-center relative mb-[800px]">
        <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400 shadow-md">
            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t-sm sticky top-0">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    #
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Amount Owned
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Total Bought Value
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Total Sold Value
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Profit
                </th>
            </tr>
            </thead>
            <tbody class="border-b-sm text-black">
            @foreach($cryptos as $crypto)
                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 text-center text-gray-500">
                        {{array_search($crypto, $cryptos) + 1}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white text-start">
                        <a href="/crypto/{{$crypto['crypto_id']}}">
                            <img class="object-scale-down h-7 w-7 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['crypto_id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                            {{$crypto['name']}} <span class="text-gray-500">{{$crypto['symbol']}} </span>
                        </a>
                    </th>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['amount']}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$account->currency}} {{number_format($crypto['price'], 2)}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$account->currency}} {{number_format($crypto['price_sold'], 2)}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$account->currency}} {{number_format($crypto['price_sold'] - $crypto['price']), 2}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
