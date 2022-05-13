<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('Backend/dist/img/SJ_logo-white_preview.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MD. Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('homes.index') }}" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item" class="{{ (request()->is('service*')) ? 'active' : '' }}">
            <a href="{{ route('service.index') }}" class="nav-link">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>Service</p>
            </a>
          </li>
          <li class="nav-item" class="{{ (request()->is('work*')) ? 'active' : '' }}">
            <a href="{{ route('work.index') }}" class="nav-link">
              <i class="fas fa-briefcase nav-icon"></i>
              <p>Our Work</p>
            </a>
          </li>
          <li class="nav-item" class="{{ (request()->is('team*')) ? 'active' : '' }}">
            <a href="{{ route('team.index') }}" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Team Members</p>
            </a>
          </li>
          <li class="nav-item" class="{{ (request()->is('contact*')) ? 'active' : '' }}">
            <a href="{{ route('contact.index') }}" class="nav-link">
              <i class="fas fa-address-card nav-icon"></i>
              <p>Contact</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
