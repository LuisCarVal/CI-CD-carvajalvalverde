if [ -z "$1" ]; then
  echo "Por favor, ingrese el n  mero de nodos como parametro (por ejemplo: ./carvajalvalverde-script.sh 5)";
  exit 1
fi

HAPROXY_CFG="/etc/haproxy/haproxy.cfg"
NUM_NODES=$1
BASE_PORT=8000
IMAGE_NAME="carvajalvalverde"


#LIMPIEZA DE CONTENEDORES Y VOLUMENES PREVIOS
docker volume prune --force
docker stop $(docker ps -q)
docker container prune --force

cat << EOF >$HAPROXY_CFG
defaults
  mode http
  timeout client 10s
  timeout connect 5s
  timeout server 10s
  timeout http-request 10s
  log global

frontend stats
  bind *:8999
  stats enable
  stats uri /
  stats refresh 10s

frontend myfrontend
  bind :80
  default_backend webservers

backend webservers
EOF

echo "Creando archivo haproxy.cfg con $NUM_NODES nodos..."ç

docker volume create carvajalvalverde

for i in $(seq 1 $NUM_NODES); do
  PORT=$((BASE_PORT + i - 1))
  CONTAINER_NAME="carvajalvalverde-web$i"

  # Crear y ejecutar contenedor
  docker run -d --name $CONTAINER_NAME \
    -e PORT=$PORT \
    -e CONTAINER_NAME=$CONTAINER_NAME \
    -p $PORT:80 \
    -v carvajalvalverde:/var/www/html/carvajalvalverde \
    $IMAGE_NAME

  echo "  server $CONTAINER_NAME 130.61.90.52:$PORT check" >> $HAPROXY_CFG
  echo "Contenedor $CONTAINER_NAME iniciado en el puerto $PORT."
done
systemctl restart haproxy
