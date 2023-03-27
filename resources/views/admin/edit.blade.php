@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-20 mt-20">
        @if (auth()->id() == $user->id)
        <a href="{{ route('admin.profile') }}" class="space-x-1 text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            <span>back</span>
        </a>
        @else
        <a href="{{ route('admin.users.index') }}" class="space-x-1 text-blue-500 hover:text-blue-700">
            <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            <span>back</span>
        </a>
        @endif
        <div>
            <h1 class="font-semibold text-center mb-10">Edit profile</h1>
        </div>
        <form action="{{route('admin.update', $user->id)}}" method="POST" enctype="multipart/form-data">
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
            <div class="mb-4">
                <label for="username" class="block mb-2 font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" id="username" name="username" value="{{ $user->username }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe">
                @error('username')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="first_name" class="block mb-2 font-medium text-gray-900 dark:text-white">First name</label>
                <input type="text" id="first_name" name="firstname" value="{{ $user->firstname }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John">
                @error('firstname')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="last_name" class="block mb-2 font-medium text-gray-900 dark:text-white">Last name</label>
                <input type="text" id="last_name" name="lastname" value="{{ $user->lastname }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe">
                @error('lastname')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2 font-medium text-gray-900 dark:text-white">Email</label>
                <input type="text" id="email" name="email" value="{{ $user->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="johndoe@email.com">
                @error('email')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="department_id" class="block mb-2 font-medium text-gray-900 dark:text-white">Department</label>
                <select name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}" {{$department->id == $user->department->id ? 'selected' : ''}}>{{$department->name}}</option>
                    @endforeach
                </select>
                @error('email')
                <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-20">
                <label for="role_id" class="block mb-2 font-medium text-gray-900 dark:text-white">Role</label>
                <select name="role_id" id="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" {{$role->id == $user->role->id ? 'selected' : ''}}>{{$role->role}}</option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label for="passsword" class="block mb-2 font-medium text-gray-900 dark:text-white">New Password</label>
                <input type="password" id="passsword" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('password')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2 font-medium text-gray-900 dark:text-white">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div> --}}
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
            </div>
        </form>
    </div>
@endsection
