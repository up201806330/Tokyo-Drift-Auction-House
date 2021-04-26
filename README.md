# LBAW's PIU

## Introduction

This README describes how to set up the development environment for the Prototype of User Interfaces (PIU).
It was prepared to run on Linux, but it should be reasonably easy to follow and adapt to other operating systems.

* [Installing Docker](#installing-docker)
* [Publishing the image](#publishing-your-image)
* [Developing with Docker](#developing-with-docker)

A `Dockerfile` is provided to generate the Docker image. The image provides an HTTP server with PHP enabled, served from the `/var/www/html/` folder. At this stage, you can only use PHP to include other files and prevent repeating HTML code.

__Later we will have more on Docker containers...__


## Installing Docker

Before starting, you'll need to have __Docker__ installed on your PC.

Docker is a tool that allows you to run containers (similar to virtual machines, but much lighter).
The official instructions are in [Install Docker](https://docs.docker.com/install/).

    # install docker-ce
    sudo apt-get update
    sudo apt-get install apt-transport-https ca-certificates curl gnupg-agent software-properties-common
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
    sudo apt-get update
    sudo apt-get install docker-ce # docker-ce-cli containerd.io
    docker run hello-world # make sure that the installation worked


## Publishing your image

You should keep your git's master branch always functional and frequently build and deploy your code.
To do so, you will create a _docker_ image for your project and publish it at [docker hub](https://hub.docker.com/).
LBAW's production machine will frequently pull all these images and make them available at http://lbaw21gg-piu.lbaw-prod.fe.up.pt/.

This demo repository is available at [http://piu21.lbaw-prod.fe.up.pt/](http://piu21.lbaw-prod.fe.up.pt/).
Please make sure you are inside FEUP's network or VPN to access it.

The first thing you need to do is create a [docker hub](https://hub.docker.com/) account and get your username from it.
Once you have a username, let your docker know who you are by executing:

    docker login

Once your docker can communicate with the docker hub using your credentials, configure the `upload_image.sh` script with your username and group's identification as well.
Example configuration:

    DOCKER_USERNAME=lbaw2174  # Replace by your docker hub username
    IMAGE_NAME=lbaw2174-piu   # Replace by your lbaw group name

Afterward, you can build and upload the docker image by executing that script from the project root:

    ./upload_image.sh

If you are running under Windows, then manually execute the instruction inside the script. Note that your HTML source code should be inside the `html` folder, or you need to adjust the `Dockerfile`.
You can test the locally by running:

    docker run -it -p 8000:80 <DOCKER_USERNAME>/<IMAGE NAME>

The above command exposes your HTML on http://localhost:8000.

There should be only one image per group. One team member should create and push the image to the public repository at Docker Hub (lbaw21gg). The group can share the login credentials so that any team member can push the image.
You should provide your teacher with the details for accessing your docker image, namely, docker username and repository (lbaw21gg/lbaw21gg-piu).


## Developing with Docker

To use a Docker container to serve HTML files from your __html/__ folder, run your image and mount the folder (specify the local full path or $PWD) as a volume:


    docker run -it -p 8080:80 -v $PWD/html:/var/www/html lbaw2174/lbaw2174-piu


The above command exposes your HTML on http://localhost:8000 for you to test changes. You need to provide the full path for the `html` folder for it to be mounted in the container.
Any changes made inside the local folder can be seen immediately.


## Clean up all your docker images and containers

    docker kill $(docker ps -q)     # kill all running containers
    docker rm $(docker ps -a -q)    # delete all stopped containers
    docker rmi $(docker images -q)  # delete all images




# PostgreSQL with Docker

## Introduction

This README describes how to initiate the setup the development environment for LBAW 2020/21.
These instructions address the development with a local environment, i.e. on the machine (that can be a VM) without using a Docker container for PHP.
Containers are used for PostgreSQL and pgAdmin, though.

The template was prepared to run on Linux 20.04LTS, but it should be fairly easy to follow and adapt for other operating systems.

* [Installing Docker and Docker Compose](#installing-docker-and-docker-compose)
* [Working with PostgreSQL](#working-with-postgresql)

## Installing Docker and Docker Compose

Firstly, you'll need to have __Docker__ and __Docker Compose__ installed on your PC.
The official instructions are in [Install Docker](https://docs.docker.com/install/) and in [Install Docker Compose](https://docs.docker.com/compose/install/#install-compose).
It resumes to executing the commands:

    # install docker-ce
    sudo apt-get update
    sudo apt-get install apt-transport-https ca-certificates curl software-properties-common
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
    sudo apt-get update
    sudo apt-get install docker-ce
    docker run hello-world # make sure that the installation worked

    # optionally, add your user to the docker group by using a terminal to run:
    # sudo usermod -aG docker $USER
    # Sign out and back in again so this setting takes effect.

    # install docker-compose
    sudo curl -L "https://github.com/docker/compose/releases/download/1.28.5/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    docker-compose --version # verify that you have Docker Compose installed.



## Working with PostgreSQL

We've created a _docker-compose_ file that sets up __PostgreSQL13__ and __pgAdmin4__ to run as local Docker containers.

From the project root issue the following command:

    docker-compose up

This will start the database and the pgAdmin4 tool images as two independent docker containers.

[//]: # (The database's username is _postgres_ and the password is _pg!lol!2021_.)

You can hit http://localhost:5050 to access __pgAdmin4__ and manage your database.
Use the following credentials to login:

    Email: postgres
    Password: pg!lol!2021

In the first usage of the development database, you will need to add a new Server using the following attributes<sup>1</sup>:

    hostname: postgres
    username: postgres
    password: pg!lol!2021

<sup>1</sup>Hostname is _postgres_ instead of _localhost_ since _Docker composer_ creates an internal DNS entry to facilitate the connection between linked containers.
