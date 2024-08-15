# アプリケーション名
FashionablyLate

## 環境構築
- docker-compose exec php bash
- composer install
- .env.exampleより.env作成。環境変数も変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## 使用技術(実行環境)
- Laravel 8.x
- Github
- Docker
- MySQL
- HTML,CSS
- PHP

## ER図
![スクリーンショット 2024-08-15 154047](https://github.com/user-attachments/assets/f83eb49c-ffed-429c-a0f9-78cb847fcb50)

## URL
- お問い合わせフォーム：http://localhost/
- お問い合わせフォームの確認画面：http://localhost/confirm
- サンクスページ：http://localhost/contacts
- 登録ページ：http://localhost/register
- ログインページ：http://localhost/login
- 管理画面：http://localhost/admin
