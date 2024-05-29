<div class="container container-{{ $userType }}">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="rounded-3 my-5">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-4 fw-light fs-5">Registro como {{ $userType }}</h5>
                    <form action="{{ route($actionRoute) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="nombre{{ ucfirst($userType) }}">Nombre</label>
                                <input type="text" class="form-control" id="nombre{{ ucfirst($userType)}}" name="nombre" value="{{old('nombre')}}">
                                <x-error-message field="nombre" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido{{ ucfirst($userType) }}">Apellido</label>
                                <input type="text" class="form-control" id="apellido{{ ucfirst($userType) }}" name="apellido" value="{{old('apellido')}}">
                                <x-error-message field="apellido" />
                            </div>
                            <div class="form-group">
                                <label for="nickname">Nombre de usuario</label>
                                <input type="text" class="form-control" id="nickname" name="nickname" value="{{old('nickname')}}">
                                <x-error-message field="nickname" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pais{{ ucfirst($userType) }}">País</label>
                                <input type="text" class="form-control" id="pais{{ ucfirst($userType) }}" name="pais" value="{{old('pais')}}">
                                <x-error-message field="pais" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion{{ ucfirst($userType) }}">Dirección</label>
                                <input type="text" class="form-control" id="direccion{{ ucfirst($userType) }}" name="direccion" value="{{old('direccion')}}">
                                <x-error-message field="direccion" />
                            </div>

                            <div class="form-group">
                                <label for="ntelf">Número de teléfono</label>
                                <input type="tel" class="form-control" id="ntelf" name="telefono" value="{{old('telefono')}}">
                                <x-error-message field="telefono" />
                            </div>
                            <div class="form-group">
                                <label for="email{{ ucfirst($userType) }}">Correo electrónico</label>
                                <input type="email" class="form-control" id="email{{ ucfirst($userType) }}" name="email" value="{{old('email')}}">
                                <x-error-message field="email" />
                            </div>
                            <div class="form-group">
                                <label for="fecha_nac">Fecha de nacimiento</label>
                                @php
                                    $maxDate = date('Y-m-d');
                                    $minDate = date('Y-m-d', strtotime('1900-01-01'));
                                @endphp

                                <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" max="{{ $maxDate }}" min="{{ $minDate }}" value="{{ old('fecha_nac') }}">

                                <x-error-message field="fecha_nac" />
                            </div>
                            <div class="form-group">
                                <label for="contrasena{{ ucfirst($userType) }}">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena{{ ucfirst($userType) }}" name="password">
                                <x-error-message field="password" />
                            </div>
                            <div class="form-group">
                                <label for="contrasena{{ ucfirst($userType) }}Confirmation">Repetir contraseña</label>
                                <input type="password" class="form-control" id="contrasena{{ ucfirst($userType) }}Confirmation" name="password{{ ucfirst($userType) }}Confirmation">
                                <x-error-message field="password{{ ucfirst($userType) }}Confirmation" />
                            </div>
                            <div class="form-group mt-3">
                                {!! NoCaptcha::display(), NoCaptcha::renderJs() !!}
                                <x-error-message field="g-recaptcha-response" />
                            </div>
                            <div class="form-check d-flex justify-content-start mb-4 pb-3">
                                <input class="form-check-input me-3" type="checkbox" value="" id="form2Example3c" required />
                                <label class="form-check-label" for="form2Example3">
                                    <span> Acepto los <a href="#!" class=""><u>terminos y condiciones</u></a> de la pagina web</span>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-login fw-bold" type="submit">Registrarse</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>