const chatboxId = 1; // ID của chatbox
const adminId = 1; // ID của admin

// Lắng nghe tin nhắn mới từ user
window.Echo.private(`chatbox.${chatboxId}`)
    .listen("MessageSent", (e) => {
        console.log("New message from user:", e.message);

        // Hiển thị tin nhắn mới trong giao diện
        addMessage(e.message.message, 'received');
    });

// Gửi tin nhắn từ admin
document.querySelector('.btn-send').addEventListener('click', function () {
    const inputField = document.querySelector('.message-input');
    const message = inputField.value.trim();

    if (message) {
        sendMessage(chatboxId, adminId, "admin", message);
        addMessage(message, 'sent'); // Hiển thị tin nhắn trong giao diện
        inputField.value = ''; // Xóa nội dung input
    }
});

// Hàm thêm tin nhắn vào giao diện
function addMessage(text, messageType) {
    const chatMessages = document.querySelector('.chat-messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', messageType);

    const messageContent = `
        <div class="message-content">
            <div class="message-text">${text}</div>
            <div class="message-time">${new Date().toLocaleTimeString()}</div>
        </div>
    `;
    messageElement.innerHTML = messageContent;
    chatMessages.appendChild(messageElement);

    // Cuộn xuống cuối
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Hàm gửi tin nhắn qua API
function sendMessage(chatboxId, senderId, senderType, message) {
    fetch('/messages/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            chatbox_id: chatboxId,
            sender_id: senderId,
            sender_type: senderType,
            message: message,
        }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Message sent successfully:", data.message);
            }
        })
        .catch(error => {
            console.error("Error sending message:", error);
        });
}
window.Echo.private(`chatbox.${chatboxId}`)
    .listen("MessageSent", (e) => {
        addMessage(e.message.message, 'received'); // Hiển thị tin nhắn từ user
    });
document.querySelector('.btn-send').addEventListener('click', function () {
    console.log("Button 'Gửi' đã được nhấn!"); // Log để kiểm tra sự kiện

    const inputField = document.querySelector('.message-input');
    const message = inputField.value.trim();

    if (message) {
        console.log("Nội dung tin nhắn:", message); // Log nội dung tin nhắn
        sendMessage(chatboxId, adminId, "admin", message);
        addMessage(message, 'sent'); // Hiển thị tin nhắn trong giao diện admin
        inputField.value = ''; // Xóa nội dung input
    } else {
        console.log("Không có nội dung tin nhắn để gửi."); // Log nếu không có nội dung
    }
});