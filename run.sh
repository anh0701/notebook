#!/bin/sh

podman-compose up -d;

php spark serve;
