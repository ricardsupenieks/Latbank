@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Today's Cryptocurrency Prices
        </h1>
    </div>

    <div class="flex mx-[238px] pt-2 justify-center bg-gray-50 text-sm text-black">
        <form method="get" action="/crypto/search">
            @csrf
            <div class="pb-4 dark:bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-black" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="bg-white">
                        <input type="text" name="search" id="search" class="block p-2 pl-10 text-sm text-black border border-black rounded-lg w-80 bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for crypto...">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="flex justify-center relative mb-32">
        <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400 shadow-md mb-20">
            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t-sm sticky top-0">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    #
                </th>
                <th scope="col" class="px-6 py-3 text-start">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Price
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    24h Volume
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    1h %
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    24h %
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    7d %
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Market Cap
                </th>
                <th scope="col" class="px-6 py-3 text-end">
                    Circulating supply
                </th>
            </tr>
            </thead>
            <tbody class="border-b-sm text-black">
            @foreach($topCryptos as $crypto)
                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 text-center text-gray-500">
                        {{array_search($crypto, $topCryptos) + 1}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white text-start">
                        <a href="/crypto/{{$crypto['id']}}">
                            <img class="object-scale-down h-7 w-7 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                            {{$crypto['name']}} <span class="text-gray-500">{{$crypto['symbol']}} </span>
                        </a>
                    </th>
                    <td class="px-6 py-4 text-end">
                        €{{number_format($crypto['quote']['EUR']['price'], 2)}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        €{{number_format($crypto['quote']['EUR']['volume_24h'])}}
                    </td>
                    @if($crypto['quote']['EUR']['percent_change_1h'] > 0.00)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_1h'], 2)}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_1h'], 2)}}%
                        </td>
                    @endif
                    @if($crypto['quote']['EUR']['percent_change_24h'] > 0)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_24h'])}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_24h'], 2)}}%
                        </td>
                    @endif
                    @if($crypto['quote']['EUR']['percent_change_7d'] > 0)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_7d'], 2)}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['EUR']['percent_change_7d'], 2)}}%
                        </td>
                    @endif
                    <td class="px-6 py-4 text-end">
                        €{{number_format($crypto['quote']['EUR']['market_cap'])}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{number_format($crypto['circulating_supply'])}} {{$crypto['symbol']}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
