document.getElementById('send-button').addEventListener('click', sendMessage);
document.getElementById('user-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

let conversationHistory = [];

function sendMessage() {
    const userInput = document.getElementById('user-input').value.trim();
    if (userInput === "") {
        return;
    }

    conversationHistory.push({ role: 'user', content: userInput });
    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    console.log("API isteği gönderiliyor...");

    fetch(`https://evil.darkhacker7301.workers.dev/?question=${encodeURIComponent(userInput)}`, {
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
            const gptResponse = data.gpt;
            conversationHistory.push({ role: 'assistant', content: gptResponse });
            addMessageToChat('ChatGPT', processResponse(gptResponse));
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

function processResponse(response) {
    const codeBlockRegex = /```(python|javascript|html|css|java|c\+\+|c#)?\n([\s\S]*?)```/g;
    return response.replace(codeBlockRegex, (match, lang, code) => {
        return `<pre><code class="${lang}">${code.trim()}</code></pre><button class="copy-btn" onclick="copyToClipboard(\`${code.trim()}\`)">📋</button>`;
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

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Kod kopyalandı!');
    }).catch(err => {
        console.error('Kopyalama hatası:', err);
    });
}