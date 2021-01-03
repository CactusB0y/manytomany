<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Navbar</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                  </li>
                </ul>
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
          </nav>
    </header>
    <section>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">nom</th>
                <th scope="col"> </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($matieres as $matiere)
                    <tr>
                        <td>{{$matiere->nom}}</td>
                        <td>
                            @if (Auth::user()->matieres->contains("id",$matiere->id))
                              <form action="/detach/{{Auth::user()->id}}" method="post">
                                @csrf
                                <input class="d-none" type="text" value="{{$matiere->id}}" name="matiere_id">
                                <button type="submit" class="btn btn-danger">se desabonner</button>
                              </form> 
                            @else
                              <form action="/attach/{{Auth::user()->id}}" method="post">
                                  @csrf
                                  <input class="d-none" type="text" value="{{$matiere->id}}" name="matiere_id">
                                  <button type="submit" class="btn btn-success">s'abonner</button>
                              </form>   
                            @endif
                        </td>
                    </tr> 
                @endforeach
            </tbody>
          </table>
          <h1>mes abonnements</h1>
                @foreach (Auth::user()->matieres as $item)
                    <p>{{$item->nom}}</p>
                @endforeach
    </section>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>