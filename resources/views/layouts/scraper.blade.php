<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.dashboard._head')
        @yield('style')
    </head>
    <div class="loader-image-bar hide">
        <div class="loader-image-wrapper">
          <img src="{{ url('loaders/bar.gif') }}" alt="image loader">
        </div>
        <div class="bg-overlay-white"></div>
    </div>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        @include('partials.dashboard.nav._scraper')
        <main>
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>
        @include('partials.dashboard._footer')
        @include('partials.dashboard._modal')
        @include('partials.dashboard._javascript')
        @yield('script')
    </body>
</html>
