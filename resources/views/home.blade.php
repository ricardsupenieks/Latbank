@extends('layout')

@section('content')
    <div class="flex ml-40 mt-20">
        <p class="text-5xl font-semibold text-white">Welcome, {{ auth()->user()->name }}</p>
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
