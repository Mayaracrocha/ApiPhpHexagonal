FROM phpdockerio/php80-fpm:latest
WORKDIR "/application"

ENV TZ="America/Maceio"
ENV XDEBUG_MODE="coverage,debug"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Fix expired certificate
RUN apt-get update && apt-get install ca-certificates

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y install wget unzip php8.0-mysql php8.0-sqlite3 php8.0-pgsql php8.0-redis php8.0-bcmath php8.0-gd php8.0-mongodb php8.0-xdebug php8.0-intl \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Node.js
RUN apt-get update \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && npm install apidoc@0.28.1 -g \
    && npm install yarn -g \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install wkhtmltopdf
RUN apt-get update \
    && apt-get install -y wget build-essential libgl1-mesa-dev libxrender1 \
    && wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz \
    && tar xvfJ wkhtmltox-0.12.4_linux-generic-amd64.tar.xz \
    && chown root:root wkhtmltox/bin/wkhtmltopdf \
    && cp wkhtmltox/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install locales
RUN echo 'deb http://cz.archive.ubuntu.com/ubuntu focal main' >> /etc/apt/sources.list \
    && apt-get update \
    && apt-get install -y locales \
    && locale-gen pt_BR.UTF-8 \
    && update-locale LANG=pt_BR.UTF-8 \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Dockerize is needed to sync containers startup
ENV DOCKERIZE_VERSION v0.6.0
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN chmod 777 -R /var/log
