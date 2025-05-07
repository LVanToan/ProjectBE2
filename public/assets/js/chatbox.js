document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 0;
    let userName = '';
    let userPhone = '';
    let supportIssue = '';
    let detailedSupportContent = '';

    // Kiểm tra sự tồn tại của các phần tử DOM
    const chatboxMessages = document.querySelector('.chatbox-messages');
    const inputField = document.querySelector('.chatbox-input');
    const sendButton = document.querySelector('.chatbox-send');
    const resetButton = document.querySelector('.reset-chatbox');
    const chatOptions = document.querySelectorAll('.chat-option');

    if (!chatboxMessages || !inputField || !sendButton || !resetButton || chatOptions.length === 0) {
        console.error('Một hoặc nhiều phần tử DOM cần thiết không tồn tại.');
        return;
    }

    // Sự kiện chọn "Chủ đề support"
    chatOptions.forEach(button => {
        button.addEventListener('click', function () {
            supportIssue = this.getAttribute('data-message');
            addMessage(supportIssue, 'customer-message');

            // Ẩn các nút lựa chọn sau khi nhấn
            chatOptions.forEach(btn => btn.style.display = 'none');
            console.log('Đã ẩn các nút lựa chọn');

            proceedToNextStep();
        });
    });

    // Hàm thêm tin nhắn vào phần chatbox
    function addMessage(text, messageType) {
        const messageElement = document.createElement('p');
        messageElement.textContent = text;
        messageElement.classList.add(messageType);
        chatboxMessages.appendChild(messageElement);
        scrollToBottom(); // Cuộn xuống cuối mỗi khi thêm tin nhắn mới
    }

    // Hàm điều hướng các bước hỏi thông tin khách hàng
    function proceedToNextStep() {
        switch (currentStep) {
            case 0:
                addMessage("Hệ thống: Nội dung chi tiết cần hỗ trợ là gì?", 'system-message');
                inputField.style.display = 'block';
                sendButton.style.display = 'inline';
                inputField.value = '';
                inputField.placeholder = "Nhập chữ và số, không ký tự đặc biệt";
                currentStep++;
                break;
            case 1:
                const detail = inputField.value.trim();
                if (/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/.test(detail)) {
                    detailedSupportContent = detail;
                    addMessage(detailedSupportContent, 'customer-message');
                    addMessage("Hệ thống: Tên của bạn là gì?", 'system-message');
                    inputField.value = '';
                    inputField.placeholder = "Chỉ nhập chữ và dấu tiếng Việt";
                    currentStep++;
                } else {
                    addMessage("Hệ thống: Vui lòng chỉ nhập chữ cái, số và dấu tiếng Việt.", 'system-message');
                }
                break;
            case 2:
                const name = inputField.value.trim();
                if (/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/.test(name)) {
                    userName = name;
                    addMessage(userName, 'customer-message');
                    addMessage("Hệ thống: Số điện thoại của bạn là gì?", 'system-message');
                    inputField.value = '';
                    inputField.placeholder = "Chỉ nhập số, đủ 11 chữ số";
                    currentStep++;
                } else {
                    addMessage("Hệ thống: Vui lòng chỉ nhập chữ cái và dấu tiếng Việt.", 'system-message');
                }
                break;
            case 3:
                const phone = inputField.value.trim();
                if (/^\d{11}$/.test(phone)) {
                    userPhone = phone;
                    addMessage(userPhone, 'customer-message');
                    addMessage("Chờ phản hồi từ nhân viên.", 'system-message');
                    inputField.style.display = 'none';
                    sendButton.style.display = 'none';

                    // Gửi dữ liệu lên server
                    saveChatboxData(userName, userPhone, supportIssue, detailedSupportContent);
                    currentStep = 0;

                    // Bắt đầu polling để nhận tin nhắn từ admin
                    startPolling();
                } else {
                    addMessage("Hệ thống: Số điện thoại phải có đúng 11 chữ số.", 'system-message');
                }
                break;
                    }
                }

    // Hàm lưu dữ liệu vào database
    function saveChatboxData(name, phone, issue, detail) {
        console.log('Dữ liệu gửi đi:', { name, phone, issue, detail });
        fetch('/api/save-chatbox-data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                customer_name: name,
                customer_phone: phone,
                support_issue: issue,
                detailed_support_content: detail
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Dữ liệu đã được lưu thành công');
                } else {
                    console.log('Có lỗi xảy ra khi lưu dữ liệu:', data.error);
                }
            })
            .catch(error => {
                console.error('Lỗi khi gửi dữ liệu:', error);
            });
    }
    function startPolling() {
        setInterval(function () {
            fetch(`/api/get-messages/${userPhone}`)
                .then(response => response.json())
                .then(messages => {
                    // Hiển thị tin nhắn mới
                    chatboxMessages.innerHTML = ''; // Xóa tin nhắn cũ
                    messages.forEach(message => {
                        const messageType = message.sender === 'admin' ? 'admin-message' : 'customer-message';
                        addMessage(message.content, messageType);
                    });
                })
                .catch(error => {
                    console.error('Lỗi khi lấy tin nhắn:', error);
                });
        }, 3000); // Lấy tin nhắn mới mỗi 3 giây
    }

    // Xử lý sự kiện khi nhấn nút gửi
    sendButton.addEventListener('click', function () {
        proceedToNextStep();
    });

    // Xử lý sự kiện khi nhấn nút reset
    resetButton.addEventListener('click', function () {
        chatboxMessages.innerHTML = '<div class="system-message col-6">Xin chào! Tôi có thể giúp gì cho bạn?</div>';
        chatOptions.forEach(btn => btn.style.display = 'block');
        inputField.style.display = 'none';
        sendButton.style.display = 'none';
        currentStep = 0;
        userName = '';
        userPhone = '';
        supportIssue = '';
        detailedSupportContent = '';
    });

    // Hàm cuộn xuống cuối phần tử chứa tin nhắn
    function scrollToBottom() {
        chatboxMessages.scrollTop = chatboxMessages.scrollHeight;
    }
    sendButton.addEventListener('click', function () {
        const message = inputField.value.trim();
        if (message) {
            fetch(`/api/send-message`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    customer_phone: userPhone,
                    sender: 'user',
                    content: message
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addMessage(message, 'customer-message');
                        inputField.value = '';
                    } else {
                        console.error('Có lỗi xảy ra khi gửi tin nhắn:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi gửi tin nhắn:', error);
                });
        }
    });
});