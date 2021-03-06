<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="#">Bagel</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
       <li class="nav-item {{ Request::is('bagel') == '/bagel' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ url('/bagel') }}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">
          Dashboard</span>
        </a>
      </li>
       <li class="nav-item {{ Request::is('category-bagel') == '/category-bagel' ? 'active' : '' }}" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{route('category-bagel.index')}}">
          <i class="fa fa-fw fa-tags"></i>
          <span class="nav-link-text">
          Category</span>
        </a>
      </li>
     <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Funnels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Funnels</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            @foreach($funnels as $funnel)
            <li>
              <a href="{{ route('funnel.show', $funnel->id) }}">{{ $funnel->title }}</a>
            </li>
            @endforeach
          </ul>
        </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="messagesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-list"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="messagesDropdown"  style="  right: 0; left: auto;" >
          <h6 class="dropdown-header">Products:</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="{{ url('/sw2')}}">
            <b>Modal</b>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="{{ url('/om') }}">
            <b>Optin Maximizer</b>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="{{ url('/bagel') }}">
            <b>Bagel</b>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="{{ route('get.user.product-list') }}">
            View all products
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>
        Logout</a>
      </li>
    </ul>
  </div>
</nav>
