@include('template.partials.head')
@include('template.partials.nav')

@include ('template.partials.carousel')

<div class="container">
@yield('content')

@include('template.partials.highlights')

@include('template.partials.feature')

</div>
@include('template.partials.footer')