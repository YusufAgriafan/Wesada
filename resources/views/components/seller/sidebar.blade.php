<div>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="/" class="text-nowrap logo-img">
                    <img src="{{ asset('/admin/images/logos/logo-light.svg ') }}" alt="" />
                </a>
                <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <x-admin.sidebar-label>Home</x-admin.sidebar-label>
                    <x-admin.sidebar-link href="{{ route('seller.index') }}" :active="request()->is('seller.index')" icon="solar:home-smile-bold-duotone">Dashboard</x-admin.sidebar-link>
                    
                    <x-admin.sidebar-label>Kalkulator</x-admin.sidebar-label>
                    <x-admin.sidebar-link href="{{ route('admin.index') }}" :active="request()->is('seller.index')" icon="solar:home-smile-bold-duotone">Dashboard</x-admin.sidebar-link>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
</div>