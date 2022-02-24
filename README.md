

docker run --rm -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install

cp .env.example .env

vendor/bin/sail up -d

http://localhost/increment?country=ru
http://localhost/increment?country=us
http://localhost/increment?country=fr

http://localhost/api/getAll