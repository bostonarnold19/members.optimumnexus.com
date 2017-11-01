<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.email._head')
        @yield('style')
    </head>
    <body>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        @include('partials.email._javascript')
        @yield('script')
    </body>
</html>
