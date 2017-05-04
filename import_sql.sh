#!/usr/bin/env sh

cat dump.sql  |  docker-compose run --rm db mysql -hdb -P3306 -uroot -proot term_project
