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
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          {{ session('error') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          {{ session('warning') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    @endif
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
