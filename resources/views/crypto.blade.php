@extends('layout')

@section('content')
    <div class="flex mx-20">
        <div class="flex ml-40 mt-20 max-w-lg">
            <div class="text-6xl font-semibold">
                <img class="object-scale-down h-20 w-20 inline" src="https://s2.coinmarketcap.com/static/img/coins/200x200/{{$crypto['id']}}.png" alt="Not found" onerror=this.src="https://s2.coinmarketcap.com/static/img/coins/64x64/{{$crypto['id']}}.png">
                {{$crypto['name']}} {{$crypto['symbol']}}
            </div>
        </div>
{{--        <div class="flex flex-col inline ml-[980px] mt-20 gap-2">--}}
{{--            <div class="bg-white p-2 text-base text-end font-semibold rounded">--}}
{{--                Market Cap <br>--}}
{{--                <p class="text-xl font-normal font-sans">--}}
{{--                    ${{number_format($crypto['quote']['USD']['market_cap'])}}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="bg-white p-2 text-base text-end font-semibold rounded">--}}
{{--                24h Volume <br>--}}
{{--                <p class="text-xl font-normal font-sans">--}}
{{--                    ${{number_format($crypto['quote']['USD']['volume_24h'])}}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--            <div class="bg-white p-2 text-base text-end font-semibold rounded">--}}
{{--                Circulating Supply <br>--}}
{{--                <p class="text-xl font-normal font-sans">--}}
{{--                    {{number_format($crypto['circulating_supply'])}} {{$crypto['symbol']}}--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="flex flex-row mx-[200px]">
        <div class="flex min-w-7xl mt-10 text-6xl font-semibold bg-white rounded py-5 px-5">
            ${{number_format($crypto['quote']['USD']['price'], 2)}} {{--{{number_format($crypto['quote']['USD']['percent_change_24h'])}}%--}}
        </div>

        <div>
            <button type="button" class="bg-white border hover:text-indigo-500 font-bold py-2 px-4" @click="showModal = true">BUY</button>

            <!--Overlay-->
            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
                <!--Dialog-->
                <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal" @click.away="showModal = false">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Simple Modal!</p>
                        <div class="cursor-pointer z-50" @click="showModal = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <form>
                        @csrf
                        <label for="account" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select account:</label>
                        <select name="account" id="account" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>Choose an account</option>
                            @foreach ($accounts as $account)
                                <option value="{{$account['account_number']}}">Account: {{$account['account_number']}} | {{number_format($account['balance'],2)}} {{$account['currency']}}</option>
                            @endforeach
                        </select>
                        <input>
                    </form>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" @click="alert('Additional Action');">Action</button>
                        <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400" @click="showModal = false">Close</button>
                    </div>


                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>
    </div>
{{--    <div class="flex flex-row space-x-2">--}}
{{--        <form class="space-y-4 md:space-y-6 " action="/crypto/{{$crypto['id']}}/buy" method="post">--}}
{{--            @csrf--}}
{{--            <input class="hidden" name="id" value="{{$crypto['id']}}">--}}
{{--            <div>--}}
{{--                <input class="bg-red-600 shadow-lg shadow-shadow-red-600 text-white cursor-pointer px-3 text-center justify-center items-center py-1 rounded-xl space-x-2"--}}
{{--                       type="submit" name="buy" id="buy" value="Buy">--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
{{--    <div class="max-w-[14rem] mt-10 text-xl font-semibold bg-white rounded py-5 px-5">--}}
{{--        ${{number_format($crypto['quote']['USD']['price'], 2)}} --}}{{--{{number_format($crypto['quote']['USD']['percent_change_24h'])}}%--}}
{{--    </div>--}}



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
