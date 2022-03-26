# NOTAS SOBRE LAS ACTIVIDADES

## Notas actividad 15.2
- Se ha modificado el docker-compose para levantar una base de datos mysql 5.7 para guardar los usuarios. Mapea un volumen de datos en /docker/data. Son necesarios los datos en el .env para iniciarlo.
- Método para inicializar la seguridad del proyecto:
  - `php bin/console make:user`
  - `php bin/console make:auth`

### Comandos necesarios para levantar esta actividad
```
docker-compose up --build

```

# Comandos útiles para el proyecto
- Levantar base de datos
  - `docker-compose up --build`
- Levantar proyecto
  - `php -S 127.0.0.1:8000 -t public`