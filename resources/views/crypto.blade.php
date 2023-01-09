@extends('layout')

@section('content')
    <div class="flex mx-20">
        <div class="flex ml-40 mt-20 max-w-lg">
            <div class="text-6xl font-semibold text-white">
                <img class="object-scale-down h-20 w-20 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                {{$crypto['name']}} {{$crypto['symbol']}}
{{--                {{number_format($crypto['quote']['USD']['percent_change_24h'])}}%--}}
            </div>
        </div>
        <div class="flex flex-col inline ml-[980px] mt-20 gap-2">
            <div class="bg-white p-2 text-base text-end font-semibold rounded">
                Market Cap <br>
                <p class="text-xl font-normal font-sans">
                    ${{number_format($crypto['quote']['USD']['market_cap'])}}
                </p>
            </div>
            <div class="bg-white p-2 text-base text-end font-semibold rounded">
                24h Volume <br>
                <p class="text-xl font-normal font-sans">
                    ${{number_format($crypto['quote']['USD']['volume_24h'])}}
                </p>
            </div>
            <div class="bg-white p-2 text-base text-end font-semibold rounded">
                Circulating Supply <br>
                <p class="text-xl font-normal font-sans">
                    {{number_format($crypto['circulating_supply'])}} {{$crypto['symbol']}}
                </p>
            </div>
        </div>
    </div>
    <div class="ml-[250px] text-6xl font-semibold text-white">
        ${{number_format($crypto['quote']['USD']['price'], 2)}}
    </div>
    <div class="flex flex-row space-x-2">
        <form class="space-y-4 md:space-y-6 " action="/crypto/{{$crypto['id']}}/buy" method="post">
            @csrf
            <input class="hidden" name="id" value="{{$crypto['id']}}">
            <div>
                <input class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                       type="submit" name="buy" id="buy" value="Buy">

            </div>
        </form>
        <form class="space-y-4 md:space-y-6 " action="/crypto/{{$crypto['id']}}/sell" method="post">
            @csrf
            <input class="hidden" name="id" value="{{$crypto['id']}}">
            <div>
                <input class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"
                       type="submit" name="sell" id="sell" value="Sell">
            </div>
        </form>
    </div>



{{--    <div class="flex justify-center relative">--}}
{{--        <table class="w-3/4 text-sm text-left text-gray-500 dark:text-gray-400 shadow-md">--}}
{{--            <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t-sm sticky top-0">--}}
{{--            <tr>--}}
{{--                <th scope="col" class="px-6 py-3 text-center">--}}
{{--                    #--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-start">--}}
{{--                    Name--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    Price--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    24h Volume--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    1h %--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    24h %--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    7d %--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    Market Cap--}}
{{--                </th>--}}
{{--                <th scope="col" class="px-6 py-3 text-end">--}}
{{--                    Circulating supply--}}
{{--                </th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody class="border-b-sm text-black">--}}
{{--                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600">--}}
{{--                    <td class="px-6 py-4 text-center text-gray-500">--}}
{{--                        1--}}
{{--                    </td>--}}
{{--                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:text-white text-start">--}}
{{--                        <a href="/crypto/{{$crypto['id']}}">--}}
{{--                            <img class="object-scale-down h-7 w-7 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">--}}
{{--                            {{$crypto['name']}} <span class="text-gray-500">{{$crypto['symbol']}} </span>--}}
{{--                        </a>--}}
{{--                    </th>--}}
{{--                    <td class="px-6 py-4 text-end">--}}
{{--                        ${{number_format($crypto['quote']['USD']['price'], 2)}}--}}
{{--                    </td>--}}
{{--                    <td class="px-6 py-4 text-end">--}}
{{--                        ${{number_format($crypto['quote']['USD']['volume_24h'])}}--}}
{{--                    </td>--}}
{{--                    @if($crypto['quote']['USD']['percent_change_1h'] > 0.00)--}}
{{--                        <td class="px-6 py-4 text-end text-green-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_1h'], 2)}}%--}}
{{--                        </td>--}}
{{--                    @else--}}
{{--                        <td class="px-6 py-4 text-end text-red-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_1h'], 2)}}%--}}
{{--                        </td>--}}
{{--                    @endif--}}
{{--                    @if($crypto['quote']['USD']['percent_change_24h'] > 0)--}}
{{--                        <td class="px-6 py-4 text-end text-green-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_24h'])}}%--}}
{{--                        </td>--}}
{{--                    @else--}}
{{--                        <td class="px-6 py-4 text-end text-red-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_24h'], 2)}}%--}}
{{--                        </td>--}}
{{--                    @endif--}}
{{--                    @if($crypto['quote']['USD']['percent_change_7d'] > 0)--}}
{{--                        <td class="px-6 py-4 text-end text-green-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_7d'], 2)}}%--}}
{{--                        </td>--}}
{{--                    @else--}}
{{--                        <td class="px-6 py-4 text-end text-red-600">--}}
{{--                            {{number_format($crypto['quote']['USD']['percent_change_7d'], 2)}}%--}}
{{--                        </td>--}}
{{--                    @endif--}}
{{--                    <td class="px-6 py-4 text-end">--}}
{{--                        ${{number_format($crypto['quote']['USD']['market_cap'])}}--}}
{{--                    </td>--}}
{{--                    <td class="px-6 py-4 text-end">--}}
{{--                        {{number_format($crypto['circulating_supply'])}} {{$crypto['symbol']}}--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
@endsection
