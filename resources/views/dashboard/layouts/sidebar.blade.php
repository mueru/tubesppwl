<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
                    <span data-feather="file-text"></span>
                    My Posts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <span data-feather="arrow-left-circle"></span>
                    Go Back
                </a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link" style="background-color: transparent; border:none"> <span data-feather="log-out"></span> Logout</button>
                </form>
            </li>


            @can('admin')
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Admin</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/admin') ? 'active' : '' }}"
                            href="/dashboard/admin">
                            <span data-feather="user"></span>
                            Post List   
                        </a>
                    </li>
                </ul>
            @endcan
        </ul>
    </div>
</nav>
