## setup
```sh
cp .env.sample .env
composer install
docker-compose build
docker-compose up -d

# DBの初期化
docker-compose exec php sh -c 'cd app && php artisan migrate:fresh'

## 本番環境のデータをいれる
docker-compose exec php sh -c 'cd app && php artisan db:seed'

## テスト環境のデータを入れる
### 本番環境 + toeknが「 a 」のユーザが作成される
docker-compose exec php sh -c 'cd app && php artisan db:seed --class=TestSeeder'
```

あと`.env`の`DB_DATABASE`と`DB_USERNAME`と`DB_PASSWORD`を修正したり
