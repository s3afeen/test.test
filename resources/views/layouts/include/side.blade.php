<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <!-- <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="profile">
                  <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">Zaid</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li> -->
            <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon "></i>
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('products.index') }}">
                <span class="menu-title">Product </span>
                <i class="mdi mdi-cart menu-icon "></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('orders.index') }}">
                <span class="menu-title">Order </span>
                <i class="mdi mdi-airplane-takeoff menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="menu-title">User </span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('reports.index') }}">
                <span class="menu-title">Basic Reports</span>
                <i class="mdi mdi-chart-areaspline menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts.showAll') }}">
                    <span class="menu-title">Contacts</span>
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('categories.index') }}">
                <span class="menu-title">Category </span>
                <i class="mdi mdi-format-align-justify menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('settings.index') }}">
                <span class="menu-title">General Settings</span>
                <i class="mdi mdi-brightness-5 menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
