@extends('userpanel.layout.app')

@section('content')

<div class="tt-categories-list col-12  mt-3">
@if (!$ideas->isEmpty())
@foreach ($ideas as $idea)

    {{-- TODO: later convert tailwind to BS-4 --}}
    <div class="col-lg-6 col-md-12 flex flex-col px-4 py-3 bg-white shadow-sm rounded mb-8">
        <div class="relative">
            <div class="flex justify-between items-center">
                @if ($idea->is_anonymous ?? false)
                <div class="flex items-center gap-x-3 mb-1 basis-1/2">
                    <div class="w-16 h-16 self-start border flex items-center rounded-full py-2 px-1 md:w-24 md:h-24">
                        <img src="{{ asset('images/anon.png') }}" alt="">
                    </div>
                    <div>
                        <h1 class="text-black font-medium">Anonymous</a></h1>
                    </div>
                </div>
                @else
                <div class="flex items-center gap-x-3 mb-1 basis-1/2">
                    <a href="users?username={{ $idea->createdBy->username }}" class="w-16 h-16 self-start border flex items-center rounded-full overflow-hidden md:w-24 md:h-24">
                        <img src="{{ asset('storage/images/'.$idea->user->image) }}" alt="" class="w-full h-full object-cover">
                    </a>
                    <div>
                        <h1 class="text-black font-medium"><a href="users?username={{ $idea->createdBy->username }}">{{$idea->createdBy->full_name}}</a></h1>
                        <p class="mt-1 text-sm text-gray-500"><span>{{$idea->department->name}}</span></p>
                    </div>
                </div>
                @endif
                    @php
                        $ideacat = App\Models\IdeaCategory::where('idea_id', $idea->id)->get();
                    @endphp
                <ul class="tt-list-badge mx-2">
                    @for ($i=0; $i < count($ideacat); $i++ )
                        <li><span class="tt-badge ">{{$ideacat[$i]->category->name}}</span></li>
                    @endfor
                    {{-- @dd( $ideacat[0]->category->name) ff --}}
                </ul>
                <div class="text-center">
                    <a href="#" class="text-blue-500">{{$idea->event->name}}</a>
                    <p>{{ $idea->created_at->diffForHumans() }}</p>
                </div>

                {{-- report, edit, delete --}}
                @if ((auth()->user()->role->role == 'QA Coordinator' || auth()->id() == $idea->user->id) && $idea->event->closure > now())
                <div class="relative">
                    <button id="dd-btn-{{ $idea->id }}" type="button" class="outline-none focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500 hover:text-blue-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </button>
                    <div id="dd-{{ $idea->id }}" class="hidden absolute z-10 top-8 right-0 mt-2 px-4 bg-white shadow rounded-lg">
                        <style>button{}</style>
                        @if (auth()->id() == $idea->user->id)
                        <div class="px-3 py-1">
                            <a href="{{ route('idea.users.edit', $idea->id) }}" class="apperance-none hover:text-amber-400 focus:outline-none">Edit</a>
                        </div>
                        <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST" class="px-3 py-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="hover:text-red-500 foucs:outline-none">Delete</button>
                        </form>
                        @else
                        <button id="report-{{$idea->id}}" type="button" class="px-3 py-1 hover:text-red-500 foucs:outline-none">Report</button>

                        <!-- Blur -->
                        <div id="blur-{{$idea->id}}" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden"></div>

                        <!-- Modal -->
                        <form action="{{ route('report', $idea->id) }}" method="POST" id="modal-{{$idea->id}}" class="fixed z-20 inset-0 overflow-y-auto hidden">
                            @csrf
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                                    <div class="mb-4 flex justify-between">
                                        <h2 class="text-xl font-bold">Report this idea</h2>
                                        <button id="close-modal-{{$idea->id}}" type="button">X</button>
                                        <script>
                                            document.getElementById('close-modal-{{$idea->id}}').addEventListener('click', function() {
                                                document.getElementById('modal-{{$idea->id}}').classList.add('hidden');
                                                document.getElementById('blur-{{$idea->id}}').classList.add('hidden');
                                            });
                                        </script>
                                    </div>
                                    <div>
                                        <input type="hidden" name="reporter_id" value="{{auth()->id()}}">
                                        <label class="mb-4">Reason of reporting</label>
                                        <textarea name="description" id="" class="resize-none h-40 bg-white border-2 border-blue-300 text-gray-900 rounded-lg focus:outline-blue-500 focus:border-blue-500 block w-full py-1.5 pl-2 pr-10 overflow-hidden" placeholder="Describe your reason of reporting explicitly"></textarea>
                                        <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.getElementById('report-{{$idea->id}}').addEventListener('click', function() {
                                document.getElementById('modal-{{$idea->id}}').classList.remove('hidden');
                                document.getElementById('blur-{{$idea->id}}').classList.remove('hidden');
                            });
                        </script>
                        @endif
                    </div>
                    <script>
                        let button_{{$idea->id}} = document.getElementById('dd-btn-{{$idea->id}}');
                        let dropdown_{{$idea->id}} = document.getElementById('dd-{{$idea->id}}');
                        button_{{$idea->id}}.addEventListener('click', function(event) {
                            dropdown_{{$idea->id}}.classList.toggle('hidden');
                        });
                    </script>
                </div>
                @endif
            </div>
            <div class="py-6 mt-4 mb-1.5">
                @if (now() > $idea->event->closure)
                <span class="text-xl px-2.5 py-1.5 bg-yellow-500/[0.8] block mb-2 w-fit text-white rounded-lg">Closure date exceeded. This post cannot be modified</span>
                @endif
                <p class="text-2xl m-0">{{$idea->title}}</p>
            </div>
        </div>

        @if ($idea->image ?? false)
        <div class="relative w-full h-[400px] overflow-hidden p-2.5 border rounded">
            <img src="{{ asset('storage/images/'.$idea->image)  }}" class="absolute top-0 left-0 w-full h-full object-cover" alt="{{$idea->title}}">
        </div>
        @endif

        <div class="my-3 py-2 px-2 bg-blue-50 text-justify text-black rounded-lg">
            {{$idea->description}}
            <br>
            @if ($idea->document)
            <span>Support Documents:</span>
            <a href="{{asset('storage/documents/'.$idea->document)}}" target="_blank" >{{$idea->document}}</a>
            @else
                <span> No Doc uploaded </span>
            @endif
        </div>

        <div class="flex space-x-5 mb-4">
            {{-- like --}}
            <style>button {}</style>
            @if ($idea->event->final_closure < now())
            <div class="flex items-center mr-2">
                <div class="focus:outline-none">
                    @if ($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'like')->exists())
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 inline text-blue-500">
                            <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
                        </svg>
                    </div>
                    @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                        </svg>
                    </div>
                    @endif
                </div>
                <span class="ml-2 mt-1 self-center text-xs">{{$idea->reactions()->where('reaction', '=', 'like')->count()}}</span>
            </div>
            @else
            <div class="mr-2">
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
            @endif

            {{-- unlike --}}
            @if ($idea->event->final_closure < now())
            <div class="flex items-center">
                <div class="focus:outline-none">
                    @if ($idea->reactions()->where('user_id', auth()->id())->where('reaction', 'unlike')->exists())
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 inline text-red-500">
                            <path d="M15.73 5.25h1.035A7.465 7.465 0 0118 9.375a7.465 7.465 0 01-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 01-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 00-.322 1.672V21a.75.75 0 01-.75.75 2.25 2.25 0 01-2.25-2.25c0-1.152.26-2.243.723-3.218C7.74 15.724 7.366 15 6.748 15H3.622c-1.026 0-1.945-.694-2.054-1.715A12.134 12.134 0 011.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77a4.5 4.5 0 011.423.23l3.114 1.04a4.5 4.5 0 001.423.23zM21.669 13.773c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.959 8.959 0 01-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227z" />
                        </svg>
                    </div>
                    @else
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 inline text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                        </svg>
                    </div>
                    @endif
                </div>
                <span class="ml-2 mt-1 self-center text-xs">{{$idea->reactions()->where('reaction', '=', 'unlike')->count()}}</span>
            </div>
            @else
            <div>
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
            @endif
        </div>

        <!-- Comment Section -->
        <section>
            <div class="flex flex-col space-y-4 justify-between items-center py-2.5 border-t md:space-y-0 md:flex-row">
                 <div>
                     <h1>Comment</h1>
                </div>
                <div class="flex items-center gap-x-2">
                    <input id="idea-comment-{{ $idea->id }}-anon" type="checkbox" name="is_anonymous" value="1">
                    <span class="text-sm">Comment Anonymously</span>
                </div>
                {{-- sort comment --}}
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
                <button id="idea-comment-{{ $idea->id }}" type="submit" class="absolute top-7 right-2 px-2 focus:outline-none text-gray-400 hover:text-green-700">
                    <svg id="comment-svg-{{$idea->id}}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </div>
            <script>
                var commentBtn = document.getElementById('idea-comment-{{$idea->id}}');
                var svg = document.getElementById('comment-svg-{{$idea->id}}');
                commentBtn.addEventListener('click', function() {
                    var commentBox = document.getElementById('comment-{{$idea->id}}');
                    var checkbox  = document.getElementById('idea-comment-{{ $idea->id }}-anon');

                    commentBtn.disabled = true;
                    svg.style.display = 'none';

                    let comment = commentBox.value;
                    let anon;
                    if (checkbox.checked) {
                        anon = 1;
                    } else {
                        anon = 0;
                    }
                    console.log(anon);
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
                            body: JSON.stringify({ comment: comment, id: ideaId, is_anonymous: anon}),
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

                            commentBtn.disabled = false;
                            svg.style.display = 'block';

                            /** reload to allow scripts tags to work for the newly added  */
                            window.location.reload();

                            commentBtn.classList.add('hover:text-gray-700');
                        })
                        .catch(function(error) {
                            console.log(error.message);
                        });
                    }
                    else
                    {
                        commentBtn.disabled = false;
                        svg.style.display = 'block';

                        commentBox.placeholder = 'Kindly provide your comment';
                        setTimeout(() => {
                            commentBox.placeholder = 'What are your thoughts on this';
                        }, 4000);
                    }

                });
            </script>
            @endif

            <section id="comments-section-{{ $idea->id }}" class="relative max-h-96 bg-white px-3 mt-2.5 border rounded-lg divide-y overflow-y-auto">
                @foreach ($idea->comments()->latest()->get() as $comment)
                    <div class="flex items-center py-8">
                        <div class="w-12 h-12 self-start border flex items-center rounded-full overflow-hidden md:w-16 md:h-16">
                            @if ($comment->is_anonymous)
                            <img src="{{ asset('images/anon.png') }}" alt="" width="100%">
                            @else
                            <img src="{{ asset('storage/images/'.$comment->user->image) }}" alt="" width="100%" class="w-full h-full object-cover">
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
                                    <h4 class="text-xs mt-1">{{ $comment->user->department->name }}<span class="ml-1"></span></h4>
                                </div>
                                @endif
                                <div class="flex items-center gap-x-2">
                                    <span class="text-gray-600"><time>{{ $comment->created_at->diffForHumans() }}</time></span>

                                    {{-- report, edit, delete --}}
                                    @if ((auth()->user()->role->role == 'QA Coordinator' || auth()->id() == $comment->user->id) && $idea->event->final_closure > now())
                                    <div class="relative">
                                        <button id="dd-btn-{{ $comment->id }}" type="button" class="outline-none focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500 hover:text-blue-700">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </button>
                                        <div id="dd-{{ $comment->id }}" class="hidden absolute z-10 top-8 right-0 mt-2 px-4 bg-white shadow rounded-lg">
                                            <style>button{}</style>
                                            @if (auth()->id() == $comment->user->id)
                                            <div class="px-3 py-1">
                                                <button id="edit-comment-btn-{{$comment->id}}" type="button" class="apperance-none hover:text-amber-400 focus:outline-none">Edit</button>
                                            </div>
                                            <form action="{{ route('idea.comments.destroy', [$idea->id, $comment->id]) }}" method="POST" class="px-3 py-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="apperance-none hover:text-red-500 foucs:outline-none">Delete</button>
                                            </form>
                                            @else
                                            <button id="report-{{$comment->id}}" type="button" class="px-3 py-1 hover:text-red-500 foucs:outline-none">Report</button>

                                            <!-- Blur -->
                                            <div id="blur-{{$comment->id}}" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden"></div>

                                            <!-- Modal -->
                                            <form action="{{ route('comment.report', [$idea->id, $comment->id]) }}" method="POST" id="modal-{{$comment->id}}" class="fixed z-20 inset-0 overflow-y-auto hidden">
                                                @csrf
                                                <div class="flex items-center justify-center min-h-screen">
                                                    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                                                        <div class="mb-4 flex justify-between">
                                                            <h2 class="text-xl font-bold">Report this Comment</h2>
                                                            <button id="close-modal-{{$comment->id}}" type="button">X</button>
                                                            <script>
                                                                document.getElementById('close-modal-{{$comment->id}}').addEventListener('click', function() {
                                                                    document.getElementById('modal-{{$comment->id}}').classList.add('hidden');
                                                                    document.getElementById('blur-{{$comment->id}}').classList.add('hidden');
                                                                });
                                                            </script>
                                                        </div>
                                                        <div>
                                                            <input type="hidden" name="reporter_id" value="{{auth()->id()}}">
                                                            <label class="mb-4">Reason of reporting</label>
                                                            <textarea name="description" id="" class="resize-none h-40 bg-white border-2 border-blue-300 text-gray-900 rounded-lg focus:outline-blue-500 focus:border-blue-500 block w-full py-1.5 pl-2 pr-10 overflow-hidden" placeholder="Describe your reason of reporting the comment explicitly"></textarea>
                                                            <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <script>
                                                document.getElementById('report-{{$comment->id}}').addEventListener('click', function() {
                                                    document.getElementById('modal-{{$comment->id}}').classList.remove('hidden');
                                                    document.getElementById('blur-{{$comment->id}}').classList.remove('hidden');
                                                });
                                            </script>
                                            @endif
                                        </div>
                                        <script>
                                            let button_{{$comment->id}} = document.getElementById('dd-btn-{{$comment->id}}');
                                            let dropdown_{{$comment->id}} = document.getElementById('dd-{{$comment->id}}');
                                            button_{{$comment->id}}.addEventListener('click', function(event) {
                                                dropdown_{{$comment->id}}.classList.toggle('hidden');
                                            });
                                        </script>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-6">
                                @if ($comment->is_edited)
                                <span class="py-1 text-gray-500 px-1 rounded-lg text-xl">Edited</span>
                                @else
                                <span id="span-edited-{{$comment->id}}" class="py-1 text-gray-500 px-1 rounded-lg text-xl hidden">Edited</span>
                                @endif
                                <p id="active-comment-{{$comment->id}}" class="text-gray-800 bg-gray-50 h-full px-3 py-2 mb-0 rounded-lg">{{ $comment->comment }}</p>
                                <div id="edit-comment-{{$comment->id}}" class="w-full hidden relative">
                                    <textarea id="edit-comment-textarea-{{$comment->id}}" class="text-gray-800 resize-none overflow-auto text-xl h-full w-full bg-white px-3 py-2 pr-5 rounded-lg border relative">{{$comment->comment}}</textarea>
                                    <button id="update-comment-{{ $comment->id }}" type="submit" class="absolute top-5 right-2 px-2 focus:outline-none text-gray-400 hover:text-green-700">
                                        <svg id="update-comment-svg-{{$comment->id}}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                        </svg>
                                    </button>
                                </div>
                                <script>
                                    let editCommentBtn_{{$comment->id}} = document.getElementById('edit-comment-btn-{{$comment->id}}');
                                    let editCommentArea_{{$comment->id}} = document.getElementById('edit-comment-{{$comment->id}}');
                                    let activeCommentArea_{{$comment->id}} = document.getElementById('active-comment-{{$comment->id}}');
                                    let updateCommentBtn_{{$comment->id}} = document.getElementById('update-comment-{{$comment->id}}');
                                    let editCommentTextArea_{{$comment->id}} = document.getElementById('edit-comment-textarea-{{$comment->id}}');
                                    let url_{{$comment->id}} = '{{ route('idea.comments.update', [$idea->id, $comment->id]) }}';


                                    if(editCommentBtn_{{$comment->id}})
                                    {
                                        editCommentBtn_{{$comment->id}}.addEventListener('click', function(event) {
                                            editCommentArea_{{$comment->id}}.classList.toggle('hidden');
                                            activeCommentArea_{{$comment->id}}.classList.toggle('hidden');
                                        })

                                        updateCommentBtn_{{$comment->id}}.addEventListener('click', function(event) {
                                            let editedComment_{{$comment->id}} = editCommentTextArea_{{$comment->id}}.value;
                                            console.log(editCommentTextArea_{{$comment->id}}.value);

                                            // Send AJAX request
                                            if(editedComment_{{$comment->id}}.trim() !== '')
                                            {
                                                fetch(url_{{$comment->id}}, {
                                                    method: 'PUT',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                    },
                                                    body: JSON.stringify({ comment: editedComment_{{$comment->id}} }),
                                                })
                                                .then(function(response) {
                                                    if(!response.ok) {
                                                        throw new Error('Internal Server Error');
                                                    }
                                                    return response.json();
                                                })
                                                .then(function(data) {
                                                    console.log(data);

                                                    editCommentArea_{{$comment->id}}.classList.toggle('hidden');
                                                    activeCommentArea_{{$comment->id}}.classList.toggle('hidden');

                                                    document.getElementById('span-edited-{{$comment->id}}').classList.remove('hidden');

                                                    editCommentTextArea_{{$comment->id}}.value = data.comment;
                                                    activeCommentArea_{{$comment->id}}.innerHTML = data.comment;
                                                })
                                                .catch(function(error) {
                                                    console.log(error.message);
                                                });
                                            }
                                        });
                                    }
                                </script>

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

<div class="col-12 d-flex justify-content-center   ">
    <div class="tt-row-btn ">
        {{ $ideas->appends(request()->query())->links() }}
    </div>
</div>

</div>

@endsection
