<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container-fluid">    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand ms-4 p-0" href="{{ route('home') }}">
      <img src="/assets/logo.png" alt="[LOGO]" style="width:10vh">
    </a>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('location.show') }}">Our Locations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('product.show') }}">Our Products</a>
        </li>
        @if(auth()->user()->roles->name == 'Admin')
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaction.show') }}">Manage Transaction</a>
        </li>
        @endif
      </ul>
      <form class="d-flex mb-2 mb-lg-0" method="POST" action="{{ route('search.getData') }}">
        @csrf
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </button>
      </form>

      @if(auth()->user()->roles->name == 'Member')
        <ul class="navbar-nav mx-2 mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <button class="btn btn-outline-secondary nav-link dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item disabled" style="color:black">Hi, {{ auth()->user()->fullname }}</a></li>
              <hr>
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('cart.show') }}">Cart</a></li>
              <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
          </li>
        </ul>
      @endif

      @if(auth()->user()->roles->name == 'Admin')
        <ul class="navbar-nav mx-2 mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <button class="btn btn-outline-secondary nav-link dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false" type="submit">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </button>
            <ul class="dropdown-menu dropdown-menu-end text-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item disabled" style="color:black">Hi, {{ auth()->user()->fullname }}</a></li>
              <hr>
              <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
            </ul>
          </li>
        </ul>
      @endif
    </div>
  </div>
</nav>