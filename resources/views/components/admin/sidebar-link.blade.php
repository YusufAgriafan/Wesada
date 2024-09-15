<div>
    <li class="sidebar-item">
        <a class="sidebar-link {{ $active ? 'active':' ' }}" {{ $attributes }} aria-expanded="false">
            <span>
                <iconify-icon icon="{{ $icon }}" class="fs-6"></iconify-icon>
            </span>
            <span class="hide-menu">{{ $slot }}</span>
        </a>
    </li>
</div>