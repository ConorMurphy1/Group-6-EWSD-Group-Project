@extends('layouts.app')

@section('content')
    <div class="flex flex-col gap-y-6 px-20 py-10 bg-white rounded-md shadow-sm md:gap-y-0 md:gap-x-10 md:flex-row">
        <div class="flex flex-col items-center justify-center">
            <div class="h-60 w-60 rounded-full border-2 border-slate-100 overflow-hidden">
                <img src="{{ file_exists(asset('storage/images'. $user->image)) 
                ? asset('storage/images'. $user->image) 
                : asset('images/test.png') }}" alt="" class="h-full w-full object-contain">
            </div>
        </div>
          
        <div class="px-10 text-2xl">
            <div>
                <h1 class="font-medium mb-2">Name</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->full_name }}</p>
            </div>
            <div class="mt-8">
                <h1 class="font-medium mb-2">Username</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->username }}</p>
            </div>
            <div class="mt-8">
                <h1 class="font-medium mb-2">Email</h1>
                <p class="bg-slate-100 rounded px-4 py-2">{{ $user->email }}</p>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.edit') }}" class="block text-center w-60 mt-10 px-6 py-3 text-white text-2xl rounded-lg bg-blue-500 hover:bg-blue-700">Edit</a>
            </div>
            <div class="mt-6">
                <form action="{{ route('admin.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="custom-button w-60 block px-6 py-3 rounded-lg text-white" onclick="return confirm('Are you sure you want to delete the admin account?')" data-toggle="tooltip" data-placement="top" title="Delete">Delete Account</button>
                </form>
            </div>

        </div>
    </div>
@endsection