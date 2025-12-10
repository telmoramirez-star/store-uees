# Usa una imagen base de NGINX pequeña y estable
FROM nginx:alpine

# Copia tu configuración de servidor personalizada
# Esto reemplazará la configuración predeterminada que incluye conf.d
COPY /deploy/nginx.conf /etc/nginx/conf.d/default.conf

# El punto de entrada por defecto de NGINX es suficiente
CMD ["nginx", "-g", "daemon off;"]