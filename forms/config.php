<?php
// Configuración de email para Witfolk Enterprise
// Actualiza estos valores con tu información

return [
    // Configuración SMTP - AlwaysData
    'smtp' => [
        'host' => 'smtp-ditodevs.alwaysdata.net',  // Servidor SMTP AlwaysData
        'port' => 587,                             // Puerto SMTP (587 para TLS)
        'username' => 'ditodevs@alwaysdata.net',  // Tu email completo
        'password' => 'BARCELONA1925*',               // Tu contraseña de email
        'encryption' => 'tls'                      // Encriptación TLS
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
