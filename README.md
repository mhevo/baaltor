## About Baaltor

Baaltor translates you locale Item to another language.

## Dump Database

docker-compose exec mysql /usr/bin/mysqldump -uroot -ppassword baaltor > ../baaltor.sql

## Deploy

Copy everything to ../deploy
move public/* to /
ignore public/build/manifest.json

change .env file
remove if from .htaccess
