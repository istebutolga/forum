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
    // ``` ile belirtilmiş kod bloklarını tespit etme
    const codeBlockRegex = /```([\s\S]*?)```/g;
    let formattedResponse = response.replace(codeBlockRegex, (match, code) => {
        // Kod bloğunu <pre><code> ile sar ve yanına kopyalama butonu ekle
        return `<pre><code>${code.trim()}</code></pre><button class="copy-btn" onclick="copyToClipboard(\`${code.trim()}\`)">📋</button>`;
    });

    return formattedResponse;
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