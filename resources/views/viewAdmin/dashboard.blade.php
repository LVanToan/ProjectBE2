@extends('viewAdmin.navigation')
@section('title', 'Dashboard')
@section('content')
  <link rel="stylesheet" href="{{ asset('assets/css/dashnoard_admin.css') }}">


  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <h6 class="font-weight-bolder mb-0">Dashboard</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      <div class="input-group input-group-outline">
        <label class="form-label">Type here...</label>
        <input type="text" class="form-control">
      </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
      <li class="mt-2">
        <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard"
        data-icon="octicon-star" data-size="large" data-show-count="true"
        aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
      </li>
      <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
          <i class="sidenav-toggler-line"></i>
          <i class="sidenav-toggler-line"></i>
          <i class="sidenav-toggler-line"></i>
        </div>
        </a>
      </li>
      <li class="nav-item px-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0">
        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
        </a>
      </li>
      <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa fa-bell cursor-pointer"></i>
        </a>
        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
        <li class="mb-2">
          <a class="dropdown-item border-radius-md" href="javascript:;">
          <div class="d-flex py-1">
            <div class="my-auto">
            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
            </div>
            <div class="d-flex flex-column justify-content-center">
            <h6 class="text-sm font-weight-normal mb-1">
              <span class="font-weight-bold">New message</span> from Laur
            </h6>
            <p class="text-xs text-secondary mb-0">
              <i class="fa fa-clock me-1"></i>
              13 minutes ago
            </p>
            </div>
          </div>
          </a>
        </li>
        <li class="mb-2">
          <a class="dropdown-item border-radius-md" href="javascript:;">
          <div class="d-flex py-1">
            <div class="my-auto">
            <img src="https://demos.creative-tim.com/material-dashboard/assets/img/small-logos/logo-spotify.svg"
              class="avatar avatar-sm bg-gradient-dark  me-3 ">
            </div>
            <div class="d-flex flex-column justify-content-center">
            <h6 class="text-sm font-weight-normal mb-1">
              <span class="font-weight-bold">New album</span> by Travis Scott
            </h6>
            <p class="text-xs text-secondary mb-0">
              <i class="fa fa-clock me-1"></i>
              1 day
            </p>
            </div>
          </div>
          </a>
        </li>
        <li>
          <a class="dropdown-item border-radius-md" href="javascript:;">
          <div class="d-flex py-1">
            <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink">
              <title>credit-card</title>
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <g transform="translate(1716.000000, 291.000000)">
                <g transform="translate(453.000000, 454.000000)">
                  <path class="color-background"
                  d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                  opacity="0.593633743"></path>
                  <path class="color-background"
                  d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                  </path>
                </g>
                </g>
              </g>
              </g>
            </svg>
            </div>
            <div class="d-flex flex-column justify-content-center">
            <h6 class="text-sm font-weight-normal mb-1">
              Payment successfully completed
            </h6>
            <p class="text-xs text-secondary mb-0">
              <i class="fa fa-clock me-1"></i>
              2 days
            </p>
            </div>
          </div>
          </a>
        </li>
        </ul>
      </li>
      <li class="nav-item d-flex align-items-center">
        <a href="sign-in.html" class="nav-link text-body font-weight-bold px-0">
        <i class="fa fa-user me-sm-1"></i>
        <span class="d-sm-inline d-none">Sign In</span>
        </a>
      </li>
      </ul>
    </div>
    </div>
  </nav>

  <div class="main-content">

    <!-- Stats Cards -->
    <div class="card-container">
    <div class="card">
      <div class="card-body">
      <div class="stat-card">
        <div class="stat-icon primary">
        <i class="fas fa-dollar-sign fa-2x"></i>
        </div>
        <div class="stat-text">
        <h2 class="mb-0">{{ number_format($totalRevenue) }} VND</h2>
        <p>Tổng Doanh Thu</p>
        </div>
      </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
      <div class="stat-card">
        <div class="stat-icon success">
        <i class="fas fa-calendar fa-2x"></i>
        </div>
        <div class="stat-text">
        <h2 class="mb-0">{{ number_format($totalRevenueThisMonth) }} </h2>
        <p>Doanh Thu Tháng</p>
        </div>
      </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
      <div class="stat-card">
        <div class="stat-icon warning">
        <i class="fas fa-users fa-2x"></i>
        </div>
        <div class="stat-text">
        <h2 class="mb-0">{{ number_format($totalUsers) }}</h2>
        <p>Tổng User</p>
        </div>
      </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
      <div class="stat-card">
        <div class="stat-icon danger">
        <i class="fas fa-boxes fa-2x"></i>
        </div>
        <div class="stat-text">
        <h2 class="mb-0">{{ number_format($totalProducts) }}</h2>
        <p>Tổng Sản Phẩm</p>
        </div>
      </div>
      </div>
    </div>
    </div>

    <!-- Charts -->
    <div class="chart-container">
    <div class="chart-header">
      <h4>Doanh Thu Trong Ngày</h4>
      <div>
      <span class="text-muted">Cập nhật vào lúc 24:00 hàng ngày</span>
      </div>
    </div>
    <div
      style="height: 300px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; padding: 20px">
      <canvas id="revenueChart"></canvas>
    </div>
    </div>

    <!-- Recent Orders -->
    <div class="recent-orders">
    <div class="chart-header">
      <h4>Top User</h4>
      <div>
      <span class="text-muted">Cập nhật 4 phút trước</span>
      </div>
    </div>

    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Tên User</th>
        <th>Email</th>
        <th>Số lượng đơn hàng</th>
        <th>Tổng chi tiêu</th>
      </tr>
      </thead>
      <tbody>
      @if(is_array($topUsers) || $topUsers instanceof Countable)
      @if(count($topUsers) > 0)
      @foreach($topUsers as $user)
      <tr>
      <td>{{ $user['id'] }}</td>
      <td>{{ $user['name'] }}</td>
      <td>{{ $user['email'] }}</td>
      <td>{{ $user['order_count'] }}</td>
      <td>{{ number_format($user['total_value']) }} VND</td>
      </tr>
      @endforeach
      @else
      <tr>
      <td colspan="5" style="text-align: center;">Không có dữ liệu</td>
      </tr>
      @endif
    @else
      <tr>
      <td colspan="5" style="text-align: center;">Dữ liệu không hợp lệ</td>
      </tr>
    @endif
      </tbody>
    </table>
    </div>

    <!-- Footer -->
    <div class="footer">
    <p>© 2025 Admin Dashboard made by Trần Bảo Chiêu for a better web.</p>
    </div>
  </div>
  <script>
    const revenueByDay = @json($revenueByDay); // Dữ liệu từ controller
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('assets/js/dashboard_admin.js') }}"></script>
@endsection