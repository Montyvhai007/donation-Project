<nav class="d-flex navbar navbar-expand-md" style="background-color: #2E2E3A; border-bottom: 1px solid white;">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('home.index') }}">{{ env('APP_NAME') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: white;"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white @if(Route::is('home.index')) active text-custom-highlight @endif" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if(Route::is('home.donate')) active text-custom-highlight @endif" href="{{ route('home.donate') }}">Donate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if(Route::is('home.about')) active text-custom-highlight @endif" href="{{ route('home.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if(Route::is('home.albums')) active text-custom-highlight @endif" href="{{ route('home.albums') }}">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if(Route::is('home.contact')) active text-custom-highlight @endif" href="{{ route('home.contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border rounded px-2 py-1 mt-1 ms-2 bg-light text-black" href="https://github.com/Montyvhai007/donation-Project" target="_blank">
                        <i class="fab fa-github fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
