<?php 
session_start();

$correo = filter_var(trim($_POST['profe']), FILTER_SANITIZE_EMAIL);
$destinatario = filter_var(trim($_POST['destinatario']), FILTER_SANITIZE_EMAIL);
$asunto = htmlspecialchars(trim($_POST['asunto']));
$mensaje = htmlspecialchars(trim($_POST['mensaje']));

$cuerpo = '
    <html> 
        <head> 
            <title>Correo de prueba</title> 
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    color: #333;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border-radius: 5px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                }
                h1 {
                    color: #0056b3;
                }
                p {
                    font-size: 16px;
                    line-height: 1.6;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #777;
                    text-align: center;
                }
            </style>
        </head>
        <body> 
            <div class="container">
                <h1>Solicitud de contacto desde el correo del profesor</h1>
                <p> 
                    <strong>Contacto:</strong> ' . $correo . '<br>
                    <strong>Asunto:</strong> ' . $asunto . '<br><br>
                    <strong>Mensaje:</strong><br>
                    ' . nl2br($mensaje) . ' 
                </p> 
                <div class="footer">
                    <p>Este correo es una respuesta automática. Por favor, no responda a este mensaje.</p>
                </div>
            </div>
        </body>
    </html>
';

// Para el envio en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF8\r\n";
$headers .= "FROM: $correo\r\n";

if (mail($destinatario, $asunto, $cuerpo, $headers)) {
    header("Location: https://nukatech.cl/citt/usuario/reportes/enviar_correo.php?status=success");
} else {
    header("Location: https://nukatech.cl/citt/usuario/reportes/enviar_correo.php?status=error");
}
?>
