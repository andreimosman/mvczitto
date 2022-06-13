#!/bin/sh

OS_TYPE="$(uname -s)"
DOCKER="$(which docker)"
DOCKER_COMPOSE="$DOCKER compose"

$DOCKER_COMPOSE build
$DOCKER_COMPOSE up -d

$DOCKER exec mvczitto-app /bin/bash -c "cd /mvczitto && composer dump-autoload && composer install"

