# 📧 Configuración AlwaysData - Witfolk Enterprise

## 🎯 **Sistema Configurado para AlwaysData**

Tu sistema de correos está configurado **exclusivamente** para usar tu servidor **AlwaysData**. Aquí está todo lo que necesitas saber:

## 📋 **Datos de tu Servidor AlwaysData:**

### **Servidores de Correo:**
- **SMTP (Envío):** `smtp-ditodevs.alwaysdata.net`
- **IMAP (Recepción):** `imap-ditodevs.alwaysdata.net`
- **POP (Recepción):** `pop-ditodevs.alwaysdata.net`

### **Puertos Disponibles:**
- **SMTP TLS:** Puerto 587 ✅ (Configurado)
- **SMTP SSL:** Puerto 465 (Alternativo)
- **IMAP:** Puerto 143
- **IMAP SSL:** Puerto 993
- **POP:** Puerto 110
- **POP SSL:** Puerto 995

## ⚙️ **Configuración Actual:**

### **Archivo `forms/config.php` actualizado:**
```php
'smtp' => [
    'host' => 'smtp-ditodevs.alwaysdata.net',
    'port' => 587,
    'username' => 'tu-email@ditodevs.alwaysdata.net',
    'password' => 'tu-password',
    'encryption' => 'tls'
],
```

## 🔧 **Lo que DEBES hacer ahora:**

### **1. Actualizar tus credenciales:**
En `forms/config.php`, cambia estas líneas:
```php
'username' => 'tu-email-real@ditodevs.alwaysdata.net',  // Tu email completo
'password' => 'tu-contraseña-real',                      // Tu contraseña real
```

### **2. Verificar tu email de destino:**
```php
'emails' => [
    'contact' => 'oney.bedoya@witfolk.com',  // Confirma que sea correcto
    'admin' => 'oney.bedoya@witfolk.com'
],
```

## 🚀 **Ventajas de AlwaysData:**

### **✅ Profesional:**
- Servidor de correo empresarial
- Mayor confiabilidad que Gmail
- Mejor reputación para envío masivo

### **✅ Seguro:**
- Encriptación TLS/SSL incluida
- Autenticación SMTP robusta
- Sin límites de envío como Gmail

### **✅ Configuración Simple:**
- No necesitas contraseñas de aplicación
- Usa tu contraseña normal de email
- Configuración directa

## 🔍 **Archivos Modificados:**

### **1. `forms/config.php`**
- ✅ Host cambiado a AlwaysData
- ✅ Puerto 587 configurado
- ✅ Encriptación TLS activada

### **2. `forms/contact_phpmailer.php`**
- ✅ Carga configuración automáticamente
- ✅ Usa datos de AlwaysData
- ✅ Configuración dinámica

### **3. `forms/config_alwaysdata.php` (Nuevo)**
- ✅ Configuración completa con todas las opciones
- ✅ Información de todos los puertos
- ✅ Configuración alternativa SSL

## 🧪 **Cómo Probar:**

### **1. Actualiza las credenciales:**
```php
'username' => 'tu-email@ditodevs.alwaysdata.net',
'password' => 'tu-contraseña-real',
```

### **2. Envía un email de prueba:**
- Ve a tu sitio web
- Llena el formulario de contacto
- Verifica que llegue el email

### **3. Si hay problemas:**
- Verifica que el email y contraseña sean correctos
- Confirma que AlwaysData tenga SMTP habilitado
- Revisa los logs de error del servidor

## 🔧 **Configuración Alternativa SSL:**

Si el puerto 587 no funciona, puedes usar SSL:
```php
'port' => 465,
'encryption' => 'ssl'
```

## 📞 **Soporte:**

Si tienes problemas:
1. **Verifica credenciales** en AlwaysData
2. **Confirma configuración SMTP** en tu panel de AlwaysData
3. **Contacta soporte AlwaysData** si es necesario

---
*Configuración completada para AlwaysData - Witfolk Enterprise*
