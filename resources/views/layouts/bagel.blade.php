<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.dashboard._head')
        @yield('style')
    </head>
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        @include('partials.dashboard.nav._bagel')
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
