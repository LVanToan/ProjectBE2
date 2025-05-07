@extends('viewAdmin.navigation') @section('title', 'Chat Support')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/chatbox_detail.css') }}">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Chatbox Support</h6>
                    </div>
                </div>
                <div class="row p-3">
                    <!-- Thanh tìm kiếm -->
                </div>
                <div class="chat-container">
                    <!-- Header cuộc trò chuyện -->
                    <div class="chat-header">
                        <div class="customer-info">
                            <div class="customer-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name ?? 'KH') }}&background=random"
                                    alt="Avatar" />
                            </div>
                            <div class="customer-details">
                                <h3>{{ $chatboxData->customer_name ?? 'Khách hàng' }}</h3>
                                <p class="status online">Đang trực tuyến</p>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="btn-action" title="Tìm kiếm">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn-action" title="Thông tin">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Khung hiển thị tin nhắn -->
                    <div class="chat-messages">
                        <!-- Ngày hiện tại -->
                        <div class="message-date">
                            <span>Hôm nay</span>
                        </div>

                        <!-- Tin nhắn khách hàng -->
                        <div class="message received">
                            <div class="message-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name ?? 'KH') }}&background=random"
                                    alt="Avatar" />
                            </div>
                            <div class="message-content">
                                <div class="message-text">
                                    Xin chào admin, tôi cần hỗ trợ về sản phẩm ABC
                                </div>
                                <div class="message-time">10:30 AM</div>
                            </div>
                        </div>

                        <!-- Tin nhắn admin -->
                        <div class="message sent">
                            <div class="message-content">
                                <div class="message-text">
                                    Chào bạn, tôi có thể giúp gì cho bạn về sản phẩm ABC?
                                </div>
                                <div class="message-time">
                                    10:32 AM <i class="fas fa-check-double seen"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tin nhắn khách hàng -->
                        <div class="message received">
                            <div class="message-avatar">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name ?? 'KH') }}&background=random"
                                    alt="Avatar" />
                            </div>
                            <div class="message-content">
                                <div class="message-text">
                                    Tôi muốn biết thông tin bảo hành của sản phẩm này
                                </div>
                                <div class="message-time">10:33 AM</div>
                            </div>
                        </div>

                        <!-- Tin nhắn admin -->
                        <div class="message sent">
                            <div class="message-content">
                                <div class="message-text">
                                    Sản phẩm ABC có thời gian bảo hành 24 tháng từ ngày mua. Bạn
                                    cần mang hóa đơn đến trung tâm bảo hành gần nhất khi có vấn
                                    đề.
                                </div>
                                <div class="message-time">
                                    10:35 AM <i class="fas fa-check-double"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Khung nhập tin nhắn -->
                    <div class="chat-input">
                        <button class="btn-attach" title="Đính kèm">
                            <i class="fas fa-paperclip"></i>
                        </button>
                        <input type="text" placeholder="Nhập tin nhắn..." class="message-input" />
                        <button class="btn-send" title="Gửi">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection