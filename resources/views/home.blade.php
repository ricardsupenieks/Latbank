@extends('layout')

@section('content')
    <div class="flex ml-40 mt-20">
        <p class="text-5xl font-semibold">Welcome, {{ auth()->user()->name }}</p>
    </div>
@endsection
