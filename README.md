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

## import new data

Use Ladiks Casc Viewer

Open storage C:\Program Files(x86)\Diablo II Resurrected\

Extract: data/data/local/Ing/strings/

Remove BOM with Notepad++ from .json Files

Copy files to /data/todo

Open localhost:80/importtranslations and refresh until all files are imported. Local import limit is one file per call.
