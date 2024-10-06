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
                addMessageToChat('ChatGPT', gptResponse);
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

function addMessageToChat(sender, message) {
    const messagesDiv = document.getElementById('messages');
    const messageElement = document.createElement('div');
    
    if (message.includes('<code>')) {
        const codeContent = message.replace(/<\/?code>/g, '');
        const codeBlock = document.createElement('pre');
        codeBlock.textContent = codeContent;
        
        const copyButton = document.createElement('button');
        copyButton.textContent = 'Kopyala';
        copyButton.onclick = () => copyToClipboard(codeContent);
        messageElement.appendChild(codeBlock);
        messageElement.appendChild(copyButton);
    } else {
        messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    }

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