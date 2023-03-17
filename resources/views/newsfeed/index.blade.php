@extends('userpanel.layout.app')

@section('content')
@if (!$ideas->isEmpty())
@foreach ($ideas as $idea)

    {{-- TODO: later convert tailwind to BS-4 --}}
    <div class="col-md-8 col-lg-8 px-2 py-5">
        <div class="flex justify-between items-center">
            <div class="mb-2">
                <div class="mb-1">
                    <h1 class="text-black font-medium">{{$idea->createdBy->firstname.' '.$idea->createdBy->lastname}}</h1>
                    <p class="text-sm m-0 text-gray-500">From <span>{{$idea->department->name}}</span> department</p>
                </div>
                <p class="text-lg m-0">{{$idea->title}}</p>
            </div>
            <ul class="tt-list-badge">
                <li><a href="#"><span class="tt-badge ">movies</span></a></li>
                <li><a href="#"><span class="tt-badge ">new movies</span></a></li>

            </ul>
            <p>
                Event <a href="#" class="text-blue-500">{{$idea->event->name}}</a>
            </p>
        </div>

        <div class="bg-gray-200 border border-gray-300 rounded w-96 h-60 flex justify-center items-center">
            <img src="{{ asset($idea->image) }}" alt="" style="max-width: 100%; max-height: 100%; object-fit:contain">
        </div>

        <div class="py-1.5">
            {{$idea->description}}
        </div>

        {{-- TODO: Make AJAX request for like and unlike --}}
        <div class="flex space-x-5 mb-2">
            {{-- like --}}
            <div>
                <form action="{{route('like')}}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="reaction" value="like">
                    <input type="hidden" name="id" value="{{$idea->id}}">
                    <button type="submit" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline text-blue-500 hover:text-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                        </svg>
                    </button>
                </form>
                <span class="text-xs">{{$idea->reactions()->where('reaction', '=', 'like')->count()}}</span>
            </div>

            {{-- unlike --}}
            <div>
                <form action="{{route('unlike')}}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="reaction" value="unlike">
                    <input type="hidden" name="id" value="{{$idea->id}}">
                    <button type="submit" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline text-red-500 hover:text-red-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                        </svg>
                    </button>
                </form>
                <span class="text-xs">{{$idea->reactions()->where('reaction', '=', 'unlike')->count()}}</span>
            </div>
        </div>

        <!-- Comment Section -->
        <section>
            {{-- comment box --}}
            <h2 class="text-sm mb-1">Comments</h2>
            <form action="{{ route('idea.comments.store', ['idea' => $idea->id]) }}" method="POST">
                @csrf
                <div class="relative">
                    <input type="hidden" name="id" value="{{$idea->id}}">
                    <textarea name="comment" id="comment" class="resize-none bg-gray-50 border-2 border-blue-300 text-gray-900 text-sm rounded-lg focus:outline-blue-500 focus:border-blue-500 block w-full py-1.5 pl-2 pr-10 overflow-hidden"></textarea>
                    <button type="submit" class="absolute top-4 right-2 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-700 hover:text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>
            @unless ($idea->comments->isEmpty())
            <div class="max-h-60 px-3 mt-1 border rounded-lg divide-y overflow-y-auto">
                @foreach ($idea->comments as $comment)
                    <div class="flex items-center py-3">
                        <div class="w-12 self-start border rounded-full py-2 px-1">
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
            </div>
            @endunless
        </section>
    </div>
@endforeach
@else
    <p class="mt-10 text-center">There are currently no posts. <a href="{{route('ideas.create')}}" class="block text-blue-500 hover:text-blue-700 text-center">Post some ideas</a></p>
@endif

{{-- <div class="col-md-12 col-lg-12">
    <div class="tt-item">
        <div class="tt-item-layout">
            <div class="tt-innerwrapper">
                <h2 class="tt-title"> What are you think</h2>
                <div class="d-flex justify-content-between">
                    <h6 class="tt"> Department</h6>
                    <h6 class="tt">Event</h6>
                </div>
                <div class="tt-item-layout">
                    <div class="innerwrapper">
                        Lets discuss about whats happening around the world politics ... <a href="view_detail_topic.html" class="tt-title">see more</a>
                    </div>
                    <div class="tt-innerwrapper">
                        <h6 class="tt-title">Category</h6>
                        <ul class="tt-list-badge">
                            <li><a href="#"><span class="tt-badge ">movies</span></a></li>
                            <li><a href="#"><span class="tt-badge ">new movies</span></a></li>

                        </ul>
                    </div>
                    <a href="#" class="tt-btn-icon">
                        <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection