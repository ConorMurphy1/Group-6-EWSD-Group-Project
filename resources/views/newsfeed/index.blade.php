@extends('userpanel.layout.app')

@section('content')
@if (!$ideas->isEmpty())
@foreach ($ideas as $idea)

    {{-- TODO: later convert tailwind to BS-4 --}}
    <div class="col-md-8 col-lg-8 px-4 py-3 bg-white shadow-sm rounded mb-8">
        <div class="relative">
            <div class="flex justify-between items-center">
                @if ($idea->is_anonymous ?? false)
                <div class="mb-1 basis-1/2">
                    <h1 class="text-black font-medium">Anonymous</a></h1>
                </div>
                @else
                <div class="mb-1 basis-1/2">
                    <h1 class="text-black font-medium"><a href="users?username={{ $idea->createdBy->username }}">{{$idea->createdBy->full_name}}</a></h1>
                    <p class="mt-1 text-sm text-gray-500"><span>{{$idea->department->name}}</span></p>
                </div>
                @endif
                <ul class="tt-list-badge mx-2">
                    <li><a href="#"><span class="tt-badge ">movies</span></a></li>
                    <li><a href="#"><span class="tt-badge ">new movies</span></a></li>
                </ul>
                <div>
                    <a href="#" class="text-blue-500">{{$idea->event->name}}</a>
                    <p>{{ $idea->created_at->diffForHumans() }}</p>
                </div>
                @if (auth()->id() == $idea->createdBy->id)
                <div class="absolute top-0 -right-2">
                    <button id="dd-btn-{{ $idea->id }}" type="button" class="outline-none focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                </div>
                <div id="dd-{{ $idea->id }}" class="hidden absolute z-10 top-4 right-0 mt-2 border bg-white shadow-lg rounded">
                    <div class="px-3 py-1">
                        <a href="ideas/edit" class="apperance-none hover:text-amber-500">Edit</a>
                    </div>
                    <form action="" method="POST" class="px-3 py-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class= hover:text-red-500">Delete</button>
                    </form>
                </div>
                <script>
                    let button_{{$idea->id}} = document.getElementById('dd-btn-{{$idea->id}}');
                    let dropdown_{{$idea->id}} = document.getElementById('dd-{{$idea->id}}');
                    button_{{$idea->id}}.addEventListener('click', function(event) {
                        dropdown_{{$idea->id}}.classList.toggle('hidden');
                    });
                </script>
                @endif
            </div>
            <p class="py-6 text-2xl my-2">{{$idea->title}}</p>
        </div>

        @if ($idea->image ?? false)
        <div class="bg-gray-200 border border-gray-300 rounded w-full h-40 flex justify-center items-center md:w-96 md:h-60">
            <img src="{{ file_exists(asset('storage/'.$idea->image)) ? asset('storage/'.$idea->image) : asset($idea->image) }}" alt="" style="max-width: 100%; max-height: 100%; object-fit:contain">
        </div>
        @endif

        <div class="my-3 py-2 px-2 bg-blue-50 text-justify text-black rounded-lg">
            {{$idea->description}}
        </div>

        <div class="flex space-x-5 mb-4">
            {{-- like --}}
            <div class="mr-2">
                <style>
                    button {
                    }
                </style>
                <button id="like-{{ $idea->id }}" type="button" class="focus:outline-none">
                    @if ($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'like')->exists())
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 inline text-blue-500 hover:text-blue-700">
                            <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
                        </svg>
                    </div>
                    @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline text-blue-500 hover:text-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                        </svg>
                    </div>
                    @endif
                </button>
                <span id="like-count-{{ $idea->id }}" class="text-xs">{{$idea->reactions()->where('reaction', '=', 'like')->count()}}</span>
            </div>
            <script>
                document.getElementById('like-{{ $idea->id }}').addEventListener('click', function() {
                    let value = 'like';
                    let ideaId = {{ $idea->id }};
                    let url = '{{ route("like", ["idea" => $idea->id]) }}';
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ value: value, id: ideaId}),
                    })
                    .then(function(response) {
                        if(!response.ok) {
                            throw new Error('Internal Server Error');
                        }
                        return response.json();
                    })
                    .then(function(data) {
                        console.log(data);
                        document.getElementById('like-count-{{ $idea->id }}').textContent = data.likes;
                        document.getElementById('unlike-count-{{ $idea->id }}').textContent = data.unlikes;

                        document.getElementById('like-{{ $idea->id }}').innerHTML = data.likeIcon;
                        document.getElementById('unlike-{{ $idea->id }}').innerHTML = data.unlikeIcon;
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
                });
            </script>

            {{-- unlike --}}
            <div>
                <style>
                    button {
                    }
                </style>
                <button id="unlike-{{ $idea->id }}" type="button" class="focus:outline-none">
                    @if ($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'unlike')->exists())
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 inline text-red-500 hover:text-red-700">
                            <path d="M15.73 5.25h1.035A7.465 7.465 0 0118 9.375a7.465 7.465 0 01-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 01-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 00-.322 1.672V21a.75.75 0 01-.75.75 2.25 2.25 0 01-2.25-2.25c0-1.152.26-2.243.723-3.218C7.74 15.724 7.366 15 6.748 15H3.622c-1.026 0-1.945-.694-2.054-1.715A12.134 12.134 0 011.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77a4.5 4.5 0 011.423.23l3.114 1.04a4.5 4.5 0 001.423.23zM21.669 13.773c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.959 8.959 0 01-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227z" />
                        </svg>
                    </div>
                    @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline text-red-500 hover:text-red-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                        </svg>
                    </div>
                    @endif
                </button>
                <span id="unlike-count-{{ $idea->id }}" class="text-xs">{{$idea->reactions()->where('reaction', '=', 'unlike')->count()}}</span>
            </div>
            <script>
                document.getElementById('unlike-{{ $idea->id }}').addEventListener('click', function() {
                    let value = 'unlike';
                    let ideaId = {{ $idea->id }};
                    let url = '{{ route("unlike", ["idea" => $idea->id]) }}';
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ value: value, id: ideaId}),
                    })
                    .then(function(response) {
                        if(!response.ok) {
                            throw new Error('Internal Server Error');
                        }
                        return response.json();
                    })
                    .then(function(data) {
                        console.log(data);
                        document.getElementById('like-count-{{ $idea->id }}').textContent = data.likes;
                        document.getElementById('unlike-count-{{ $idea->id }}').textContent = data.unlikes;

                        document.getElementById('like-{{ $idea->id }}').innerHTML = data.likeIcon;
                        document.getElementById('unlike-{{ $idea->id }}').innerHTML = data.unlikeIcon;
                    })
                    .catch(function(error) {
                        console.log(error.message);
                    });
                });
            </script>
        </div>

        <!-- Comment Section -->
        <section>
            <div class="flex justify-between items-center py-2.5 border-t">
                <h1>Comments</h1>
                <div>
                    <span class="text-xs text-gray-600">Sorted by</span>
                    <select name="comments" id="comments-{{ $idea->id }}" class="p-1 border border-slate-300 rounded text-gray-600 focus:outline-none">
                        <option value="latest"><a href="{{ route('idea.comments.index', ['idea' => $idea->id]) }}">Latest</a></option>
                        <option value="oldest"><a href="{{ route('idea.comments.index', ['idea' => $idea->id]) }}">Oldest</a></option>
                        {{-- <option value="likes"><a href="">Likes</a></option> --}}
                    </select>
                    <script>
                        document.getElementById('comments-{{$idea->id}}').addEventListener('change', function() {
                            let value = this.value;
                            let ideaId = {{ $idea->id }};
                            let url = '/idea/' + {{ $idea->id }} + '/comment?sort=' + value;
                            console.log(url);

                            // Send AJAX request 
                            fetch(url, {
                                method: 'GET',
                            })
                            .then(function(response) {
                                if(!response.ok) {
                                    throw new Error('Internal Server Error');
                                }
                                return response.json();
                            })
                            .then(function(data) {
                                console.log(data);
                                document.getElementById('comments-section-{{ $idea->id }}').innerHTML = data.html;
                            })
                            .catch(function(error) {
                                console.log(error.message);
                            });
                        });
                    </script>
                </div>
            </div>
            {{-- comment box --}}
            @if ($idea->event->final_closure < now())
            <div class="flex space-x-4 px-4 py-2.5 my-2 border-2 border-yellow-400 rounded-md">
                <div class="w-8 h-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-yellow-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold mb-2">Comment Thread Closed</h2>
                    <p class="text-gray-600 mb-4">We're sorry, but this comment thread has been closed because the closure date has been exceeded. If you have any questions or concerns, please feel free to reach out to us.</p>
                </div>
              </div>
            @else
            <div class="relative">
                <input type="hidden" name="id" value="{{$idea->id}}">
                <textarea name="comment" id="comment-{{$idea->id}}" placeholder="What are your thoughts on this?" class="resize-none bg-white border-2 border-blue-300 text-gray-900 rounded-lg focus:outline-blue-500 focus:border-blue-500 block w-full py-1.5 pl-2 pr-10 overflow-hidden"></textarea>
                <button id="idea-comment-{{ $idea->id }}" type="submit" class="absolute top-7 right-2 px-2 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 hover:text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </div>
            @endif
            <script>
                document.getElementById('idea-comment-{{$idea->id}}').addEventListener('click', function() {
                    var commentBox = document.getElementById('comment-{{$idea->id}}');

                    let comment = commentBox.value;
                    let ideaId = {{ $idea->id }};
                    let url = '/idea/' + {{ $idea->id }} + '/comment';
                    console.log(url);

                    // Send AJAX request 
                    if(comment.trim() !== '') 
                    {
                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ comment: comment, id: ideaId}),
                        })
                        .then(function(response) {
                            if(!response.ok) {
                                throw new Error('Internal Server Error');
                            }
                            return response.json();
                        })
                        .then(function(data) {
                            console.log(data);
                            document.getElementById("comments-section-{{ $idea->id }}").insertAdjacentHTML('afterbegin', data);
                            commentBox.value = '';

                            var commentsSection = document.getElementById('comments-section-{{$idea->id}}');

                            // toggle border based on child elements
                            if (commentsSection.childElementCount > 0) {
                                commentsSection.classList.add("border");
                            } else {
                                commentsSection.classList.remove("border");
                            }
                        })
                        .catch(function(error) {
                            console.log(error.message);
                        });
                    }
                    else 
                    {
                        commentBox.placeholder = 'Kindly provide your comment';
                        setTimeout(() => {
                            commentBox.placeholder = 'What are your thoughts on this';
                        }, 4000);
                    }
                });
            </script>

            <section id="comments-section-{{ $idea->id }}" class="relative max-h-96 bg-white px-3 mt-2.5 border rounded-lg divide-y overflow-y-auto">
                @foreach ($idea->comments()->latest()->get() as $comment)
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

                            {{-- TODO: comment reactions --}}
                            {{-- <div class="flex space-x-5 mt-1">
                                <div>
                                    <form action="{{route('like', ['idea' => $idea->id])}}" method="POST" class="inline">
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
                    
                                <div>
                                    <form action="{{route('unlike', ['idea' => $idea->id])}}" method="POST" class="inline">
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
                            </div> --}}

                        </div>
                    </div>
                @endforeach
            </section>
            <script>
                var commentsSection = document.getElementById('comments-section-{{$idea->id}}');

                // toggle border based on child elements
                if (commentsSection.childElementCount > 0) {
                    commentsSection.classList.add("border");
                } else {
                    commentsSection.classList.remove("border");
                }
            </script>

        </section>
    </div>
@endforeach
@else
    <p class="mt-10 text-center">There are currently no posts. <a href="{{route('ideas.create')}}" class="block text-blue-500 hover:text-blue-700 text-center">Post some ideas</a></p>
@endif
@endsection