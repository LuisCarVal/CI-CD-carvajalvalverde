#!/bin/bash

if [ -z "$1" ]; then
  echo "Uso: $0 <número_de_nodos>"
  exit 1
fi

NUM_NODES=$1

for i in $(seq 1 $NUM_NODES); do
  CONTAINER_NAME="carvajalvalverde-web$i"
  echo "Deteniendo el contenedor $CONTAINER_NAME..."
  docker stop $CONTAINER_NAME 2>/dev/null
  docker rm $CONTAINER_NAME 2>/dev/null
done

# Limpiar recursos innecesarios
docker container prune -f
docker volume prune -f

# Reiniciar HAProxy para aplicar cambios
systemctl restart haproxy

echo "Se han detenido y eliminado $NUM_NODES nodos."
