<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0a7e8c;">
    <div class="container-fluid">
        <a class="navbar-brand fs-3" style="font-family: Helvetica" href="#">MyResepi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav fs-5 px-5">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}"
                    href="/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="/posts">Recipies</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Hello, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/dashboard/posts"><i class="bi bi-layout-text-sidebar-reverse"></i>    Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right">
                                    </i> Logout</button>
                                </form>
                        </ul>
                    </li>
                {{-- @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}"><i
                                class="bi bi-box-arrow-in-right"></i>
                            Login</a>
                    </li> --}}
        @endauth
            </ul>
        </div>
    </div>
</nav>
