document.getElementById('send-button').addEventListener('click', sendMessage);
document.getElementById('user-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

function sendMessage() {
    const userInput = document.getElementById('user-input').value.trim();
    if (userInput === "") {
        return;
    }

    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    const apiUrl = `https://lord-apis.ashlynn.workers.dev/?question=${encodeURIComponent(userInput)}&mode=Gemini`;

    console.log("API isteği gönderiliyor: " + apiUrl);

    fetch(apiUrl, {
        method: 'GET',
    })
    .then(response => {
        console.log(`HTTP Yanıt Kodu: ${response.status}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('API yanıtı alındı:', data);
        if (data.status === true && data.code === 200) {
            const gptResponse = data.message;
            addMessageToChat('ChatGPT', gptResponse);
        } else {
            console.error('API yanıt hatası:', data);
            addMessageToChat('Sistem', 'Üzgünüz, bir hata oluştu. Lütfen tekrar deneyin.');
        }
    })
    .catch(error => {
        console.error('Bağlantı veya işleme hatası:', error);
        addMessageToChat('Sistem', 'Bağlantı hatası, lütfen internet bağlantınızı kontrol edin.');
    });
}

function addMessageToChat(sender, message) {
    const messagesDiv = document.getElementById('messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add(sender === 'Kullanıcı' ? 'user-message' : 'gpt-message');
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesDiv.appendChild(messageElement);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}