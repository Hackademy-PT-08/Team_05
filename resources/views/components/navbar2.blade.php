<nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
  <div class="container  ">
    <!-- Logo che riporta alla Hompage -->
    <a class="navbar-brand" href="/">Navbar</a>
    <!-- Menu a tendina responsive -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
      <ul class="navbar-nav align-items-md-center  mb-2 mb-lg-0">
        <!-- Link crea annuncio visibile solo a chi è autentificato -->
        @if(auth()->check())
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('announcements.create') }}">Crea un annuncio</a>
        </li>
        @endif
        <!-- vista tutti gli annunci -->
        <li class="nav-item">
          <a class="nav-link click-scroll text-dark" href="{{ route('announcements.index') }}">Annunci</a>
        </li>
        <!-- menu a tendina con tutte le categorie -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorie</a>
          <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
            @foreach ($categories as $category)
              <li><a class="dropdown-item" href="{{ route('categoryShow', compact('category')) }}">{{ $category->name }}</a></li>
            @endforeach
          </ul>
        </li>
      
        <!-- barra di ricerca -->
        <form action="{{route('announcements.search')}}" method="get" class="d-flex">
          <input name="searched" type="search" class="form-control me-2" placeholder="Ricerca" aria-label="Ricerca">
          <button class="btn btn-outline-success" type="submit">Ricerca</button>
        </form>

        <!-- Menu utente -->
        <li class="nav-item dropdown d-flex align-items-center px-md-2 mx-md-2 ">
          <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <i class="fa-solid fa-circle-user fs-1 " style="color: #303640;"></i>
          </a>
          <ul id="dropdownMenu" class="dropdown-menu">
          <!-- Accedi registrati -->
          @if (!auth()->check())
          <li class="nav-item">
            <a class="nav-link text-dark" href="/login">Accedi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="/register">Registrati</a>
          </li>
          @else
          <!-- pagina profilo utente -->
          <li class="nav-item">
            <a class="nav-link text-dark" href="{{route('user.profile')}}">Profilo Utente</a>
          </li>

          <li class="nav-item mx-4 d-none">
            <form action="/logout" method="post">
              @csrf
              <input class="d-none" type="submit" value="Logout" id="logout-nav">
              
            </form>            
          </li>
          <li class="nav-item">
          <label class="nav-link text-dark" for="logout-nav">Logout</label>
          </li>
         @endif
           <!-- Visibile solo se si è revisori e registrati -->
        @if (auth()->check() && Auth::user()->is_revisor)
          <li class="nav-item">
            <a class="nav-link active btn btn-outline-success btn-sm position-relative" aria-current="page" href="{{route('revisor.index')}}">Zona revisore
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{App\Models\Announcement::toBeRevisionedCount()}}
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
          </li>
        @endif

          </ul>
          
        </li>
      </ul>
    </div>
  </div>
</nav>