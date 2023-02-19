@if(session()->has('success'))
    <div class="fixed top-1 left-1/2 -translate-x-1/2 bg-blue-500 text-sm text-white py-2 px-4 rounded-lg">
        <p>{{session()->get('success')}}</p>
    </div>
@endif