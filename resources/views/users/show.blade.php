@props([
    'user'
])

<x-layout>
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
        <a href="{{route('profile.edit')}}" class="block py-2 px-3 bg-yellow-400 hover:bg-yellow-500 text-white text-center text-sm w-36 rounded-md">
            Edit Account
        </a>
        
        <form action="{{route('profile.delete')}}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="py-2 px-3 bg-red-600 hover:bg-red-700 text-white text-center text-sm w-36 rounded-md">
                Delete Account
            </button>
        </form>
    </div>
</x-layout>