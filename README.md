# NOTAS SOBRE LAS ACTIVIDADES

## Notas actividad 15.2
- Se ha modificado el docker-compose para levantar una base de datos mysql 5.7 para guardar los usuarios. Mapea un volumen de datos en /docker/data. Son necesarios los datos en el .env para iniciarlo.
- Método utilizado para inicializar la seguridad del proyecto:
  - `php bin/console make:user`
  - `php bin/console make:auth`
- En relación a los tests:
  - Se ha creado solamente un test unitario para `App\Event\PresupuestoSolicitadoEvent;`. No he sabido hacer tests unitarios sobre los controladores.
  - 

### Comandos necesarios para levantar esta actividad

```
# Ejecutar contenedor con la base de datos 
docker-compose up --build
```
```
# Inicializar los datos de la base de datos
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```
```
# Ejecutar el build de los estilos y Js de la aplicación
./node_modules/.bin/encore dev
```
```
# Ejecución de tests
./vendor/bin/simple-phpunit
```

# Comandos útiles para el proyecto
- Levantar base de datos
  - `docker-compose up --build`
- Levantar proyecto
  - `php -S 127.0.0.1:8000 -t public`