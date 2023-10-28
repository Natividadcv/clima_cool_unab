// servidor.js
const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');
const app = express();
const cors = require('cors');
const axios = require('axios'); // Importa Axios para enviar mensajes de WhatsApp

const port = 3000;

app.use(bodyParser.json());

// Habilita CORS para todas las solicitudes
app.use(cors());

// Configurar el transporte de correo electrónico
const transporter = nodemailer.createTransport({
  host: "smtp.gmail.com",
  port: 465,
  secure: true, // Usa TLS/SSL
  auth: {
    user: "josenatividadcv@gmail.com",
    pass: "wmlz avzz talo vjgq",
  },
});

// Ruta para enviar correos electrónicos y mensajes de WhatsApp
app.post('/enviarCorreoYWhatsapp', async (req, res) => {
  console.log(req.body);
  const { destinatario, asunto, contenido, data, telefono, textoWhatsapp } = req.body;
  const { VENT_SUBTOTAL, VENT_IGV, VENT_TOTAL } = data;
  const textoCorreo = `CLIMA COOL SUB TOTAL: ${VENT_SUBTOTAL}\nIVA: ${VENT_IGV}\nTOTAL: ${VENT_TOTAL}`;

  const mailOptions = {
    from: 'josenatividadcv@gmail.com',
    to: destinatario,
    subject: asunto,
    text: textoCorreo,
  };

  try {
    // Envía el correo electrónico
    await transporter.sendMail(mailOptions);

    // Envía el mensaje de WhatsApp utilizando Axios
    const token = "EAADt93vTWi8BOyKZA0yMZBKM65E6akZAjkIyCR0aXGtx4gw5Wt5qyaOcyGZCBnGrDZC1qtt1ONyzqTSxkRq3A1erWrNz3zlVPXUcVo6padeOR6JT5NvKaf43loFi01ReUfjYyx5LXiMgdfchd2XVL0ZCBF1URk0KS3Lt9lcBDBxTczfldnCnvjwke4q4ZBL09FAw9Fq49TANUK7K5hyofYZD";
    const apiUrl = `https://graph.facebook.com/v17.0/121351617723593/messages`;

    const headers = {
      Authorization: `Bearer ${token}`,
    };

    const payload = {
      messaging_product: "whatsapp",
      recipient_type: "individual",
      to: telefono,
      type: "text",
      text: {
        preview_url: false,
        body: textoCorreo,
      },
    };

    const whatsappResponse = await axios.post(apiUrl, payload, { headers });

    // Envía una respuesta al cliente indicando que ambas acciones se completaron con éxito
    res.json({
      success: true,
      message: 'Correo electrónico y mensaje de WhatsApp enviados con éxito',
      correoResponse: 'Correo electrónico enviado con éxito',
      whatsappResponse: whatsappResponse.data,
    });
  } catch (error) {
    console.error('Error al enviar el correo electrónico o mensaje de WhatsApp:', error);
    res.status(500).json({
      success: false,
      message: 'Error al enviar el correo electrónico o mensaje de WhatsApp',
      error: error.message,
    });
  }
});

app.listen(port, () => {
  console.log(`Servidor Node.js escuchando en el puerto ${port}`);
});
