@include('userpanel.layout.header')


<div class="tt-categories-list col-lg-12">
    <main id="tt-pageContent">
        @yield('content')
        @include('sweetalert::alert')
    </main>
</div>


@include('userpanel.layout.footer')