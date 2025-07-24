  <li class="nav-item {{ request()->is($path)?'active':''}}">
      <a class="nav-link" href="{{$url}}">
          <i class="fa fa-{{$icon}}"></i>
          <span>{{$title}}</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
