<div>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid {{ Request::is('/') ? 'header position-relative overflow-hidden p-0' : 'p-0' }}">
        <nav class="navbar navbar-expand-lg {{ Request::is('/') ? 'fixed-top navbar-light' : 'navbar-light bg-transparent' }} px-4 px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0">
                <h1 class="display-6 text-primary m-0"><i class="fas fa-money-bill-wave me-3"></i>Wesada</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <x-layout.navlink-main href="/" :active="request()->is('/')">Home</x-layout.navlink-main>
                    <x-layout.navlink-main href="/about" :active="request()->is('about')">About</x-layout.navlink-main>
                    <x-layout.navlink-main href="/service" :active="request()->is('service')">Service</x-layout.navlink-main>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="feature" class="dropdown-item">Features</a>
                            <a href="pricing" class="dropdown-item">Pricing</a>
                            <a href="blog" class="dropdown-item">Blog</a>
                            <a href="testimonial" class="dropdown-item">Testimonial</a>
                            <a href="404" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="contact" class="nav-item nav-link">Contact Us</a>
                    @auth
                        <x-layout.navlink-main href="/profile" :active="request()->is('profile')">Profil</x-layout.navlink-main>
                    @endauth
                </div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light border border-primary rounded-pill text-primary py-2 px-4 me-4">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill text-white py-2 px-4">Register</a>
                    @endif
                @endguest
                @auth
                    <a href="{{ route('logout') }}" class="btn btn-primary rounded-pill text-white py-2 px-4" id="logout-link">Log out</a>
                @endauth
            </div>
        </nav>
    

        @if(Request::is('/'))
            <!-- Hero Header Start -->
            <div class="hero-header overflow-hidden px-5">
                <div class="rotate-img">
                    <img src="{{ asset('/main/img/sty-1.png ') }}" class="img-fluid w-100" alt="">
                    <div class="rotate-sty-2"></div>
                </div>
                <div class="row gy-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <h1 class="display-4 text-dark mb-4 wow fadeInUp" data-wow-delay="0.3s">Jelajahi Potensi Bisnismu, Raih Kesuksesan di Usia Muda!</h1>
                        <p class="fs-4 mb-4 wow fadeInUp" data-wow-delay="0.5s">Mulailah perjalanan bisnismu sekarang dengan media pembelajaran yang interaktif, lengkap dengan analisis SWOT dan perhitungan RAB. Belajar sambil praktek langsung!</p>
                        
                        @guest
                            <a href="#" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">Mulai Sekarang</a>
                        @endguest

                        @auth
                            @if (auth()->user()->role === 'user')
                                <a href="#" class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.7s">Mulai Sekarang</a>
                            @endif
                        @endauth
                        
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <img src="{{ asset('/main/img/hero-img-1.png ') }}" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
            </div>
            <!-- Hero Header End -->
        @endif
    </div>
    <!-- Navbar & Hero End -->
</div>
