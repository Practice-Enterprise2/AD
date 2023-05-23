# Build context: A sort of filesystem where all the files from the directory
# with the Dockerfile are copied to (except when listed in .dockerignore)

#===============#
#= BUILD STAGE =#
#===============#

# FROM: Select the base image
# AS: Give the base image a name so it can be referred to later on
FROM ubuntu:jammy AS build

# ENV: Set environment variables
# Don't let apt-get be silly by asking questions to the void
ENV DEBIAN_FRONTEND noninteractive

# RUN: Run normal shell commands
# Separated for caching
RUN apt-get update
RUN apt-get install -y php8.1
RUN apt-get install -y composer
RUN apt-get install -y php-gd
RUN apt-get install -y php-xml
RUN apt-get install -y php-curl
RUN apt-get install -y curl
RUN apt-get install -y wget
RUN apt-get install -y php8.1-mysql

ENV NODE_VERSION=18.15.0
RUN apt install -y curl

RUN curl -o /root/nvm-install.sh https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh
RUN cat /root/nvm-install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version

# WORKDIR: Create the specified directory if it doesn't exist and set it as the
# current working directory
WORKDIR /bluesky_website/

# COPY: Copy files from the build context into the image
COPY app/ app/
COPY bootstrap/ bootstrap/
COPY config/ config/
COPY database/ database/
COPY public/ public/
COPY resources/ resources/
COPY routes/ routes/
COPY storage/ storage/
COPY tests/ tests/
COPY artisan artisan
COPY composer.json composer.json
COPY composer.lock composer.lock
COPY package-lock.json package-lock.json
COPY package.json package.json
COPY phpunit.xml phpunit.xml
COPY postcss.config.js postcss.config.js
COPY tailwind.config.js tailwind.config.js
COPY vite.config.js vite.config.js

RUN npm ci
RUN composer install
RUN npm run build

# This container is multi use, so no ENTRYPOINT/CMD is defined
