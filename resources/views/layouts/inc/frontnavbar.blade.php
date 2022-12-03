<nav class="navbar container navbar-expand-lg navbar-white bg-white">
  <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a>
  <div class="search-bar">
    <form action="{{ url('searchproduct') }}" method="POST">
      @csrf
      <div class="input-group">
        <input type="search" class="form-control" id="search_product" name="search_product" placeholder="Search product" required aria-describedby="basic-addon1">
        <div class="input-group-prepend">
          <button type="submit" class="input-group-text h-100"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">    
    <ul class="navbar-nav ms-auto">
      <!-- Authentication Links -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('category') }}">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('cart') }}">Cart
          <span class="badge badge-pill bg-primary cart-count">0</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('wishlist') }}">Wishlist
          <span class="badge badge-pill bg-success wishlist-count">0</span>
        </a>
      </li>
      @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li>
                      <a class="dropdown-item" href="{{ url('my-orders') }}">
                          My Orders
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="#">
                          My Profile
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                      </form>
                  </li>
              </ul>
          </li>
      @endguest
  </ul>
  </div>
</nav>