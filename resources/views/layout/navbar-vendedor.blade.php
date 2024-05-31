<nav class="navbar navbar-expand-lg navbar-vendedor">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="w-100" role="search">
      <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
    </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="{{route('vendedor.home')}}">Inicio</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('vendedor.producto.all-productos')}}">Productos</a>

        </li>
        @if (!Auth::guard('vendedor')->check())
        <li class="nav-item">
          <a class="nav-link" href="{{route('rol')}}">Login</a>
        </li>
        @endif
      </ul>
      @if (Auth::user())
      <li class="nav-item dropdown d-flex mr-4">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @if (Auth::user()->hasProfilePicture())
            <img src="{{ Auth::user()->imagen }}" width="40" height="40" class="rounded-circle">
            
        @else
            <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihYVKuxiNrVgjma-ISqJ1CRZHQZ-Z4Jk5BCxJ6ze627neDniNHfyaO6qcSS6oiOb9oNKppBOJkzBbUrtSZ_5APBo_ALXPvzMH24=w1920-h965-rw-v1" awidth="40" height="40" class="rounded-circle"/>
        @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-lg-end">
        <li><a class="dropdown-item" href="{{route('vendedor.home')}}">Inicio</a></li>

          <li><a class="dropdown-item" href="{{route('vendedor.profile')}}">Mis datos</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="">
              <form class="dropdown-item" action="{{ route('vendedor.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link"><i class="bi bi-box-arrow-right"></i>Cerrar sesión</button>
              </form>
            </a></li>
        </ul>
      </li>
      @endif
    </div>
  </div>
</nav>