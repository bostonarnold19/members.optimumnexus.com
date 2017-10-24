<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.email._head')
        @yield('styles')
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
