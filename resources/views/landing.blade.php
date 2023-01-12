@extends('layout')

@section('content')
    <div class="flex">
        <img src="/images/latbankRed.webp" class="">

        <span class="self-center text-9xl font-semibold whitespace-nowrap text-white">Latbank
            <p class="text-3xl mt-10 text-white">
                Tired of swedish banks having a grip over your finances? Us too.
            </p>
             <div class="flex md:order-2 justify-center mt-10">
                <button type="button" class="h-45 text-black bg-white hover:bg-red-800 focus:ring-4 hover:text-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-5 py-2.5 text-center mr-4 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <a href="/register">
                        Take back what's rightfully yours!
                    </a>
                </button>
             </div>
        </span>

    </div>
@endsection
