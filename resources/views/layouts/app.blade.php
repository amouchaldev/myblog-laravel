<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- bootstrap - js - css --}}
    @vite(['resources/js/app.js'])
    {{-- bootswatch - minty --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css" integrity="sha384-H4X+4tKc7b8s4GoMrylmy2ssQYpDHoqzPa9aKXbDwPoPUA3Ra8PA5dGzijN+ePnH" crossorigin="anonymous">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    @yield('style');
</style>
<body>
{{-- navbar --}}
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="/">MyBlog</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                @if(session()->has('loginEmail'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('create') }}">Add Post <span class="visually-hidden">(current)</span></a>
                </li>
                @endif
                
                {{-- <li class="nav-item">
                    <a class="nav-link text-light" href="#">Comments</a>
                </li> --}}
            </ul>
            @if(session()->has('loginEmail'))
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->firstName}}
                        </a>
                    
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('logout') }}">logout</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
            @else 
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">login</a>
                </li>
            </ul>
            @endif
              
        </div>
  </div>
</nav>


{{-- end navbar --}}
{{-- content --}}
    <main>
        <div class="container py-4">
            @yield('content')
        </div>
    </main>


    <footer class="bg-primary text-center py-3 text-light"><p>&copy; {{ date('Y') }}</p></footer>
</body>
</html>