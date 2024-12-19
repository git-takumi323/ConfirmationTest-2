# ConfirmationTest-2

## 環境構築
- Dockerのビルドからマイグレーション、シーディングまでを記述する
- docker-compose up -d --build
- docker-compose exec php bash
- composer create-project "laravel/laravel=8.*" . --prefer-dist
- php artisan make:migration create_products_table
- php artisan make:migration create_seasons_table
- php artisan make:migration create_product_season_table
- php artisan migrate
- php artisan make:seeder ProductsTableSeeder
- php artisan make:seeder SeasonsTableSeeder
- php artisan make:seeder ProductSeasonTableSeeder
- php artisan db:seed

## 使用技術(実行環境)
- 例) Laravel 8.x(言語やフレームワーク、バージョンなどが記載されていると良い)

## ER図
< ![index drawio](https://github.com/user-attachments/assets/f723f3ae-2d99-400c-ae34-96b3fe55330a)
>

## URL
- 例) 開発環境：http://localhost/
