#!/bin/bash

# Crear directorio si no existe
mkdir -p /etc/nginx/ssl

# Generar certificado autofirmado
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/nginx/ssl/faveo.key \
    -out /etc/nginx/ssl/faveo.crt \
    -subj "/C=ES/ST=State/L=City/O=Organization/CN=localhost"

# Ajustar permisos
chmod 644 /etc/nginx/ssl/faveo.crt
chmod 600 /etc/nginx/ssl/faveo.key 