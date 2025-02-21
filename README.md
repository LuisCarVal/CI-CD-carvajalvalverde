# CI-CD-carvajalvalverde

Este es un proyecto en el cual integro:
Integracion continua y despliegue continuo haciendo uso de github actions y de una aplicacion de laravel
donde al hacer un push en el proyecto, se pasan unos test y se despliega al servidor

En el servidor se encuentra el servicio haproxy, y tambien aloja varios contenedores con la misma imagen, que tiene el proyecto de laravel

Pipeline: .github/workflows/carvajalvalverde.yml
Dockerfile: Dockerfile
scripts utilizados en pipeline: carvajalvalverde.sh, carvajañvañverde-parada.sh
