<section class="profile-{{ $userType }} container-{{ $userType }}">
  <div class="container py-5">
    <div class="row">
      <div class="col">
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            @if (Auth::user()->hasProfilePicture())
            <img src="{{ Auth::user()->imagen }}" class="rounded-circle img-fluid" style="width: 150px;" />
            @else
            <img src="https://lh3.googleusercontent.com/drive-viewer/AKGpihYVKuxiNrVgjma-ISqJ1CRZHQZ-Z4Jk5BCxJ6ze627neDniNHfyaO6qcSS6oiOb9oNKppBOJkzBbUrtSZ_5APBo_ALXPvzMH24=w1920-h965-rw-v1" class="rounded-circle img-fluid" style="width: 150px;" />
            @endif
            <h5 class="my-3">{{Auth::user()->nombre}} {{Auth::user()->apellido}}</h5>
            <p class="text-muted mb-1">Rol {{ $userType }}</p>
            <p class="text-muted mb-4">{{Auth::user()->provincia}}, {{Auth::user()->direccion}}</p>
            <div class="d-flex justify-content-center mb-2">
              <div class="d-grid">
                <a class="btn fw-bold btn-login" href="{{route($actionRoute)}}">Modificar datos</a>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->nombre}}</p>
              </div>
            </div>
            <hr>

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Apellido</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->apellido}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nickname</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->nickname}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Fecha de nacimiento</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{date('d-m-Y', strtotime(Auth::user()->fecha_nac))}}</p>

              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Número de teléfono</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->telefono}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->email}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Dirección</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{Auth::user()->direccion}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>