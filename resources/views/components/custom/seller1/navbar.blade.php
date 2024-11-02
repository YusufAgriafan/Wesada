<div> 
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
    
            <a href="{{ route('usaha', ['name' => $usaha->name]) }}" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('custom1/img/logo.png') }}" alt="">
                <h1 class="sitename">{{ $usaha->name }}</h1>
            </a>
    
            <nav id="navmenu" class="navmenu">
                <ul>
                    @foreach ($navLinks as $navLink)
                        <x-custom.seller1.navlink :url="$navLink->url" :name="$navLink->name"/>
                    @endforeach
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>
</div>
