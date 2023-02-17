@props([
    'user'
])

<x-layout>
    <div class="container mx-auto px-20 mt-20">
        <a href="/" class="space-x-1 text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            <span>back</span>
        </a>
        <div>
            <h1 class="font-semibold text-center">Edit profile</h1>
        </div>
        <form action="{{route('profile.update')}}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-4">
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe" value="{{$user->username}}">
                @error('username')
                    <p class="text-red-500 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="first_name" name="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" value="{{$user->firstname}}">
                @error('firstname')
                    <p class="text-red-500 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-20">
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                <input type="text" id="last_name" name="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" value="{{$user->lastname}}">
                @error('lastname')
                    <p class="text-red-500 text-sm">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="old_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Old Password</label>
                <input type="password" id="old_password" name="old_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('old_password')
                    <p class="text-red-500 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="passsword" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                <input type="password" id="passsword" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('password')
                    <p class="text-red-500 text-sm">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </div>
        </form>
    </div>
</x-layout>