#!/bin/bash

UID_VAR="{{ UID_VALUE }}"
UID_VALUE=$(id -u)
if [ $(id -u) -eq 0 ]; then
    echo "please run docker as your user, current user $USER"
    exit 1
fi

GID_VAR="{{ GID_VALUE }}"
GID_VALUE=$(id -g)
if [ $(id -g) -eq 0 ]; then
    echo "please run docker as your user, current user $USER"
    exit 1
fi

if [ ! -f "./.env" ]; then
  cp ./.env.dist ./.env
    echo "
UID_VALUE=${UID_VALUE}
USER_NAME=$(id -un)
GID_VALUE=${GID_VALUE}
GROUP_NAME=$(id -gn)" >>./.env
fi

docker-compose up -d --build
echo "done"
