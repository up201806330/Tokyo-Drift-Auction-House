#!/bin/bash

# Stop execution if a step fails
set -e

DOCKER_USERNAME=lbaw21gg   # Replace by your docker hub username
IMAGE_NAME=lbaw21gg-piu

docker build -t $DOCKER_USERNAME/$IMAGE_NAME .
docker push $DOCKER_USERNAME/$IMAGE_NAME
