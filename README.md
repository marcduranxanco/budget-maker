# NOTAS SOBRE LAS ACTIVIDADES

## Notas sobre la actividad
Se puede ver el diagrama de la base de datos en [este dbdiagram.io](https://dbdiagram.io/embed/6244bb98bed61838732bd776)

## Enunciado actividad 16.1
- Al mandar una solicitud:
  - Se enviará un correo al usuario con la misma información: características de la(s) aplicación(es), presupuesto aproximado y texto que deje claro que es un presupuesto orientativo.
  - Se enviará otro correo a todos los usuarios con rol "comercial" indicando los datos de contacto del solicitante, las características de la(s) aplicación(es) y el presupuesto orientativo.
- Al aprobar una solicitud de presupuesto:
  - Se mandarán correos al solicitante:
    - En el correo al solicitante se indicarán las características de la solicitud y el presupuesto final en vez del presupuesto inicial. También se añadirá en el correo un enlace. (Ver sección: panel del solicitante)
  - Se mandará correo a los jefes de proyecto.
    - En el correo a los jefes de proyecto se indicarán las características de la solicitud con el presupuesto final y la fecha de entrega.
- Al cambiar de estado el proyecto:
  - Se mandará correo al solicitante 
  - A los técnicos asociados al proyecto informando en el correo del nuevo estado del proyecto.
- Al asignar un técnico a una tarea:
  - Se enviará un correo al técnico con la información de la tarea asignada.
- Al marcar una tarea como terminada:
  - Se enviará un correo a los jefes de proyecto.

Nota:
- Los correos sí deben ser traducibles.
- Al solicitante se le enviará el correo en el idioma en el que hizo la solicitud.
- Al resto de usuarios se le enviarán los correos en el idioma que tenga configurado cada receptor del correo en su perfil.
- Es posible que en este punto sea necesario diseñar previamente la parte de roles de usuario, definir los atributos de varias entidades y empezar a realizar traducciones. Para la corrección, solamente es necesario enviar los servicios, el resto de elementos se corregirán al enviar la práctica final completa.


# Comandos útiles para el proyecto
### Comando para levantar la infraestructura
```
# Ejecuta el contenedor con la base de datos
docker-compose up --build -d && sleep 5 && \
bin/console doctrine:migrations:migrate && \
bin/console doctrine:schema:update --force && \
bin/console doctrine:fixtures:load --no-interaction && \
./node_modules/.bin/encore dev
```

### Detalle 
- Levantar base de datos
  - `docker-compose up --build`
- Levantar proyecto
  - `php -S 127.0.0.1:8000 -t public`
- Ejecución de tests
  - `./vendor/bin/simple-phpunit`
- Compilar assets y re-compilarlos automáticamente cuando cambian los archivos
  - `npm run watch`