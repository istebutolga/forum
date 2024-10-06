document.getElementById('send-button').addEventListener('click', sendMessage);

function sendMessage() {
    const userInput = document.getElementById('user-input').value;
    if (userInput.trim() === "") {
        return;
    }

    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    fetch(`https://darkness.ashlynn.workers.dev/chat/?prompt=${encodeURIComponent(userInput)}&model=mistralai/Mixtral-8x7B-Instruct-v0.1`)
        .then(response => response.json())
        .then(data => {
            if (data.successful === "success" && data.status === 200) {
                const gptResponse = data.response;
                addMessageToChat('ChatGPT', processResponse(gptResponse));
            } else {
                console.error('API hatası:', data);
                addMessageToChat('Sistem', 'Üzgünüz, bir hata oluştu. Lütfen tekrar deneyin.');
            }
        })
        .catch(error => {
            console.error('Bağlantı hatası:', error);
            addMessageToChat('Sistem', 'Bağlantı hatası, lütfen internet bağlantınızı kontrol edin.');
        });
}

function processResponse(response) {
    // Basit bir örnekle kod kelimelerini <code> etiketine alalım
    // Burada regex ile 'code', 'function', 'const' gibi anahtar kelimeleri yakalayacağız
    return response.replace(/(code|function|const|let|var|if|else|return|class|import|export|<[^>]*>)/g, match => {
        return `<code>${match}</code> <button class="copy-btn" onclick="copyToClipboard('${match}')">📋</button>`;
    });
}

function addMessageToChat(sender, message) {
    const messagesDiv = document.getElementById('messages');
    const messageElement = document.createElement('div');
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesDiv.appendChild(messageElement);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Kod kopyalandı!');
    }).catch(err => {
        console.error('Kopyalama hatası:', err);
    });
}