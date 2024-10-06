document.getElementById('send-button').addEventListener('click', sendMessage);

function sendMessage() {
    const userInput = document.getElementById('user-input').value;
    if (userInput.trim() === "") {
        return;
    }

    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    fetch(`https://lord-apis.ashlynn.workers.dev/?question=${encodeURIComponent(userInput)}&mode=Llama`)
        .then(response => response.json())
        .then(data => {
            if (data.status && data.code === 200) {
                const gptResponse = data.message;
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
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    messagesDiv.appendChild(messageElement);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}