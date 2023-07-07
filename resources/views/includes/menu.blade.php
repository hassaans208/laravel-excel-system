<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-nav-link h5" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>
    <ul class="c-sidebar-nav">
        @if (Route::has('admin.home'))
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">
                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @endif

        @if (Route::has('admin.users.index'))
        <li class="c-sidebar-nav-dropdown {{ request()->is(" admin/users*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.users.main.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/users")}}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon"></i>
                        {{ trans('cruds.users.index.title') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.users.create') }}" class="c-sidebar-nav-link {{ request()->is("admin/users/create") }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon"></i>
                        {{ trans('cruds.users.create.title') }}
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (Route::has('admin.customers.index'))
        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/customers*") ? "c-show" : "" }}">
            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                {{ trans('cruds.customers.main.title') }}
            </a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.customers.index') }}" class="c-sidebar-nav-link {{ request()->is("
                        admin/customers")}}">
                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon"></i>
                        {{ trans('cruds.customers.index.title') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a href="{{ route('admin.customers.create') }}" class="c-sidebar-nav-link {{ request()->is("admin/users/create") }}">
                        <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon"></i>
                        {{ trans('cruds.customers.create.title') }}
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
