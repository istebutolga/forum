const express = require('express');
const bodyParser = require('body-parser');
const axios = require('axios');

const app = express();
app.use(bodyParser.json());

app.post('/set-webhook', async (req, res) => {
    const { apiKey } = req.body;
    const webhookUrl = 'https://your-webhook-url.com'; // Webhook URL'nizi buraya girin

    try {
        const response = await axios.post(`https://api.telegram.org/bot${apiKey}/setWebhook`, {
            url: webhookUrl
        });

        if (response.data.ok) {
            res.json({ success: true });
        } else {
            res.status(500).json({ success: false, message: 'Webhook ayarlanamadı.' });
        }
    } catch (error) {
        res.status(500).json({ success: false, message: 'Hata oluştu.' });
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Sunucu ${PORT} portunda çalışıyor.`);
});