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

## ダウンロード方法

git clone
git clone https://github.com/aokitashipro/laravel_umarche

git clone ブランチを指定してダウンロードする場合
git clone -b ブランチ名 https://github.com/aokitashipro/laravel_umarche

もしくは zip ファイルでダウンロードしてください

## インストール方法

cd laravel_umarche
composer install
npm install
npm run dev

.env.example をコピーして .env ファイルを作成

.env ファイルの内容をご利用の環境に合わせて変更してください。

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_umarche
DB_USERNAME=umarche
DB_PASSWORD=password123

XAMPP/MAMP または他の開発環境で DB を起動した後に

php artisan migrate:fresh --seed

と実行してください。(データベーステーブルとダミーデータが追加されれば OK)

最後に php artisan key:generate
と入力してキーを生成後、
(laravel を composer でダウンロードした際は自動生成されます)

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください。

## インストール後の実施事項

画像のダミーデータは
public/images フォルダ内に
sample1.jpg ~ sample6.jpg として
保存しています。

php artisan storage:link で
storage フォルダにリンク後、

storage/app/public/products フォルダ内に
保存すると表示されます。
(products フォルダがない場合は作成してください。)

ショップの画像も表示する場合は、
storage/app/public/shops フォルダを作成し、
画像を保存してください。

## section7 の補足

決済のテストとして stripe を使用しています。
必要な場合は .env に stripe の情報を追記してください。

## section8 の補足

メールのテストとして mailtrap を使用しています。
必要な場合は.env に mailtrap の情報を追記してください。

メール処理には時間がかかるので、
キューを使用しています。

必要な場合は php artisan queue:work で
ワーカーを立ち上げて動作確認するようにしてください。
