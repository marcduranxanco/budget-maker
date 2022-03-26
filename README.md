# NOTAS SOBRE LAS ACTIVIDADES

## Notas actividad 15.2
- Se ha modificado el docker-compose para levantar una base de datos mysql 5.7 para guardar los usuarios. Mapea un volumen de datos en /docker/data. Son necesarios los datos en el .env para iniciarlo.

# Comandos útiles para el proyecto
- Levantar base de datos
  - `docker-compose up --build`
- Levantar proyecto
  - `php -S 127.0.0.1:8000 -t public`