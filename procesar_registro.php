<?php
// Mostrar errores en desarrollo (quitar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Validar que el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar entradas
    $nombre   = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $email    = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['telefono'] ?? ''));
    $mensaje  = htmlspecialchars(trim($_POST['mensaje'] ?? ''));

    // Validación básica
    if (!$nombre || !$email) {
        die("Error: Nombre y correo electrónico son obligatorios.");
    }

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP segura
        $mail->isSMTP();
        $mail->Host       = 'pyasowe@gmail.com'; // Cambia por tu servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'usuario@tuservidor.com'; // Tu usuario SMTP
        $mail->Password   = 'tu_password_segura';     // Tu contraseña SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom('usuario@tuservidor.com', 'Registro Web');
        $mail->addAddress('destino@correo.com', 'Administrador');

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo registro desde la web';
        $mail->Body    = "
            <h3>Datos del registro</h3>
            <p><b>Nombre:</b> {$nombre}</p>
            <p><b>Email:</b> {$email}</p>
            <p><b>Teléfono:</b> {$telefono}</p>
            <p><b>Mensaje:</b> {$mensaje}</p>
        ";
        $mail->AltBody = "Nombre: {$nombre}\nEmail: {$email}\nTeléfono: {$telefono}\nMensaje: {$mensaje}";

        $mail->send();
        echo "Registro enviado correctamente.";
    } catch (Exception $e) {
        echo "Error al enviar el registro: {$mail->ErrorInfo}";
    }
} else {
    echo "Acceso no permitido.";
}
