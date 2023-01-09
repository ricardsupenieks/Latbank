@extends('layout')

@section('content')
    <div class="container w-full md:w-4/5 mx-auto px-2">
        <h1 class="flex items-center font-sans font-bold break-normal text-white px-2 py-8 text-xl md:text-2xl">
            Today's Cryptocurrency Prices
        </h1>
    </div>

    <div class="flex mx-[240px] mb-1.5 gap-2.5 text-sm text-black py-1 ">
        <button class="rounded bg-white w-20 uppercase font-bold text-xs hover:bg-blue-100">
            <a href="crypto/portfolio">
                Portfolio
            </a>
        </button>

        <form method="get" action="/crypto/search">
            @csrf
            <input type="text" name="search" id="search" placeholder="Search" class="rounded font-medium">
        </form>

    </div>

    <div class="flex justify-center relative">
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
                        ${{number_format($crypto['quote']['USD']['price'], 2)}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        ${{number_format($crypto['quote']['USD']['volume_24h'])}}
                    </td>
                    @if($crypto['quote']['USD']['percent_change_1h'] > 0.00)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['USD']['percent_change_1h'], 2)}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['USD']['percent_change_1h'], 2)}}%
                        </td>
                    @endif
                    @if($crypto['quote']['USD']['percent_change_24h'] > 0)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['USD']['percent_change_24h'])}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['USD']['percent_change_24h'], 2)}}%
                        </td>
                    @endif
                    @if($crypto['quote']['USD']['percent_change_7d'] > 0)
                        <td class="px-6 py-4 text-end text-green-600">
                            {{number_format($crypto['quote']['USD']['percent_change_7d'], 2)}}%
                        </td>
                    @else
                        <td class="px-6 py-4 text-end text-red-600">
                            {{number_format($crypto['quote']['USD']['percent_change_7d'], 2)}}%
                        </td>
                    @endif
                    <td class="px-6 py-4 text-end">
                       ${{number_format($crypto['quote']['USD']['market_cap'])}}
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
