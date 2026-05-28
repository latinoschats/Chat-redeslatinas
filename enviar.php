<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Si usas Composer
// Si no usas Composer, incluye manualmente los archivos de PHPMailer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.tu-servidor.com'; // Ej: smtp.gmail.com
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tu-correo@ejemplo.com'; // Tu correo
        $mail->Password   = 'tu-contraseña'; // Tu contraseña o App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom('laberinto692@gmail.com', 'Formulario Web');
        $mail->addAddress('https://chatalborada.com/chat.php', 'Administrador');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo registro desde el formulario';
        $mail->Body    = "<strong>Nombre:</strong> $nombre <br>
                          <strong>Email:</strong> $email <br>
                          <strong>Mensaje:</strong> $mensaje";
        $mail->AltBody = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";

        $mail->send();
        echo "✅ Mensaje enviado correctamente.";
    } catch (Exception $e) {
        echo "❌ Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
?>
🔐 Notas importantes
Si usas Gmail, debes generar una contraseña de aplicación en tu cuenta de Google (no uses tu contraseña normal).
Cambia smtp.tu-servidor.com, tu-correo@ejemplo.com y destino@ejemplo.com por tus datos reales.
PHPMailer permite adjuntar archivos, enviar HTML y usar cifrado seguro.
Si quieres, puedo prepararte una versión lista para Gmail con todos los parámetros correctos para que solo tengas que poner tu correo y contraseña de aplicación.
¿Quieres que te la deje lista para Gmail?

