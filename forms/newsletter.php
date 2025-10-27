<?php
// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require_once '../vendor/autoload.php';

// Verificar que sea una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener email del formulario
    $email = trim($_POST['email']);
    
    // Validar email
    if (empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'El email es obligatorio.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'El email no es válido.']);
        exit;
    }
    
    // Cargar configuración
    $config = require_once 'config.php';
    
    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP - AlwaysData
        $mail->isSMTP();
        $mail->Host = $config['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp']['username'];
        $mail->Password = $config['smtp']['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $config['smtp']['port'];
        
        // Configuración de caracteres
        $mail->CharSet = 'UTF-8';
        
        // Remitente y destinatario
        $mail->setFrom($config['smtp']['username'], $config['company']['name']);
        $mail->addAddress($config['emails']['contact'], $config['company']['name']);
        
        // Configuración del email
        $mail->isHTML(true);
        $mail->Subject = 'Nueva Suscripción al Newsletter - ' . $config['company']['name'];
        
        // Contenido del email
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #dc3545; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; background-color: #f8f9fa; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #dc3545; }
                .email { background-color: white; padding: 15px; border-left: 4px solid #dc3545; font-size: 18px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>📧 Nueva Suscripción al Newsletter</h2>
                    <p>" . $config['company']['name'] . "</p>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>Email suscrito:</span>
                        <div class='email'>" . htmlspecialchars($email) . "</div>
                    </div>
                    <div class='field'>
                        <span class='label'>Fecha:</span> " . date('d/m/Y H:i:s') . "
                    </div>
                    <div class='field'>
                        <span class='label'>IP:</span> " . $_SERVER['REMOTE_ADDR'] . "
                    </div>
                </div>
            </div>
        </body>
        </html>";
        
        // Versión en texto plano
        $mail->AltBody = "
        Nueva Suscripción al Newsletter - " . $config['company']['name'] . "
        
        Email suscrito: " . $email . "
        Fecha: " . date('d/m/Y H:i:s') . "
        IP: " . $_SERVER['REMOTE_ADDR'] . "
        ";
        
        // Enviar email
        $mail->send();
        
        // Respuesta de éxito
        echo json_encode([
            'status' => 'success', 
            'message' => '¡Te has suscrito exitosamente! Gracias por tu interés.'
        ]);
        
    } catch (Exception $e) {
        // Respuesta de error
        echo json_encode([
            'status' => 'error', 
            'message' => 'Error al procesar la suscripción: ' . $mail->ErrorInfo
        ]);
    }
    
} else {
    // Si no es POST, redirigir
    header('Location: ../index.html');
    exit;
}
?>
