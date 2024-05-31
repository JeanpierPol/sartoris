<nav class="navbar navbar-expand-lg navbar-comprador">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <form class="w-100" method="get" action="{{ route('buscar-productos') }}">
      <div class="bg-light rounded rounded-pill">
        <div class="input-group">
          <input type="search" name="search" class="form-control border-0 bg-light" placeholder="Buscar">
          <div class="input-group-append">
            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </div>
    </form>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown d-flex mr-4">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-cart"> <span class="badge bg-danger">{{count((array) session('cart'))}}</span></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end">
            @if (session('cart') !== null)
            @php
            $precio_final = 0;
            @endphp

            @foreach (session('cart') as $id => $producto)
              @php
                $precio_con_descuento = $producto['precio_venta'] - ($producto['precio_venta'] * ($producto['descuento'] / 100));
                $subtotal = $precio_con_descuento * $producto['cantidad'];
                $precio_final += $subtotal;
              @endphp
              <li>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="small">
                    <p class="small m-0">{{ $producto['nombre'] }}</p>
                    <div class="d-flex justify-content-between">
                      <span class="small">{{ $precio_con_descuento }}€ x {{ $producto['cantidad'] }}</span>
                    </div>
                  </div>
                  <form action="{{ route('delete-cart', $id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="badge bg-danger p-2 m-0 border-0">
                      <i class="bi bi-x-lg"></i>
                    </button>
                  </form>
                </div>
              </li>
            @endforeach
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="d-flex justify-content-between align-items-center px-3">
              <span class="fw-bold">Total:</span>
              <span class="fw-bold">{{ number_format($precio_final, 2) }}€</span>
            </li>

            <li class="d-flex justify-content-center" style="width: 100%;">
              <a href="{{ route('cart') }}" class="btn btn-warning btn-sm w-100 text-center">Ver el carrito</a>
            </li>
            @endif
          </ul>

        <li><a class="dropdown-item" href=""></a></li>
        </li>

        @if (!Auth::guard('comprador')->check())
        <li class="nav-item">
          <a class="nav-link" href="{{route('rol')}}">Login</a>
        </li>
        @endif
      </ul>
      @if (Auth::guard('comprador')->check())
      <li class="nav-item dropdown d-flex mr-4">
        <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="avatar-container">
            @if (Auth::guard('comprador')->user()->hasProfilePicture())
              <img src="{{ Auth::guard('comprador')->user()->imagen }}" class="avatar-image">
            @else
              <div class="default-avatar"></div>
            @endif
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg-end">
          <li><a class="dropdown-item" href="{{route('comprador.home')}}">Inicio</a></li>
          <li><a class="dropdown-item" href="{{route('comprador.profile')}}">Mis datos</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <form class="dropdown-item" action="{{ route('comprador.logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-link"><i class="bi bi-box-arrow-right"></i>Cerrar sesión</button>
            </form>
          </li>
        </ul>
      </li>
      @endif

    </div>
  </div>
</nav>
