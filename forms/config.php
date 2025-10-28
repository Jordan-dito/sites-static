<?php
// Configuración de email para Witfolk Enterprise
// Actualiza estos valores con tu información

return [
    // Configuración SMTP - GoDaddy (Puerto 25)
    'smtp' => [
        'host' => 'smtpout.secureserver.net',     // Servidor SMTP GoDaddy
        'port' => 25,                             // Puerto 25 (sin encriptación)
        'username' => 'pruebaValentina@witfolk.com',  // Tu email completo de GoDaddy
        'password' => 'Barcelona2025*',          // Tu contraseña de email
        'encryption' => 'none'                    // Sin encriptación
    ],
    
    // Emails de destino
    'emails' => [
        'contact' => 'vta9351394@gmail.com',  // Email principal de contacto
        'admin' => 'vta9351394@gmail.com'      // Email administrativo
    ],
    
    // Configuración de la empresa
    'company' => [
        'name' => 'Witfolk Enterprise',
        'website' => 'https://witfolk.com',
        'phone' => '+57 320 856 2746'
    ]
];
?>
