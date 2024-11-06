const express = require('express');
const { WAConnection, MessageType } = require('@adiwajshing/baileys');
const fs = require('fs');

const app = express();
app.use(express.json());

// Conecta ao WhatsApp usando Baileys
async function connectToWhatsApp() {
    const conn = new WAConnection();

    // Carrega as credenciais se elas existirem
    if (fs.existsSync('./auth_info.json')) {
        conn.loadAuthInfo('./auth_info.json');
    }

    conn.on('open', () => {
        console.log('Conectado ao WhatsApp');
        const authInfo = conn.base64EncodedAuthInfo();
        fs.writeFileSync('./auth_info.json', JSON.stringify(authInfo, null, '\t'));
    });

    await conn.connect();
    return conn;
}

// Endpoint para enviar mensagem
app.post('/send-message', async (req, res) => {
    const { to, message } = req.body;

    if (!to || !message) {
        return res.status(400).json({ status: 'error', message: 'Número de telefone e mensagem são obrigatórios' });
    }

    try {
        const conn = await connectToWhatsApp();
        await conn.sendMessage(`${to}@s.whatsapp.net`, message, MessageType.text);
        console.log(`Mensagem enviada para ${to}`);
        await conn.close();

        res.json({ status: 'success', message: 'Mensagem enviada com sucesso!' });
    } catch (error) {
        console.error("Erro ao enviar mensagem:", error);
        res.status(500).json({ status: 'error', message: 'Erro ao enviar mensagem' });
    }
});

// Inicia o servidor na porta 3000
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Servidor rodando na porta ${PORT}`);
});
