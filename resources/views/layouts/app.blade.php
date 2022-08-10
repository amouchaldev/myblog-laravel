<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyBlog</title>
    {{-- bootstrap - js - css --}}
    @vite(['resources/js/app.js'])
    {{-- bootswatch --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.0/cosmo/bootstrap.min.css" integrity="sha512-QbZE7wIoZ9KJH/ruhziXsxEbMYKqw+PmhlroAdVcqJnoYhmZmU5lWWyCx20RrZpxfeS6NdFV1+KoReUQmNKHcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body {
        overflow-x: hidden;
    }
    footer .form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #ffffff;
            opacity: .7; /* Firefox */
    }

    footer .form-control::-ms-input-placeholder { /* Microsoft Edge */
                color: rgb(255, 255, 255);
    }
    .nav-logo {
        width: 99px;
    }
    @yield('style');
</style>
<body>
    {{-- start header --}}
    <header>
        {{-- navbar --}}
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
              <div class="container">
                <a class="navbar-brand" href="/"><img class="nav-logo" src="{{ Storage::url('logo.png') }}" alt="logo"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        {{-- show this items if user login --}}
                        @if(session()->has('loginEmail'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('create') }}">Add Post <span class="visually-hidden">(current)</span></a>
                            </li>
                        {{-- show this items if user are admin or owner --}}
                            @if(in_array(session()->get('loginRole'), ['admin', 'owner']))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        More
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        
                                        <li class="dropdown-item">
                                            <a class="nav-link text-dark" href="{{ route('comments.review') }}">Review Comments <span class="visually-hidden">(current)</span></a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a class="nav-link text-dark" href="{{ route('getMessages') }}">Messages<span class="visually-hidden">(current)</span></a>
                                        </li>
            
                                    </ul>
                                </li>
                            @endif
                        @endif
                        {{-- show this items if user login --}}
                        @if (!session()->has('loginEmail'))
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#about-us">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#contact-us">Contact Us</a>
                            </li>
                        @endif
                    </ul>
                    {{-- show this drop down menu if user has login--}}
                    @if(session()->has('loginEmail'))
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ session()->get('loginFirstName') }}
                                </a>
                            
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @if(session()->get('loginRole') === 'owner')
                                        <li><a class="dropdown-item" href="{{ route('users.create') }}">Add User</a></li>
                                    @endif
                                <li><a class="dropdown-item" href="{{ route('logout') }}">logout</a></li>
                                </ul>
                            </div>
                    @else 
                    {{-- show this drop diwn if user has not logged --}}
                        <div class="dropdown ms-auto">
                            <button class="btn btn-light bbtn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            </ul>
                        </div>
                    @endif       
                </div>
          </div>
        </nav>
        {{-- end navbar --}}

        {{-- start slider --}}
        @yield('slider')
        {{-- end slider --}}
        
    </header>
    {{-- end header --}}
{{-- main content --}}
    <main class="">
            @yield('content')
    </main>
{{-- end main content --}}
{{-- start footer --}}
    <footer class="bg-primary py-5">
        <div class="container">
            <div class="row">
                {{-- start about us --}}
                <div class="col-md-6 text-white order-2 order-md-1" id="about-us">
                        <h6 class="h1 mb-3"><img src="{{ Storage::url('logo.png') }}" alt="logo"></h6>
                        <p class="pe-5 mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eveniet ipsa accusantium sapiente labore nemo vero in, totam ducimus ex inventore eius. Est dolores, iusto unde incidunt quisquam in saepe!</p>
                        <div class="social-media mb-3">
                            <a href="#" class="text-white me-3"><i class="fa-brands fa-facebook fa-xl"></i></a>
                            <a href="#" class="text-white me-3"><i class="fa-brands fa-twitter fa-xl"></i></a>
                            <a href="#" class="text-white me-3"><i class="fa-brands fa-linkedin-in fa-xl"></i></a>
                        </div>
                        <span>&copy; {{ date('Y') }}</span>
                </div>
                {{-- end about us --}}
                {{-- start contact us --}}
                <div class="col-md-6 order-1 order-md-2 mb-4" id="contact-us">
                    <h3 class="text-white fs-1 mb-3">Contact Us</h3>
                    <form action="{{ route('sendMessage') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control bg-transparent rounded text-light" id="fullName" name="fullName" placeholder="Full Name" value="{{ old('fullName') }}">
                            @error('fullName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control bg-transparent rounded text-light" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <textarea name="content" id="" class="form-control bg-transparent rounded text-light" cols="30" rows="10" placeholder="Message">{{ old('content') }}</textarea>
                            @error('content') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">Send</button>
                            @if(session()->has('success'))
                                <p class="alert alert-success mt-3">{{ session()->get('success') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
                {{-- end contact us --}}
            </div>
        </div>
    </footer>
    {{-- end footer --}}
</body>
</html>