## サイト URL

以下の URL から、実際に動作するサイトをご覧いただけます。

-   **URL:** http://18.182.42.38

## テスト用ログイン情報

サイトの全機能をお試しいただけるように、3 つの役割に応じたテストアカウントを用意しています。ご自由にお使いください。

### 1. 購入ユーザー (User)

商品の閲覧、カート機能、Stripe によるテスト決済、購入後のメール通知などをお試しいただけます。

-   **メールアドレス:** `test@test.com`
-   **パスワード:** `password123`

### 2. 店舗オーナー (Owner)

自身がオーナーである店舗の商品管理（登録・編集・削除）、在庫管理などを行えます。

-   /owner/login
-   **メールアドレス:** `test1@test.com`
-   **パスワード:** `password123`

### 3. 管理者 (Admin)

店舗オーナーの登録・編集・削除など、サイト全体の管理者機能をお試しいただけます。

-   /admin/login
-   **メールアドレス:** `test@test.com`
-   **パスワード:** `password123`

## ローカルでの開発環境構築手順

#### 1. プロジェクトのクローン

以下のコマンドで、このリポジトリをあなたの PC にクローンします。

```bash
git clone [https://github.com/keito-106/laravel_umarche.git](https://github.com/keito-106/laravel_umarche.git)
```

#### 2. プロジェクトディレクトリへの移動

```bash
cd laravel_umarche
```

#### 3. 依存関係のインストール

```bash
composer install
npm install
```

#### 4. フロントエンドアセットのビルド

```bash
npm run dev
```

#### 5. 環境設定ファイルの準備

`.env.example`ファイルをコピーして、`.env`ファイルを作成します。

```bash
cp .env.example .env
```

作成した`.env`ファイルを開き、あなたのローカル開発環境に合わせて、以下の項目を修正してください。

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_umarche
DB_USERNAME=umarche
DB_PASSWORD=password123
```

#### 6. アプリケーションキーの生成

```bash
php artisan key:generate
```

#### 7. データベースの構築

XAMPP や MAMP などの開発環境でデータベースサーバーを起動した後、以下のコマンドを実行してください。
これにより、データベースにテーブルが作成され、初期データが投入されます。

```bash
php artisan migrate:fresh --seed
```

#### 8. 画像ファイルの配置

このプロジェクトで使用する画像ファイルは、Git の管理対象外になっています。
`php artisan storage:link`コマンドで`public/storage`へのシンボリックリンクを作成した後、ダミーの画像ファイルを以下のディレクトリに配置してください。

-   商品画像: `storage/app/public/products/`
-   ショップ画像: `storage/app/public/shops/`

#### 9. 開発サーバーの起動

全ての準備が整いました。以下のコマンドで簡易サーバーを立ち上げ、ブラウザで動作確認してください。

```bash
php artisan serve
```

---

## 補足事項

### 決済機能（Stripe）について

決済のテストとして Stripe を使用しています。決済機能を試す場合は、`.env`ファイルにあなた自身の Stripe テスト用 API キーを追記してください。

### メール送信（Mailtrap）とキューについて

メール送信のテストとして Mailtrap を使用しています。メール機能を試す場合は、`.env`ファイルにあなた自身の Mailtrap の情報を追記してください。

メール処理はバックグラウンドで非同期に実行される**キュー**を使用しています。メール送信をテストする際は、以下のコマンドでキューワーカーを立ち上げる必要があります。

```bash
php artisan queue:work
```

```

```
