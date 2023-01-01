@extends('layout')

@section('content')
    <section class="">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto mt-20 lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white border-b-4 border-black text-center pb-4">
                        Create an account
                    </h1>
                    <form>
                        @csrf
                        <input class="">
                    </form>
                    <div class="flex flex-row space-x-2">
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-600 font-small">*{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{--    <div class="container mt-8 ml-8">--}}
{{--        <h1 class="text-2xl font-bold mb-4">Open a Bank Account</h1>--}}

{{--        <!-- Form for opening a bank account -->--}}
{{--        <form method="POST" action="/accounts/create">--}}
{{--            @csrf--}}

{{--            <!-- Personal information fields -->--}}
{{--            <div class="mb-4">--}}
{{--                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>--}}
{{--                <input type="text" id="name" name="name" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>--}}
{{--                <input type="email" id="email" name="email" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--            </div>--}}
{{--            <div class="mb-4">--}}
{{--                <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>--}}
{{--                <input type="text" id="address" name="address" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--            </div>--}}

{{--            <!-- Account type field -->--}}
{{--            <div class="mb-4">--}}
{{--                <label for="account-type" class="block text-gray-700 font-bold mb-2">Account Type:</label>--}}
{{--                <select id="account-type" name="account_type" class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--                    <option value="checking">Checking</option>--}}
{{--                    <option value="savings">Savings</option>--}}
{{--                    <option value="credit">Credit</option>--}}
{{--                </select>--}}
{{--            </div>--}}

{{--            <!-- Submit button -->--}}
{{--            <div class="mb-4">--}}
{{--                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline">Open Account</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}
@endsection
