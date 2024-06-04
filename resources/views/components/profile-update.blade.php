<section class="profile-{{ $userType }} container-{{ $userType }}">

    <div class="container py-5">
      <div class="row">
        <div class="col">
        </div>
      </div>

      <div class="row">
        <div class="col-xl-3 mx-auto">
          <div class="card mb-4">
            <div class="card-header">Foto de perfil</div>
            <div class="card-body text-center">
              @if (Auth::user()->hasProfilePicture())
              <img src="{{ Auth::user()->imagen }}" class="rounded-circle img-fluid" style="width: 150px;" />
             
              @else
              <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihYVKuxiNrVgjma-ISqJ1CRZHQZ-Z4Jk5BCxJ6ze627neDniNHfyaO6qcSS6oiOb9oNKppBOJkzBbUrtSZ_5APBo_ALXPvzMH24=w1920-h965-rw-v1" class="rounded-circle img-fluid" style="width: 150px;" />
              @endif
              <form action="{{ route($actionRoute) }}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="mt-4 mb-4">
              <input class="form-control" type="file" id="formFile" name="imagen" accept="image/png, image/jpeg" />
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-xl-9 mx-auto">
        <div class="card mb-4">
          <div class="card-header">Detalles de la cuenta</div>
          <div class="card-body">
              <div class="row gx-2 mb-2">
                <div class="col-md-6">
                  <label class="small mb-1" for="nombre{{ ucfirst($userType)}}">Nombre</label>
                  <input class="form-control" id="nombre{{ ucfirst($userType)}}" type="text" value="{{ Auth::user()->nombre}}" name="nombre">
                  <x-error-message field="nombre" />
                </div>
                <div class="col-md-6">
                  <label class="small mb-1" for="apellido{{ ucfirst($userType)}}">Apellido</label>
                  <input class="form-control" id="apellido{{ ucfirst($userType)}}" type="text" value="{{Auth::user()->apellido}}" name="apellido">
                  <x-error-message field="apellido" />
                </div>
              </div>
              <div class="row gx-3 mb-3">
                <div class="col-md-6">
                  <label class="small mb-1" for="provincia{{ ucfirst($userType)}}">Provincia</label>
                  <select name="provincia" id="provincia" class="form-control form-select" aria-label=".form-select-lg">
                      <optgroup>
                      </optgroup>
                  </select>
                  <x-error-message field="provincia" />
                </div>
                <div class="col-md-6">
                  <label class="small mb-1" for="direccion{{ ucfirst($userType)}}">Dirección</label>
                  <input class="form-control" id="direccion{{ ucfirst($userType)}}" type="text" value="{{Auth::user()->direccion}}" name="direccion">
                  <x-error-message field="direccion" />
                </div>
              </div>
              <div class="mb-3">
                <label class="small mb-1" for="nickname{{ ucfirst($userType)}}">Nickname </label>
                <input class="form-control" id="nickname{{ ucfirst($userType)}}" type="text" value="{{Auth::user()->nickname}}" name="nickname">
                <x-error-message field="nickname" />
              </div>
              <div class="mb-3">
                <label class="small mb-1" for="email{{ ucfirst($userType)}}">Email </label>
                <input class="form-control" id="email{{ ucfirst($userType)}}" type="email" value="{{Auth::user()->email}}" name="email">
                <x-error-message field="email" />
              </div>
              <div class="row gx-3 mb-3">
                <div class="col-md-6">
                  <label class="small mb-1" for="ntelf">Número de teléfono</label>
                  <input class="form-control" id="ntelf" type="tel" value="{{Auth::user()->telefono}}" name="telefono">
                  <x-error-message field="telefono" />
                </div>
                <div class="col-md-6">
                  <label class="small mb-1" for="fecha_nac">Fecha de nacimiento</label>
                  <input class="form-control" id="fecha_nac" type="date" value="{{date('Y-m-d', strtotime(Auth::user()->fecha_nac))}}" min="{{date('Y-m-d', strtotime('1900-01-01'))}}" max="{{date('Y-m-d')}}" name="fecha_nac">
                  <x-error-message field="fecha_nac" />
                </div>
              </div>
              <input type="submit" value="Guardar cambios" class="btn btn-login">
              <a href="javascript:history.back()" class="btn btn-login fw-bold">Cancelar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>

<script>
        let comunidades = null;

        async function provincias() {
            const response = await fetch("https://raw.githubusercontent.com/frontid/ComunidadesProvinciasPoblaciones/master/ccaa.json");
            comunidades = await response.json();

            let inputProvincia = document.querySelector('#provincia');

            inputProvincia.innerHTML = '';

            comunidades.forEach(comunidad => {
                console.log(comunidad)
                let option = document.createElement('option');
                option.value = comunidad.label;
                option.textContent = comunidad.label;
                inputProvincia.appendChild(option);
            });
        }

    window.onload = provincias;
    </script>