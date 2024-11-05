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
                    <x-admin.sidebar-link href="{{ route('seller.custom') }}" :active="request()->is('seller.custom')" icon="solar:paint-roller-bold-duotone">Custom</x-admin.sidebar-link>
                    <x-admin.sidebar-link href="{{ route('seller.chat') }}" :active="request()->is('seller.chat')" icon="solar:chat-dots-bold-duotone">AI Chat</x-admin.sidebar-link>
                    
                    <x-admin.sidebar-label>Kalkulator</x-admin.sidebar-label>
                    <x-admin.sidebar-link href="{{ route('seller.variabel') }}" :active="request()->is('seller.variabel')" icon="solar:cart-large-minimalistic-bold-duotone">Biaya Variabel</x-admin.sidebar-link>
                    <x-admin.sidebar-link href="{{ route('seller.tetap') }}" :active="request()->is('seller.tetap')" icon="solar:cart-3-bold-duotone">Biaya Tetap</x-admin.sidebar-link>
                    <x-admin.sidebar-link href="{{ route('seller.hitung') }}" :active="request()->is('seller.hitung')" icon="solar:calculator-minimalistic-bold-duotone">Hitung</x-admin.sidebar-link>
                    <x-admin.sidebar-link href="{{ route('seller.dataHitung') }}" :active="request()->is('seller.dataHitung')" icon="solar:shop-2-bold-duotone">Manajemen</x-admin.sidebar-link>
                    <x-admin.sidebar-link href="{{ route('seller.pdf') }}" :active="request()->is('seller.pdf')" icon="solar:shop-2-bold-duotone">Download</x-admin.sidebar-link>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
</div>