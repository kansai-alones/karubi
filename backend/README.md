## setup
```sh
cp .env.sample .env
composer install
docker-compose build
docker-compose up -d

# DBの初期化
docker-compose exec php sh
## 本番環境
php artisan db:seed
## テスト環境
php artisan db:seed --class=TestSeeder
# toeknが aのユーザが作成される
```

あと`.env`の`DB_DATABASE`と`DB_USERNAME`と`DB_PASSWORD`を修正したり
