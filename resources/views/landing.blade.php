@extends('layout')

@section('content')
    <div class="flex">
        <img src="https://preview.redd.it/cz1yplijz4z71.png?width=640&crop=smart&auto=webp&s=06cbcd5f6bbb899a10c69664a8cfbef13892c7ff" class="">

        <span class="self-center text-9xl font-semibold whitespace-nowrap dark:text-white">Latbank
            <p class="text-3xl mt-10">
                World's worst fund management and crypto market website
            </p>
             <div class="flex md:order-2 justify-center">

                <button type="button" class=" text-white bg-red-700  hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><a href="/register">Get started</a></button>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
             </div>
            <a href="/login" class="text-base text-center"> Log in</a>
        </span>

    </div>
@endsection
