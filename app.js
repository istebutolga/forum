document.getElementById('send-button').addEventListener('click', sendMessage);

function sendMessage() {
    const userInput = document.getElementById('user-input').value;
    if (userInput.trim() === "") {
        return;
    }

    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    fetch(`https://chatgpt.ashlynn.workers.dev/?question=${encodeURIComponent(userInput)}`)
        .then(response => response.json())
        .then(data => {
            const gptResponse = data.gpt;
            addMessageToChat('ChatGPT', gptResponse);
        })
        .catch(error => console.error('Error:', error));
}

function addMessageToChat(sender, message) {
    const messagesDiv = document.getElementById('messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add(sender === 'ChatGPT' && isCodeBlock(message) ? 'code-block' : '');
    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
    if (sender === 'ChatGPT' && isCodeBlock(message)) {
        const copyButton = document.createElement('button');
        copyButton.classList.add('copy-button');
        copyButton.textContent = 'Kopyala';
        copyButton.onclick = () => {
            navigator.clipboard.writeText(message);
            alert('Kod kopyalandı!');
        };
        messageElement.appendChild(copyButton);
    }
    messagesDiv.appendChild(messageElement);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

function isCodeBlock(text) {
    return /```/.test(text);
}