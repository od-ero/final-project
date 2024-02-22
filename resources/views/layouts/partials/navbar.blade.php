 <header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
      </a>

   
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
      </form>

      @auth
      {{ auth()->user()->name }}
    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
        <li><a href="/units/create" class="nav-link px-2 text-white">Add A Room</a></li>

        @isset($encoded_permission_id)
            <li><a href="/add/permissions/{{ $encoded_permission_id }}" class="nav-link px-2 text-white">Give Permission</a></li>
            <li><a href="/make/schedule/{{ $encoded_permission_id }}" class="nav-link px-2 text-white">Activate Button Access</a></li>
        @endisset
    </ul>

        <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-light me-2">Logout</a>
        </div>
      @endauth

      @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
    </div>
  </div>
</header> 
<meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
   
<body class="bg-darnger text-white p-3 m-0 border-0 bd-example">

    <!-- Example Code -->
    
    <nav class="navbar navbar-expand-lg bg-dark text-white">
      <div class="container-fluid">
      @auth
      {{ auth()->user()->name }}
      <a href="#" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-home"></span> Home
        </a>
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            @isset($encoded_permission_id)
            <li class="nav-item">
              <a class="nav-link" href="/add/permissions/{{ $encoded_permission_id }}">Give Permission</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/make/schedule/{{ $encoded_permission_id }}">Activate Button Access</a>
            </li>
            @endisset
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <a href="/units/create" class="nav-link">Add A Room</a>
            </li>
          </ul>
          <div class="text-end">
          <a href="{{ route('logout.perform') }}" class="btn btn-outline-danger me-2">Logout</a>
        </div>
        @endauth
        @guest
        <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-success me-2">Login</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
        </div>
      @endguest
         
        </div>
      </div>
    </nav>
    
    <!-- End Example Code -->
  </body>