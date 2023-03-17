@extends('layouts.app')

@section('content')
<div class="container mx-auto px-20 mt-20">
    <div class="mb-4">
        <h1 class="font-semibold text-center text-3xl">Sign in</h1>
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe@email.com" value="{{old('email')}}">
            @error('email')
                <p class="text-red-500 text-2xl">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-2 text-2xl font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-2xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('password')
                <p class="text-red-500 text-2xl">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-2xl w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign in</button>
    </form>
</div>
@endsection
