<div class="container container-{{ $userType }}">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-4 fw-light fs-5">Inicia sesión como {{ $userType }}</h5>
                    @if ($errors->has('login'))
                    <div class="alert alert-danger mb-4">
                        {{ $errors->first('login') }}
                    </div>
                    @endif
                    <form action="{{ route($actionRoute) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email{{ ucfirst($userType) }}">Correo electrónico</label>
                            <input type="email" class="form-control" id="email{{ ucfirst($userType) }}" name="email" value="{{ old('email') }}">
                            <x-error-message field="email" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="contrasena{{ ucfirst($userType) }}">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena{{ ucfirst($userType) }}" name="password">
                            <x-error-message field="password" />
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-login fw-bold" type="submit">Iniciar sesión</button>
                        </div>
                        <div class="mb-3 mt-3">
                            <span class="">¿No tienes cuenta? <a href="{{ route($registerRoute) }}">Regístrate</a></span>
                        </div>
                        <hr class="my-4">
                        <div class="d-grid mb-2">
                            <button class="btn btn-google fw-bold" type="submit">
                                <i class="bi bi-google"></i> Continuar con Google
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
