@extends('layout')

@section('content')
    <div class="flex ml-40 mt-20">
        <p class="text-5xl font-semibold text-white">Welcome, {{ auth()->user()->name }}</p>
    </div>

    <div class="mx-60 mt-20 bg-white p-10 rounded-lg flex flex-row justify-around">
        <div class="flex flex-col w-3/5">
            <div>
                <h1 class="text-4xl font-bold">
                   New year - New you.
                </h1>
            </div>
            <div class="w-11/12 mt-4">
                <p class="">
                    Lorem ipsum dolor sit amet. Ea ipsa iusto At ullam voluptatem ea consequatur distinctio aut modi autem! Non corporis dicta est molestiae minus ut quisquam saepe eos dignissimos neque et dignissimos repellendus et rerum sequi! Aut aliquid voluptas et dolorum dolorem et blanditiis nobis. Et dolore dolor et facilis vitae qui quaerat voluptatem. <br><br>
                    Et odio dignissimos quo dicta fugiat id reprehenderit similique hic eius fugiat. Est temporibus iste sit ipsam omnis 33 accusamus numquam.

                    Non corporis obcaecati rem eaque veritatis et corporis tempore. Ea sint sequi id aperiam galisum et nobis harum quo repellendus Quis. Vel incidunt eligendi non molestiae ipsum ab possimus deserunt. At sapiente expedita aut recusandae distinctio quo fugit sint ea sapiente aliquid qui officiis tempore sit sequi corporis ut iste velit.
                </p>
            </div>
            <div class="text-center mt-12">
                <button class="bg-red-700 hover:bg-blue-800 text-white px-8 py-2 rounded-lg">Learn more</button>
            </div>
        </div>
        <div class="">
           <img class="ml-auto rounded-lg" src="/images/placeholder.webp">
        </div>
    </div>

    <div class="mx-60 mt-5 mb-40 bg-white p-5 rounded-lg flex flex-row gap-5">
        <div class="flex flex-col justify-center w-1/4">
            <div class="w-full">
                <div class="overflow-hidden">
                    <img class="h-36 w-96 rounded-lg" src="/images/bitcoin.jpg">
                </div>
                <div class="mt-2">
                    <h1 class="font-medium my-2">
                        The Digital Future: Exploring Cryptocurrency Opportunities
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet. Ea ipsa iusto At ullam voluptatem ea consequatur distinctio aut modi autem!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center w-1/4">
            <div class="w-full">
                <div>
                    <img class="h-36 w-96 rounded-lg" src="/images/loan.jpg">
                </div>
                <div>
                    <h1 class="font-medium my-2">
                        Homeownership Dreams: Affordable Home Loan Solutions
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet. Ea ipsa iusto At ullam voluptatem ea consequatur distinctio aut modi autem!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center w-1/4">
            <div class="w-full">
                <div>
                    <img class="h-36 w-96 rounded-lg" src="/images/pension.jpg">
                </div>
                <div>
                    <h1 class="font-medium my-2">
                        Secure Retirement: A Comprehensive Pension Plan
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet. Ea ipsa iusto At ullam voluptatem ea consequatur distinctio aut modi autem!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-center w-1/4">
            <div class="w-full2/4">
                <div>
                    <img class="h-36 w-96 rounded-lg" src="/images/family.jpg">
                </div>
                <div>
                    <h1 class="font-medium my-2">
                        Building a Strong Foundation: The Family Plan
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet. Ea ipsa iusto At ullam voluptatem ea consequatur distinctio aut modi autem!
                    </p>
                </div>
            </div>
        </div>


    </div>

    @if($firstTimeLogin === true)
            <div data-modal-backdrop="static" class="bg-slate-800 bg-opacity-50 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0">
                <div class="bg-white px-16 py-14 rounded-md text-center">
                    <div class="text-xl font-semibold mb-5">
                        You must save these codes and their numbers
                    </div>
                    <div class="text-xl font-semibold mb-5">
                        Your confirmation codes:
                    </div>
                    @foreach($codes as $code)
                        <h1 class="text-xl mb-4 font-bold text-slate-500">Code nr{{$code['id']}} : {{$code['code']}}</h1>
                    @endforeach
                    <button type="submit" class="text-white mt-10 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <a href="/"> Proceed</a></button>
                </div>
            </div>
    @endif
@endsection
