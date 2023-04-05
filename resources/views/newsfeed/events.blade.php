@extends('userpanel.layout.app')

@section('content')
<main id="tt-pageContent">
    <div class="tt-custom-mobile-indent container">
        <div class="tt-categories-title">
            <div class="tt-title">Events</div>
        </div>
        <div class="tt-categories-list col-lg-9">
            @foreach ($events as $event )
            <div class="col-md-12 col-lg-12 shadow-lg">
                <div class="tt-item">
                    <div class="tt-item-layout">
                        <div class="tt-innerwrapper">
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('ideas.search')}}" method="get" id="search">
                                    <input type="text" hidden name="event_id" value="{{$event->id}}">
                                    <a href="javascript:{}" onclick="document.getElementById('search').submit();" ><h1 class="tt-title"> {{ $event->name }}</h1></a>
                                </form>
                                <h6 class="tt">Final Date: {{Carbon\Carbon::parse($event->closure)->format('d-m-Y H:i:s')}}</h6>
                            </div>
                            <div class="tt-item-layout">
                                <div class="innerwrapper show-read-more">
                                    {{$event->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>

@endsection
