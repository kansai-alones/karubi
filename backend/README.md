## setup
```sh
cp .env.sample .env
composer install
docker-compose build
docker-compose up -d
```

あと`.env`の`DB_DATABASE`と`DB_USERNAME`と`DB_PASSWORD`を修正したり
