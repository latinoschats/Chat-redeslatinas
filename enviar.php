<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $destinatario = "tucorreo@ejemplo.com"; // Cambia por tu email
    $asunto = "Nuevo registro desde el formulario";
    $contenido = "Nombre: $nombre\nEmail: $email\nMensaje:\n$mensaje";
    $cabeceras = "From: $email\r\nReply-To: $email\r\n";

    if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
        echo "✅ Mensaje enviado correctamente.";
    } else {
        echo "❌ Error al enviar el mensaje.";
    }
}
?>
