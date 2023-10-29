<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('public/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name ?? '' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            @foreach (config('sidebar.menu') as $menu_key => $menu)
                @if (auth()->user()->access('Menu >>' . $menu_key))
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                {{ $menu_key }}
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @foreach ($menu['submenu'] as $submenu_key => $submenu)
                                @if (auth()->user()->access('Menu >>' . $menu_key . '>>' . $submenu_key))
                                    <li class="nav-item">
                                        <a @isset($submenu['target']) target="{{ $submenu['target'] }}" @endisset
                                            href="@if (Route::has($submenu['route-name'])) {{ route($submenu['route-name']) }} 
                                        @elseif(isset($submenu['static-url']))
                                            {{ $submenu['static-url'] }}
                                        @else
                                            {{ url($submenu['route-url']) }} @endif"
                                            class="nav-link ">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>{{ $submenu_key }}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
    </div>
    <!-- /.sidebar -->
  </aside>