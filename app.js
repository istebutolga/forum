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

    // Yeni proxy kullanarak API isteği
    const proxyUrl = 'https://thingproxy.freeboard.io/fetch/';
    const apiUrl = `https://chatgpt.ashlynn.workers.dev/gptweb/?question=${encodeURIComponent(userInput)}`;

    console.log("API isteği gönderiliyor: " + proxyUrl + apiUrl);

    fetch(proxyUrl + apiUrl, {
        method: 'GET',
        mode: 'cors' // CORS sorunlarını çözmek için
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
            const gptResponse = data.gpt; // API yanıtında "gpt" alanından cevap geliyor
            addMessageToChat('ChatGPT', gptResponse);
        } else {
            console.error('API yanıt hatası:', data);
            addMessageToChat('Sistem', 'Üzgünüz, bir hata oluştu. Lütfen tekrar deneyin.');
        }
    })
    .catch(error => {
        console.error('Bağlantı veya işleme hatası:', error);
        addMessageToChat('Sistem', `Bağlantı hatası, lütfen internet bağlantınızı kontrol edin. Hata: ${error.message}`);
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