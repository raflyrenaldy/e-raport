<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">St</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Main Menu</li>
      <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa fa-columns"></i> <span>Dashboard</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.class.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.class.index') }}"><i class="fa fa-columns"></i> <span>Class Room</span></a></li>
      <li class="{{ Request::route()->getName() == 'admin.student.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('admin.student.index') }}"><i class="fa fa-users"></i> <span>Student</span></a></li>
    </ul>
</aside>
