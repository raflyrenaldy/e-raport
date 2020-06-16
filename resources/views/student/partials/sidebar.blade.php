<aside id="sidebar-wrapper">
  <div class="sidebar-brand">
    <a href="{{ route('student.dashboard') }}">{{ env('APP_NAME') }}</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="{{ route('student.dashboard') }}">Ap</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Main Menu</li>
      <li class="{{ Request::route()->getName() == 'student.dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('student.dashboard') }}"><i class="fa fa-columns"></i>
              <span>Dashboard</span>
    </ul>
</aside>
