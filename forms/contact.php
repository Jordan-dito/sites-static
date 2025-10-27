<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Aquí pones tu correo real
    $to = "vt9351394@gmail.com";  

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    $body = "Nuevo mensaje de contacto:\n\n";
    $body .= "Nombre: $name\n";
    $body .= "Correo: $email\n";
    $body .= "Asunto: $subject\n";
    $body .= "Mensaje:\n$message\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "✅ Tu mensaje fue enviado con éxito.";
    } else {
        echo "❌ Error al enviar el mensaje. Verifica la configuración de tu servidor.";
    }
}
?>
