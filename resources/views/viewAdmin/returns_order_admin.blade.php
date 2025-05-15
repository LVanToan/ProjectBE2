@extends('viewAdmin.navigation')
@section('title', 'Order Manager')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Returns Orders manager</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="Diao px-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm px-3 me-2"
                        style="border-radius: 5px; font-size: 14px;">
                        <i class="fas fa-eye"></i> Quay lại
                    </a>
                </div>
                
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã KH</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã đơn</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sản phẩm</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lý do</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mô tả</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SĐT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($returnsOrders as $order)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->user_id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->orders_id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->product->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::limit($order->return_reason, 15) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::limit($order->detailed_description, 20) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->created_at->format('d/m/Y') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $order->phone }}</p>
                                    </td>
                                    <td>
                                        @if($order->status == 'Đã gửi sản phẩm')
                                            <span class="badge badge-sm bg-gradient-warning">{{ $order->status }}</span>
                                        @elseif($order->status == 'Đã xử lý xong')
                                            <span class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-info">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if ($order->status === 'Đã gửi sản phẩm')
                                            <a href="#" class="btn btn-primary btn-sm btn-received" data-id="{{ $order->orders_id }}">Đã nhận</a>
                                        @elseif ($order->status !== 'Đã xử lý xong')
                                           <a href="#" class="btn btn-primary btn-view-detail" data-id="{{ $order->id }}">Xem</a>
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