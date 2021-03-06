Two-Factor Authentication
-------------------------

* **Actualización 04/2015:** Por cambios recientes en el protocolo, la conexión con WhatsApp ha dejado de funcionar hasta la próxima actualización de la librería [WhatsAPI](https://github.com/venomous0x/WhatsAPI) (si es que esto sucede).

Implementación de un proceso de Login seguro mediante autenticación de doble factor vía **WhatsApp** para la cátedra _Comunicación de Redes Seguras (2060)_ de la Facultad de Ingeniería -- Universidad de Mendoza.

### Librerías y archivos de configuración

* **[WhatsAPI](https://github.com/venomous0x/WhatsAPI)**  
./application/config/whatsapp.php:  
`$username = '';` Número de teléfono con código de país sin '+' o '00'  
`$identity = '';` Obtenido durante la registración utilizando esta API, [WART](https://github.com/shirioko/WART) o _sniffeada_ del teléfono utilizando [MissVenom](https://github.com/shirioko/MissVenom)  
`$nickname = '';` Nombre de usuario frente a otros usuarios de WhatsApp  
`$password = '';` Idem $identity

* **[HOTP-PHP](https://github.com/Jakobo/hotp-php)**   
./application/config/hotp.php:  
`$secret_key = '';`  Valor semilla

* **[reCAPTCHA PHP Lib](https://code.google.com/p/recaptcha/downloads/list?q=label:phplib-Latest)**  
./application/config/captcha.php:  
`$publickey  = '';` Clave pública generada al registrarse para utilizar la API de [ReCAPTCHA](https://www.google.com/recaptcha)  
`$privatekey = '';` Clave privada

### Enlace a la aplicación

https://twofactor.pablovalentini.com.ar/
