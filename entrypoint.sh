#!/bin/bash

OLD_UID=$(id -u application)
OLD_GID=$(id -g application)

NEW_UID=$(ls -nd composer.json | awk '{print $3}')
NEW_GID=$(ls -nd composer.json | awk '{print $4}')

if [ "$OLD_UID" != "$NEW_UID" ]
then
    echo "[entrypoint] change uid of 'application' user ($NEW_UID)"
    usermod -u "$NEW_UID" application
fi

if [ "$OLD_GID" != "$NEW_GID" ]
then
    echo "[entrypoint] change gid of 'application' user ($NEW_GID)"
    groupmod -g "$NEW_GID" application
fi

su application -c "cd $(pwd) && /app/bootstrap.sh"
