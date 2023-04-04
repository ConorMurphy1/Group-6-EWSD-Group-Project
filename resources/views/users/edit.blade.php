@extends('userpanel.layout.app')

@section('content')
<div class="flex flex-col items-center gap-y-10 md:gap-y-0 mt-2 md:flex-row">
    <div class="self-center bg-stone-100/[0.9] w-full p-4 rounded-lg md:basis-1/4 md:p-0 md:self-start md:bg-white">
        <div class="flex flex-col items-center gap-x-4 md:gap-x-10">
            <div class="h-20 w-20 flex items-center rounded-full border-2 border-slate-100 md:h-40 md:w-40 bg-white overflow-hidden">
                @if ($user->image)
                <img src="{{ asset('storage/images/'.$user->image) }}" alt="" class="h-full w-full object-cover">
                @else
                <img src="http://placehold.it/240x240" alt="" class="h-full w-full object-cover">
                @endif
            </div>
            <div class="mt-2 text-center md:mt-8 md:text-start">
                <div class="font-medium text-lg md:text-xl">{{ $user->full_name }}</div>
                <div class="text-gray-600 text-sm mt-1"><span>@</span>{{ $user->username }}</div>
                <div class="mt-4"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
            </div>
        </div>
    </div>

    <section id="user-ideas" class="basis-3/4">
        <div class="flex flex-col h-full items-start justify-center py-4 px-6 bg-slate-50 shadow-sm rounded md:px-10">
            <a href="{{ route('user.profile', $user->username) }}" class="space-x-1 text-blue-500 hover:text-blue-700">
                <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>back</span>
            </a>
            <form action="{{route('user.update', $user->username)}}" method="POST" class="mt-8 w-full" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-2">
                    <label for="image" class="block mb-2 font-medium text-gray-900 dark:text-white">image</label>
                    <input type="file" id="image" name="image" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe">
                    @error('image')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                @if ($user->image ?? false)
                <div class="mb-10">
                    <img src="{{ asset('storage/images/'.$user->image) }}" alt="" width="200" height="200">
                </div>
                @endif
                <div class="mb-2">
                    <label for="username" class="block mb-2 font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username" name="username" value="{{ $user->username }}" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe">
                    @error('username')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="first_name" class="block mb-2 font-medium text-gray-900 dark:text-white">First name</label>
                    <input type="text" id="first_name" name="firstname" value="{{ $user->firstname }}" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John">
                    @error('firstname')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="block mb-2 font-medium text-gray-900 dark:text-white">Last name</label>
                    <input type="text" id="last_name" name="lastname" value="{{ $user->lastname }}" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe">
                    @error('lastname')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="flex justify-start">
                    <button type="submit" class="rounded-lg text-center text-white px-3 py-2 bg-blue-500 focus:outline-none hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>

        <div class="flex flex-col h-full items-start justify-center py-4 px-6 bg-slate-50 shadow-sm rounded mt-10 md:px-10">
            <form action="{{ route('password.update') }}" method="POST" class="w-full">
                @method('PUT')
                @csrf
                <div class="mb-10">
                    <label for="old_password" class="block mb-2 font-medium text-gray-900 dark:text-white">Old Password</label>
                    <input type="password" id="old_password" name="old_password" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('old_password')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="passsword" class="block mb-2 font-medium text-gray-900 dark:text-white">New Password</label>
                    <input type="password" id="passsword" name="password" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @error('password')
                        <p class="text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="block mb-2 font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="flex justify-start">
                    <button type="submit" class="rounded-lg text-center text-white px-3 py-2 bg-blue-500 focus:outline-none hover:bg-blue-700">Change Password</button>
                </div>
            </form>
        </div>
    </section>
    
</div>

@endsection