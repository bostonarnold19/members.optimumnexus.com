<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.main._head')
        @yield('style')
    </head>
    <body class="bg-dark">
        @include('partials.dashboard.nav._product_list')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @include('partials.main._javascript')
        @yield('script')
    </body>
</html>
