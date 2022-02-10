<ul>
    @if(auth()->check())
      <li>
        <a class="nav-link scrollto {{ Request::routeIs('customer.index') ? 'active' : '' }}" href="{{route('customer.index')}}">All Customer</a>
      </li>
      <li>
        <a class="nav-link scrollto {{ Request::routeIs('customer.create') ? 'active' : '' }}" href="{{route('customer.create')}}">Customer Create</a>
      </li>
      <li>
        <a class="nav-link scrollto {{ Request::routeIs('customer.trash') ? 'active' : '' }}" href="{{route('customer.trash')}}">Customer Trash</a>
      </li>
      <li class="dropdown">
        <a href="javascript:;">
          <span>{{ Auth::user()->name }}</span> 
          <i class="bi bi-chevron-down"></i>
        </a>
        <ul>
          <li><a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             {{ __('Logout') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form></li>
        </ul>
      </li>
    @else
      <li>
          <a class="nav-link scrollto active" href="{{ route('login') }}">Login</a>
        </li>
      <li>
        <a class="nav-link scrollto" href="{{ route('register') }}">Register</a>
      </li>
    @endif
      
  </ul>