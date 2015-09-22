@include('template.partials.head')

@include ('template.partials.nav')

<div class="container">
    @include('flash::message')
    @yield('content')
</div>
@include('template.partials.footer')