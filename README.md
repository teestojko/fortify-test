# fortify-test

・Laravel８（旧教材）
・フリマ用遷移入り
・メール認証なし

### 環境構築

1. プロジェクトをクローン
```bash
git clone git@github.com:teestojko/fortify-test.git
```

2. プロジェクトへ移動
```bash
cd fortify-test
```

3. Dockerのビルド＆起動
```bash
docker compose up -d --build
```

4. PHPコンテナへログイン
```bash
docker compose exec php bash
```

5. 必要なパッケージのインストール
```bash
composer install
```

6. .env作成
```bash
cp .env.example .env
```

7. 作成された.envのDB接続を変更
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

```bash
php artisan key:generate
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```
