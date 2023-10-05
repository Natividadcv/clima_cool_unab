// servidor.js
const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');
const app = express();
const cors = require('cors'); // Importa el paquete cors

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

// Ruta para enviar correos electrónicos
app.post('/enviarCorreo', (req, res) => {
  console.log(req.body);
  console.log('Holaaaaaaaaa ');
  const { destinatario, asunto, contenido, data } = req.body;
  const { VENT_SUBTOTAL, VENT_IGV, VENT_TOTAL } = data;
    const textoCorreo = `SUB TOTAL: ${VENT_SUBTOTAL}\nIVA: ${VENT_IGV}\nTOTAL: ${VENT_TOTAL}`;


  const mailOptions = {
    from: 'josenatividadcv@gmail.com',
    to: destinatario,
    subject: asunto,
    text: textoCorreo, 

  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.error('Error al enviar el correo electrónico: ' + error);
      res.status(500).send('Error al enviar el correo electrónico');
    } else {
      console.log('Correo electrónico enviado: ' + info.response);
      res.send('Correo electrónico enviado con éxito');
    }
  });
});

app.listen(port, () => {
  console.log(`Servidor Node.js escuchando en el puerto ${port}`);
});
