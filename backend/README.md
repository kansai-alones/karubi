## setup
```sh
cp .env.sample .env
composer install
docker-compose build
docker-compose up -d

# DBの初期化
dc exec php sh -c 'cd app && php artisan migrate:fresh'

## 本番環境のデータをいれる
dc exec php sh -c 'cd app && php artisan db:seed'

## テスト環境のデータを入れる
## toeknが aのユーザが作成される 
dc exec php sh -c 'cd app && php artisan db:seed --class=TestSeeder'
```

あと`.env`の`DB_DATABASE`と`DB_USERNAME`と`DB_PASSWORD`を修正したり
