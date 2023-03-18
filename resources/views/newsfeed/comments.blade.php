@foreach ($comments as $comment)
<div class="flex items-center py-3">
    <div class="w-12 self-start border rounded-full py-2 px-1">
        {{-- <img src="{{ asset($user->image) }}" alt="" width="100%"> --}}
        <img src="{{ asset('images/test.png') }}" alt="" width="100%">
    </div>
    <div class="flex-1 ml-3">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-medium text-sm">{{ $comment->user->full_name }}</h3>
                <h4 class="text-xs mt-1">{{ $comment->user->department->name }}<span class="ml-1">Dept</span></h4>
            </div>
            <span class="text-gray-600 text-sm"><time>{{ $comment->created_at->diffForHumans() }}</time></span>
        </div>
        <div class="mt-3">
            <p class="text-gray-800">{{ $comment->comment }}</p>
        </div>
    </div>
</div>
@endforeach