@extends('layouts.app')

@section('content')
<nav class="bg-slate-50">
    <div class="container mx-auto bg-slate-50 py-5">
        <div>
            Welcome {{$user->firstname.' '.$user->lastname}}
        </div>
    </div>
</nav>
<div class="container mx-auto mt-4 space-y-4">
    <a href="/" class="space-x-1 text-blue-500 hover:text-blue-700">
        <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
        </svg>
        <span>back</span>
    </a>

    <a href="{{route('profile.edit')}}" class="block py-3 px-3 bg-yellow-400 hover:bg-yellow-500 text-white text-center w-60 rounded-md">
        Edit Account
    </a>
    @if (strtolower(auth()->user()->role->role) == 'admin')
        <a href="{{route('register')}}" class="block py-3 px-3 bg-yellow-400 hover:bg-yellow-500 text-white text-center w-60 rounded-md">
            Register User
        </a>
    @endif
    <form id="delete-account" action="{{route('profile.delete')}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="custom-button py-3 px-3 bg-red-500 text-white text-center w-60 rounded-md hover:bg-red-700">
            Delete Account
        </button>
    </form>
</div>

<script>
    const form = document.getElementById('delete-account');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        if(confirm('Are you sure do you want to delete your account?')) {
            form.submit();
        }
    })
</script>
@endsection