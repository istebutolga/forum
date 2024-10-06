document.getElementById('send-button').addEventListener('click', sendMessage);
document.getElementById('user-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
});

// Görüntü yükleme işlemi
document.getElementById('image-upload').addEventListener('change', handleImageUpload);

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('image', file);

        // Görüntü analizi için API'ye istek gönder
        fetch('https://your-image-analysis-api.com/analyze', { // Buraya görüntü analiz API'nizi yazın
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            const analysisResult = data.result; // API'den gelen analiz sonuçları
            addMessageToChat('ChatGPT', analysisResult);
        })
        .catch(error => {
            console.error('Görüntü yükleme hatası:', error);
            addMessageToChat('Sistem', `Görüntü yükleme hatası: ${error.message}`);
        });
    }
}

function sendMessage() {
    const userInput = document.getElementById('user-input').value.trim();
    if (userInput === "") {
        return;
    }

    addMessageToChat('Kullanıcı', userInput);
    document.getElementById('user-input').value = '';

    const proxyUrl = 'https://api.allorigins.win/get?url=';
    const apiUrl = `https://chatgpt.ashlynn.workers.dev/gptweb/?question=${encodeURIComponent(userInput)}&lang=tr`;

    console.log("API isteği gönderiliyor: " + proxyUrl + apiUrl);

    fetch(proxyUrl + encodeURIComponent(apiUrl), {
        method: 'GET',
        mode: 'cors'
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
        const jsonResponse = JSON.parse(data.contents);
        if (jsonResponse.status === true && jsonResponse.code === 200) {
            const gptResponse = jsonResponse.gpt; // API yanıtında "gpt" alanından cevap geliyor
            
            // Kod bloğu algılama
            if (userInput.toLowerCase().includes("bana bu kodu yaz") || userInput.toLowerCase().includes("yaz")) {
                addMessageToChat('ChatGPT', `<pre><code>${gptResponse}</code></pre><button onclick="copyToClipboard(\`${gptResponse}\`)">Kopyala</button>`);
            } else {
                addMessageToChat('ChatGPT', gptResponse);
            }
        } else {
            console.error('API yanıt hatası:', jsonResponse);
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

// Kopyalama fonksiyonu
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => {
            alert('Kod kopyalandı!');
        })
        .catch(err => {
            console.error('Kopyalama hatası:', err);
        });
}