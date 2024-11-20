<nav class="navbar">
    <ul class="navbar__menu">
        @foreach([
            ['icon' => 'home', 'label' => 'Home'],
            ['icon' => 'message-square', 'label' => 'Messages'],
            ['icon' => 'users', 'label' => 'Customers'],
            ['icon' => 'folder', 'label' => 'Projects'],
            ['icon' => 'archive', 'label' => 'Resources'],
            ['icon' => 'help-circle', 'label' => 'Help'],
            ['icon' => 'settings', 'label' => 'Settings'],
        ] as $item)
        <li class="navbar__item">
            <a href="#" class="navbar__link" aria-label="{{ $item['label'] }}">
                <i data-feather="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
