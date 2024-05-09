# BUDGET-MAKER

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