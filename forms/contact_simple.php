<?php
// Formulario de contacto simple usando mail() básico de PHP
// No requiere SMTP, funciona directamente con el servidor

// Verificar que sea una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener datos del formulario
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validar datos básicos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => '⚠️ Por favor completa todos los campos requeridos.']);
        exit;
    }
    
    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => '⚠️ Por favor ingresa un email válido.']);
        exit;
    }
    
    // Email de destino
    $to = "vta9351394@gmail.com";
    
    // Asunto del email
    $email_subject = "Nuevo mensaje de contacto: " . $subject;
    
    // Contenido del email
    $email_body = "
    Nuevo mensaje de contacto - Witfolk Enterprise
    
    Nombre: " . $name . "
    Email: " . $email . "
    Asunto: " . $subject . "
    
    Mensaje:
    " . $message . "
    
    ---
    Enviado desde el formulario de contacto de Witfolk Enterprise
    ";
    
    // Headers del email
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Intentar enviar el email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Respuesta de éxito
        echo json_encode([
            'status' => 'success', 
            'message' => '🎉 ¡Gracias! Tu mensaje ha sido enviado exitosamente. Te responderemos dentro de 24 horas.'
        ]);
    } else {
        // Respuesta de error
        echo json_encode([
            'status' => 'error', 
            'message' => '❌ Lo sentimos, hubo un problema al enviar tu mensaje. Por favor intenta de nuevo o contáctanos directamente.'
        ]);
    }
    
} else {
    // Si no es POST, redirigir
    header('Location: ../index.html');
    exit;
}
?>
