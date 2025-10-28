<?php
// Importar PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoloader de Composer
require_once '../vendor/autoload.php';

// Verificar que sea una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener datos del formulario
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validar datos básicos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => '⚠️ Please complete all required fields to continue.']);
        exit;
    }
    
    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => '⚠️ Please enter a valid email address.']);
        exit;
    }
    
    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Cargar configuración
        $config = require_once 'config.php';
        
        // Configuración del servidor SMTP - GoDaddy (Puerto 25)
        $mail->isSMTP();
        $mail->Host = $config['smtp']['host'];  // smtpout.secureserver.net
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp']['username'];  // pruebaValentina@witfolk.com
        $mail->Password = $config['smtp']['password'];  // Tu contraseña
        $mail->SMTPSecure = false;  // Sin encriptación para puerto 25
        $mail->Port = $config['smtp']['port'];  // 25
        
        // Configuraciones adicionales para GoDaddy
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPDebug = 2; // Debug activado temporalmente
        $mail->Timeout = 30; // Timeout de 30 segundos
        
        // Configuración de caracteres
        $mail->CharSet = 'UTF-8';
        
        // Remitente y destinatario
        $mail->setFrom($email, $name);
        $mail->addAddress($config['emails']['contact'], $config['company']['name']); // Email de destino
        
        // Configuración del email
        $mail->isHTML(true);
        $mail->Subject = 'New contact message: ' . $subject;
        
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
                .message { background-color: white; padding: 15px; border-left: 4px solid #dc3545; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Contact Message</h2>
                    <p>Witfolk Enterprise</p>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>Name:</span> " . htmlspecialchars($name) . "
                    </div>
                    <div class='field'>
                        <span class='label'>Email:</span> " . htmlspecialchars($email) . "
                    </div>
                    <div class='field'>
                        <span class='label'>Subject:</span> " . htmlspecialchars($subject) . "
                    </div>
                    <div class='field'>
                        <span class='label'>Message:</span>
                        <div class='message'>" . nl2br(htmlspecialchars($message)) . "</div>
                    </div>
                </div>
            </div>
        </body>
        </html>";
        
        // Versión en texto plano
        $mail->AltBody = "
        New contact message - Witfolk Enterprise
        
        Name: " . $name . "
        Email: " . $email . "
        Subject: " . $subject . "
        
        Message:
        " . $message . "
        ";
        
        // Enviar email
        $mail->send();
        
        // Respuesta de éxito
        echo json_encode([
            'status' => 'success', 
            'message' => '🎉 Thank you! Your message has been sent successfully. We will get back to you within 24 hours.'
        ]);
        
    } catch (Exception $e) {
        // Respuesta de error con detalles del debug
        echo json_encode([
            'status' => 'error', 
            'message' => '❌ Error: ' . $mail->ErrorInfo . ' | Exception: ' . $e->getMessage()
        ]);
    }
    
} else {
    // Si no es POST, redirigir
    header('Location: ../index.html');
    exit;
}
?>

