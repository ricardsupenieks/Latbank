@extends('layout')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
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
            <tbody>
            @foreach($topCryptos as $crypto)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-start">
                        {{$crypto['name']}} {{$crypto['symbol']}}
                    </th>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['quote']['USD']['price']}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        ${{$crypto['quote']['USD']['volume_24h']}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['quote']['USD']['percent_change_1h']}}%
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['quote']['USD']['percent_change_24h']}}%
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['quote']['USD']['percent_change_7d']}}%
                    </td>
                    <td class="px-6 py-4 text-end">
                       ${{$crypto['quote']['USD']['market_cap']}}
                    </td>
                    <td class="px-6 py-4 text-end">
                        {{$crypto['circulating_supply']}} {{$crypto['symbol']}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
