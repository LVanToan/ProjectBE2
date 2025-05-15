@extends('viewAdmin.navigation')
@section('title', 'Revenue Management')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/revenue_manager.css') }}">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Quản lý Doanh Thu</h6>
                        <div class="row mt-2 px-3">
                            <div class="col-md-4">
                                <label class="form-label">Từ ngày</label>
                                <div class="input-group input-group-outline">
                                    <label class="form-label"></label>
                                    <input type="date" class="form-control" id="start-date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Đến ngày</label>
                                <div class="input-group input-group-outline">
                                    <label class="form-label"></label>
                                    <input type="date" class="form-control" id="end-date">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-white filter-btn">Lọc</button>
                                <button class="btn btn-white export-btn">Xuất Excel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="revenue-summary">
                        <div class="row mx-3 mb-3">
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tổng doanh thu
                                                    </p>
                                                    <h5 class="font-weight-bolder mb-0 text-success total-revenue">
                                                        {{ number_format($totalRevenue, 0, ',', '.') }} ₫
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape icon-gradient-success shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Số đơn hàng</p>
                                                    <h5 class="font-weight-bolder mb-0 total-orders">
                                                        {{ $totalOrders }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng thành
                                                        công</p>
                                                    <h5 class="font-weight-bolder mb-0 text-success successful-orders">
                                                        {{$successfulOrders}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng hủy
                                                    </p>
                                                    <h5 class="font-weight-bolder mb-0 text-danger canceled-orders">
                                                        {{$canceledOrders}}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                                    <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã đơn
                                        hàng</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Khách hàng</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày đặt
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số điện
                                        thoại
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tổng
                                        tiền</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phương
                                        thức</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng
                                        thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">#{{ $order->id }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->first_name ?? 'N/A' }}</p>
                                            <p class="text-xs text-secondary mb-0">{{ $order->last_name ?? 'N/A' }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $order->created_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $order->phone ?? 0 }}</span>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <span
                                                class="text-success text-xs font-weight-bold">{{ number_format($order->total, 0, ',', '.') }}
                                                ₫</span>
                                        </td>
                                        <td class="align-middle">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{ $order->payment_method ?? 'N/A' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            @if ($order->status === 'delivered')
                                                <span class="badge badge-sm bg-gradient-success">Thành công</span>
                                            @elseif ($order->status === 'processing')
                                                <span class="badge badge-sm bg-gradient-warning">Đang xử lý</span>
                                            @elseif ($order->status === 'canceled')
                                                <span class="badge badge-sm bg-gradient-danger">Đã hủy</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Không xác định</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/js/revenue_manager.js') }}"></script>