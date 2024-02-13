<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 h-screen pt-28 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 md:w-[15%] lg:block lg:w-[15%] w-1/2"
    aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="font-medium">

            <x-sidebar-item title="Dashboard" route="" active="{{ request()->routeIs('admin.dashboard') }}"
                icon="fas fa-tachometer-alt" />

            <!-- User Management -->
            <x-sidebar-dropdown title="User Management" icon="fas fa-cog" toggle="user-management" active="">
                <x-sidebar-item title="Registration" route="" active="" />
                <x-sidebar-item title="Authorization" route="" active="" />
            </x-sidebar-dropdown>

            <!-- CCD Management -->
            <x-sidebar-dropdown title="CCD Management" icon="fas fa-chart-simple" toggle="ccd-management"
                active="">
                <x-sidebar-item title="Client" route="" active="" />
                <x-sidebar-item title="Case" route="" active="" />
                <x-sidebar-item title="Document" route="" active="" />
                <x-sidebar-item title="Report" route="" active="" />
            </x-sidebar-dropdown>

            <!-- Client Trader Mapping -->
            <x-sidebar-item title="Client Trader Mapping" route="" active="" icon="fas fa-map-marked-alt" />

            <!-- Ticket Management -->
            <x-sidebar-item title="Ticket Management" route="" active="" icon="fas fa-ticket-alt" />

            <!-- House Balance -->
            <x-sidebar-item title="House Balance" route="" active="" icon="fas fa-balance-scale" />

            <!-- Monitor and Report -->
            <x-sidebar-item title="Monitor and Report" route="" active="" icon="fas fa-chart-line" />

            <!-- User Management -->
            <x-sidebar-dropdown title="User" icon="fas fa-users" toggle="user" active="">
                <x-sidebar-item title="Add User" route="" active="" />
                <x-sidebar-item title="User List" route="" active="" />
            </x-sidebar-dropdown>

            <!-- Settings -->
            <x-sidebar-item title="Settings" route="" active="" icon="fas fa-cogs" />

            <!-- Log out -->
            <x-sidebar-item title="Keluar" icon="fas fa-sign-out-alt" route="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </ul>
    </div>
</aside>
