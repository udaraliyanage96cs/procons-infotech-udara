<ul class="menu-inner py-1">
    @auth
        <li class="menu-item @if ($page == 'Home') active @endif mt-1">
            <a href="/dashboard" class="menu-link">
                <i class='menu-icon bx bxs-map-alt'></i>
                <div>Home</div>
            </a>
        </li>
        <li class="menu-item @if ($page == 'Reports' || Request::is('*/reports/*') ) active @endif mt-1">
            <a href="/dashboard/reports" class="menu-link">
                <i class='menu-icon bx bxs-report'></i>
                <div>Reports</div>
            </a>
        </li>
    @endauth
</ul>

