@php
    $menu = new \App\Libraries\AdminMenu();

    // Dashboard
    $menu->add('dashboard', ['title' => 'Dashboard', 'icon' => 'ti ti-home', 'url' => route('admin.home')]);

    // Admin Management
    $menu->add('admin_mgmt', ['title' => 'Admin Management', 'icon' => 'ti ti-radioactive', 'url' => null]);
    $menu->addSubmenu(['title' => 'Roles', 'url' => route('admin.roles.index')]);
    $menu->addSubmenu(['title' => 'Permissions', 'url' => route('admin.permissions.index')]);
    $menu->addSubmenu(['title' => 'Admins', 'url' => route('admin.admins.index')]);

    // User Management
    $menu->add('user_mgmt', ['title' => 'User Management', 'icon' => 'ti ti-users', 'url' => null]);
    $menu->addSubmenu(['title' => 'Users', 'url' => route('admin.users.index')]);

@endphp

<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68"
                    class="navbar-brand-image">
                    <path
                        d="M64.6 16.2C63 9.9 58.1 5 51.8 3.4 40 1.5 28 1.5 16.2 3.4 9.9 5 5 9.9 3.4 16.2 1.5 28 1.5 40 3.4 51.8 5 58.1 9.9 63 16.2 64.6c11.8 1.9 23.8 1.9 35.6 0C58.1 63 63 58.1 64.6 51.8c1.9-11.8 1.9-23.8 0-35.6zM33.3 36.3c-2.8 4.4-6.6 8.2-11.1 11-1.5.9-3.3.9-4.8.1s-2.4-2.3-2.5-4c0-1.7.9-3.3 2.4-4.1 2.3-1.4 4.4-3.2 6.1-5.3-1.8-2.1-3.8-3.8-6.1-5.3-2.3-1.3-3-4.2-1.7-6.4s4.3-2.9 6.5-1.6c4.5 2.8 8.2 6.5 11.1 10.9 1 1.4 1 3.3.1 4.7zM49.2 46H37.8c-2.1 0-3.8-1-3.8-3s1.7-3 3.8-3h11.4c2.1 0 3.8 1 3.8 3s-1.7 3-3.8 3z"
                        fill="#066fd1" style="fill: var(--tblr-primary, #066fd1)"></path>
                    <path
                        d="M105.8 46.1c.4 0 .9.2 1.2.6s.6 1 .6 1.7c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v-3.1c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v3.1h3.4c.8 0 1.4.3 1.9.8s.8 1.2.8 1.9-.3 1.4-.8 1.8-1.2.7-1.9.7h-3.4v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm28-20.7c.8 0 1.5.3 2.1.8.5.5.8 1.2.8 2.1v20.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.2-.8-2.1c-.8.9-1.9 1.7-3.2 2.4-1.3.7-2.8 1-4.3 1-2.2 0-4.2-.6-6-1.7-1.8-1.1-3.2-2.7-4.2-4.7s-1.6-4.3-1.6-6.9c0-2.6.5-4.9 1.5-6.9s2.4-3.6 4.2-4.8c1.8-1.1 3.7-1.7 5.9-1.7 1.5 0 3 .3 4.3.8 1.3.6 2.5 1.3 3.4 2.1 0-.8.3-1.5.8-2.1.5-.5 1.2-.7 2-.7zm-9.7 21.3c2.1 0 3.8-.8 5.1-2.3s2-3.4 2-5.7-.7-4.2-2-5.8c-1.3-1.5-3-2.3-5.1-2.3-2 0-3.7.8-5 2.3-1.3 1.5-2 3.5-2 5.8s.6 4.2 1.9 5.7 3 2.3 5.1 2.3zm32.1-21.3c2.2 0 4.2.6 6 1.7 1.8 1.1 3.2 2.7 4.2 4.7s1.6 4.3 1.6 6.9-.5 4.9-1.5 6.9-2.4 3.6-4.2 4.8c-1.8 1.1-3.7 1.7-5.9 1.7-1.5 0-3-.3-4.3-.9s-2.5-1.4-3.4-2.3v.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.5-.8-1.2-.8-2.1V18.9c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v10c.8-1 1.8-1.8 3.2-2.5 1.3-.7 2.8-1 4.3-1zm-.7 21.3c2 0 3.7-.8 5-2.3s2-3.5 2-5.8-.6-4.2-1.9-5.7-3-2.3-5.1-2.3-3.8.8-5.1 2.3-2 3.4-2 5.7.7 4.2 2 5.8c1.3 1.6 3 2.3 5.1 2.3zm23.6 1.9c0 .8-.3 1.5-.8 2.1s-1.3.8-2.1.8-1.5-.3-2-.8-.8-1.3-.8-2.1V18.9c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v29.7zm29.3-10.5c0 .8-.3 1.4-.9 1.9-.6.5-1.2.7-2 .7h-15.8c.4 1.9 1.3 3.4 2.6 4.4 1.4 1.1 2.9 1.6 4.7 1.6 1.3 0 2.3-.1 3.1-.4.7-.2 1.3-.5 1.8-.8.4-.3.7-.5.9-.6.6-.3 1.1-.4 1.6-.4.7 0 1.2.2 1.7.7s.7 1 .7 1.7c0 .9-.4 1.6-1.3 2.4-.9.7-2.1 1.4-3.6 1.9s-3 .8-4.6.8c-2.7 0-5-.6-7-1.7s-3.5-2.7-4.6-4.6-1.6-4.2-1.6-6.6c0-2.8.6-5.2 1.7-7.2s2.7-3.7 4.6-4.8 3.9-1.7 6-1.7 4.1.6 6 1.7 3.4 2.7 4.5 4.7c.9 1.9 1.5 4.1 1.5 6.3zm-12.2-7.5c-3.7 0-5.9 1.7-6.6 5.2h12.6v-.3c-.1-1.3-.8-2.5-2-3.5s-2.5-1.4-4-1.4zm30.3-5.2c1 0 1.8.3 2.4.8.7.5 1 1.2 1 1.9 0 1-.3 1.7-.8 2.2-.5.5-1.1.8-1.8.7-.5 0-1-.1-1.6-.3-.2-.1-.4-.1-.6-.2-.4-.1-.7-.1-1.1-.1-.8 0-1.6.3-2.4.8s-1.4 1.3-1.9 2.3-.7 2.3-.7 3.7v11.4c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.6-.8-1.3-.8-2.1V28.8c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v.6c.7-1.3 1.8-2.3 3.2-3 1.3-.7 2.8-1 4.3-1z"
                        fill-rule="evenodd" clip-rule="evenodd" fill="#4a4a4a"></path>
                </svg>
            </a>
        </div>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="d-flex d-lg-none me-2">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" aria-label="Enable dark mode" data-bs-original-title="Enable dark mode">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" aria-label="Enable light mode"
                    data-bs-original-title="Enable light mode">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7">
                        </path>
                    </svg>
                </a>
            </div>
            @include('admin.layouts.components.profile_dropdown')
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                @foreach ($menu->array() as $m)
                    @php
                        $hasSubmenu = isset($m['submenu']);
                    @endphp
                    <li class="nav-item mt-1 {{ $hasSubmenu ? 'dropdown' : '' }}" data-url="{{ $m['url'] ?? '' }}">
                        <a class="nav-link {{ $hasSubmenu ? 'dropdown-toggle' : '' }}"
                            href="{{ $m['url'] ?? 'javascript:;' }}"
                            @if ($hasSubmenu) data-bs-toggle="dropdown"
                                        data-bs-auto-close="false" role="button" aria-expanded="false" @endif>
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="{{ $m['icon'] ?? '' }} h2"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ $m['title'] ?? '' }}
                            </span>
                        </a>

                        @if ($hasSubmenu)
                            <div class="dropdown-menu">
                                <div class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        @foreach ($m['submenu'] as $sm)
                                            <a class="dropdown-item" href="{{ $sm['url'] ?? 'javascript:;' }}">
                                                {{ $sm['title'] ?? '' }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</aside>


@push('script')
    <script>
        window.onload = function() {
            var currentUrl = window.location.href.split('?')[0]; // Strip query parameters
            var currentPathname = window.location.pathname; // Get current path

            // Reset all active states
            $('.nav-item').removeClass('active');
            $('.dropdown-menu').removeClass('show');
            $('.nav-link').removeClass('active');
            $('.nav-link').attr('aria-expanded', 'false');

            // Track the active item
            var $activeItem = null;

            // Activate the top-level menu item and handle dropdown
            $('.nav-item').each(function() {
                var itemUrl = $(this).data('url');
                if (itemUrl) {
                    itemUrl = itemUrl.split('?')[0]; // Strip query parameters

                    if (currentUrl === itemUrl || currentPathname.startsWith(itemUrl)) {
                        $(this).addClass('active');
                        $(this).find('.nav-link').addClass('active');

                        // Handle dropdowns
                        if ($(this).hasClass('dropdown')) {
                            $(this).find('.dropdown-menu').addClass('show');
                            $(this).find('.nav-link').attr('aria-expanded', 'true');
                        }

                        $activeItem = $(this);
                    }
                }
            });

            // Activate submenu items
            $('.dropdown-menu a').each(function() {
                var submenuUrl = $(this).attr('href');
                if (submenuUrl) {
                    submenuUrl = submenuUrl.split('?')[0]; // Strip query parameters

                    if (currentUrl === submenuUrl || currentUrl.startsWith(submenuUrl)) {
                        $(this).addClass('active text-white');
                        $(this).closest('.dropdown-menu').addClass('show');
                        $(this).closest('.nav-item').addClass('active');
                        $(this).closest('.nav-item').find('.nav-link').attr('aria-expanded', 'true');

                        if (!$activeItem) {
                            $activeItem = $(this).closest('.nav-item');
                        }
                    }
                }
            });

            // Scroll the parent 'navbar' container to the active item
            if ($activeItem) {
                var $scrollParent = $('.navbar-vertical'); // Select the navbar parent container

                // Scroll the navbar to the active item
                $scrollParent.animate({
                    scrollTop: $activeItem.position().top + $scrollParent.scrollTop() -
                        100 // Adjust offset as needed
                }, 500);
            }
        };
    </script>
@endpush
