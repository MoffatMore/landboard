@include('layouts.navbars.navs.guest')

<div class="wrapper wrapper-full-page ">
    <div class="full-page section-image" filter-color="black" data-image="{{ asset('img') . '/' . ($backgroundImagePath ?? "gaborone.png") }}">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
