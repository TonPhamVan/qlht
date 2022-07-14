<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images\logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Quản Lý Hiệu Thuốc</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images\avatar4.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{-- {{ Auth::user()->name }} --}}
            tôn
        </a>
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

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="fa-solid fa-house-chimney nav-icon"></i>
                  <p>
                    Trang Chủ
                  </p>
                </a>
              </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-users nav-icon"></i>
              <p>
                Quản Lý Tài Khoản
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách tài khoản</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="fa-solid fa-circle-plus nav-icon"></i>
                  <p>Thêm tài khoản</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-capsules nav-icon"></i>
              <p>
                Quản Lý Thuốc
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('drug_groups.index')}}" class="nav-link">
                 <i class="fa-solid fa-list nav-icon"></i>
                  <p>Nhóm Thuốc</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('drug_groups.add')}}" class="nav-link">
                    <i class="fa-solid fa-circle-plus nav-icon"></i>
                  <p>Thêm nhóm thuốc</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('drugs.index')}}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách thuốc</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('drugs.add')}}" class="nav-link">
                    <i class="fa-solid fa-circle-plus nav-icon"></i>
                  <p>Thêm thuốc</p>
                </a>
              </li>
            </ul>
          </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-hand-holding-medical nav-icon"></i>
                  <p>
                    Quản Lý Nhập-Bán
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="pages/tables/simple.html" class="nav-link">
                        <i class="fa-solid fa-circle-arrow-down nav-icon"></i>
                      <p>Nhập Thuốc</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/tables/data.html" class="nav-link">
                        <i class="fa-solid fa-list nav-icon"></i>
                      <p>Danh sách hóa đơn nhập</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/tables/jsgrid.html" class="nav-link">
                        <i class="fa-solid fa-circle-arrow-up nav-icon"></i>
                      <p>Bán thuốc</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="pages/tables/jsgrid.html" class="nav-link">
                        <i class="fa-solid fa-list nav-icon"></i>
                      <p>Danh sách hóa đơn bán</p>
                    </a>
                  </li>
                </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-users-between-lines nav-icon"></i>
              <p>
                Quản Lý Khách Hàng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('customers.index')}}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách khách hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('customers.add')}}" class="nav-link">
                    <i class="fa-solid fa-circle-plus nav-icon"></i>
                  <p>Thêm khách hàng</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-users-line nav-icon"></i>
              <p>
                Quản Lý Nhà Cung Cấp
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách nhà cung cấp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="fa-solid fa-circle-plus nav-icon"></i>
                  <p>Thêm nhà cung cấp</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Báo Cáo Thống Kê
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách khách hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách nhà cung cấp</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách thuốc</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách hóa đơn nhập</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                  <p>Danh sách hóa đơn bán</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
