<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.main._head')
        @yield('style')
    </head>
    <body class="bg-dark">
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @include('partials.main._javascript')
        @yield('script')
    </body>
</html>
