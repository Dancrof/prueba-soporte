# Sistema de Soporte

## Requisitos
--------------------------
Para ejecutar el sistema necesitas:

  * PHP Version: 8.1+
  * Base de datos: MySQL 8.0.x o MariaDB 10.6.x
  * Servidor Web: Apache / IIS / Nginx
  * Extensiones PHP: Imap, Mbstring, Mcrypt, OpenSSL, PDO, Tokenizer, XML, Zip
  * Extensión del Servidor Web: URLs amigables deben estar habilitadas en la configuración del servidor web

Ejecución con Docker
--------------------------
Para ejecutar el sistema usando Docker, sigue estos pasos:

1. Requisitos previos:
   - Docker instalado
   - Docker Compose instalado
   - Git instalado
   - OpenSSL instalado (para generar certificados SSL)

2. Clonar el repositorio:
```bash
git clone [URL_DEL_REPOSITORIO]
cd [NOMBRE_DEL_DIRECTORIO]
```

3. Configurar el archivo .env:
```bash
cp .env.example .env
```
Edita el archivo .env con las siguientes variables de base de datos:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=[NOMBRE_DE_LA_BASE_DE_DATOS]
DB_USERNAME=[USUARIO]
DB_PASSWORD=[CONTRASEÑA]
```

4. Generar certificados SSL:
```bash
# Dar permisos de ejecución al script
chmod +x docker/nginx/ssl/generate-ssl.sh

# Ejecutar el script para generar certificados
./docker/nginx/ssl/generate-ssl.sh
```

5. Iniciar los contenedores:
```bash
docker-compose up -d
```

6. Instalar dependencias y configurar la aplicación:
```bash
# Instalar dependencias de Composer
docker-compose exec app composer install

# Generar clave de aplicación
docker-compose exec app php artisan key:generate

# Ejecutar migraciones
docker-compose exec app php artisan migrate

# Instalar dependencias de NPM (si es necesario)
docker-compose exec app npm install
docker-compose exec app npm run dev
```

7. Acceder a la aplicación:
La aplicación estará disponible en:
- HTTPS: `https://localhost`
- HTTP: `http://localhost` (redirige automáticamente a HTTPS)

Nota: Como estamos usando certificados autofirmados, el navegador mostrará una advertencia de seguridad. En un entorno de producción, deberías usar certificados válidos de una autoridad certificadora.

Configuración incluida:
- PHP 8.0 con FPM
- Nginx como servidor web con soporte HTTPS
- MySQL 8.0 como base de datos
- Redis para caché
- SSL/TLS configurado con:
  - TLSv1.2 y TLSv1.3
  - Cifrados seguros
  - Redirección automática de HTTP a HTTPS
- Extensiones PHP necesarias:
  - pdo_mysql
  - mbstring
  - exif
  - pcntl
  - bcmath
  - gd
  - zip
  - imagick
- Configuración PHP optimizada:
  - upload_max_filesize=40M
  - post_max_size=40M
  - memory_limit=512M
  - max_execution_time=600
  - max_input_vars=3000

Comandos útiles:
```bash
# Ver logs de los contenedores
docker-compose logs -f

# Detener los contenedores
docker-compose down

# Reiniciar los contenedores
docker-compose restart

# Ejecutar comandos artisan
docker-compose exec app php artisan [comando]

# Regenerar certificados SSL
./docker/nginx/ssl/generate-ssl.sh
```

Configuración de Email con MailHog
--------------------------
Si los puertos SMTP están bloqueados en tu entorno de desarrollo, puedes usar MailHog para pruebas de envío de emails. MailHog es una herramienta de desarrollo que captura los emails enviados por tu aplicación y los muestra en una interfaz web.

### Instalación de MailHog

1. Agregar MailHog al archivo docker-compose.yml:
```yaml
mailhog:
  image: mailhog/mailhog
  ports:
    - "1025:1025" # Servidor SMTP
    - "8025:8025" # Interfaz web
```

2. Configurar el archivo .env para usar MailHog:
```
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=from@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

3. Reiniciar los contenedores:
```bash
docker-compose down
docker-compose up -d
```

### Uso de MailHog

1. Accede a la interfaz web de MailHog en: `http://localhost:8025`
2. Todos los correos electrónicos enviados por tu aplicación serán capturados y mostrados en esta interfaz
3. Puedes ver el contenido de los correos, incluyendo:
   - Destinatarios
   - Asunto
   - Contenido HTML y texto plano
   - Archivos adjuntos
   - Cabeceras del correo

### Ventajas de usar MailHog

- No necesitas configurar un servidor SMTP real
- Los correos no se envían realmente, evitando envíos accidentales
- Interfaz web intuitiva para revisar los correos
- Ideal para desarrollo y pruebas
- No requiere configuración de credenciales SMTP

### Notas importantes

- MailHog es solo para desarrollo y pruebas
- No uses esta configuración en producción
- Los correos capturados se pierden al reiniciar el contenedor
- Asegúrate de que los puertos 1025 y 8025 estén disponibles

### Solución de problemas comunes

1. Si no puedes acceder a la interfaz web:
   - Verifica que el contenedor de MailHog esté corriendo: `docker-compose ps`
   - Comprueba los logs: `docker-compose logs mailhog`
   - Asegúrate de que los puertos no estén siendo usados por otra aplicación

2. Si los correos no aparecen en MailHog:
   - Verifica la configuración en el archivo .env
   - Comprueba que la aplicación esté usando el host y puerto correctos
   - Revisa los logs de la aplicación para errores de envío

3. Para limpiar todos los correos capturados:
   - Reinicia el contenedor de MailHog: `docker-compose restart mailhog`
