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

    fetch(`https://darkness.ashlynn.workers.dev/chat/`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            prompt: conversationHistory.map(msg => `${msg.role}: ${msg.content}`).join("\n"),
            model: 'mistralai/Mixtral-8x7B-Instruct-v0.1'
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.successful === "success" && data.status === 200) {
            const gptResponse = data.response;
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