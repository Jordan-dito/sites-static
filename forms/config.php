<?php
// Configuración de email para Witfolk Enterprise
// Actualiza estos valores con tu información

return [
    // Configuración SMTP - GoDaddy
    'smtp' => [
        'host' => 'smtpout.secureserver.net',     // Servidor SMTP GoDaddy
        'port' => 465,                            // Puerto SSL (465 para SSL)
        'username' => 'oney.bedoya@witfolk.com',  // Tu email completo de GoDaddy
        'password' => 'Test123456**',          // Tu contraseña de email
        'encryption' => 'ssl'                     // Encriptación SSL
    ],
    
    // Emails de destino
    'emails' => [
        'contact' => 'oney.bedoya@witfolk.com',  // Email principal de contacto
        'admin' => 'oney.bedoya@witfolk.com'      // Email administrativo
    ],
    
    // Configuración de la empresa
    'company' => [
        'name' => 'Witfolk Enterprise',
        'website' => 'https://witfolk.com',
        'phone' => '+57 320 856 2746'
    ]
];
?>
