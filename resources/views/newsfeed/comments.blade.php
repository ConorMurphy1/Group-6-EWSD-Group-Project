@foreach ($comments as $comment)
<div class="flex items-center py-8">
    <div class="w-12 h-12 self-start border flex items-center rounded-full py-2 px-1">
        @if ($comment->is_anonymous)
        <img src="{{ asset('images/anon.png') }}" alt="" width="100%">
        @else
        <img src="{{ asset('images/test.png') }}" alt="" width="100%">
        @endif
    </div>
    <div class="flex-1 ml-3">
        <div class="flex items-center justify-between">
            @if ($comment->is_anonymous)
            <div>
                <h3 class="font-medium">Anonymous</h3>
            </div>
            @else
            <div>
                <h3 class="font-medium"><a href="{{ route('user.show') }}?username={{ $comment->user->username }}">{{ $comment->user->full_name }}</a></h3>
                <h4 class="text-xs mt-1">{{ $comment->user->department->name }}<span class="ml-1">Dept</span></h4>
            </div>
            @endif
            <span class="text-gray-600"><time>{{ $comment->created_at->diffForHumans() }}</time></span>
        </div>
        <div class="px-3 py-2 mt-6 bg-gray-50 rounded">
            <p class="text-gray-800">{{ $comment->comment }}</p>
        </div>
    </div>
</div>
@endforeach