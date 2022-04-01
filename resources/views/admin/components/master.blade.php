@include('admin.components.header')
<main>
    <div class="flex flex-col md:flex-row">
        @include('admin.components.nav')
        @yield('content')
    </div>
</main>
@include('admin.components.footer')