# ojt-php

[web-developer-ojt](https://github.com/keita-nishimoto/web-developer-ojt) のPHP学習で使うリポジトリです。

## クイックスタート

### パッケージのインストール

プロジェクトルートで `composer install` を実行して下さい。

すると `vendor` 配下に `composer.json` に書かれたpackageがダウンロードされてきます。

このあたりは Node.jsでもあった npm や yarn と良く似ていますね。

### サーバの起動

以下のコマンドでサーバを起動させましょう。

[ojt-linux-vagrant](https://github.com/keita-nishimoto/ojt-linux-vagrant) を利用している場合は、以下のURLで確認が出来ます。

`http://192.168.33.100:8080`

これは、[Built-in web server](http://php.net/manual/ja/features.commandline.webserver.php) と呼ばれるPHPの組み込みサーバです。

本番環境に耐えうる性能はないですが、手元で開発する分には早くサーバを立ち上げられるので便利です。

ちなみに、実際のサーバでは以下のどれかの方法で起動させるのが一般的です。

- [ApacheモジュールとしてPHPを実行する](http://php.net/manual/ja/security.apache.php)
- [php-fpmを利用しFastCGIとして実行する](http://php.net/manual/ja/install.fpm.php)

本カリキュラムでは php-fpm を使ってFastCGIで実行する方法をメインに学ぶ予定です。

### `.env` の設置

プロジェクトルートに `.env` というファイルを作成し設置して下さい。

ファイルの内容は以下の内容を入れて下さい。

```
DB_USER=あなたが決めたMySQLのユーザー名
DB_PASSWORD=あなたが決めたMySQLのユーザーのパスワード
```

`.env` というファイルはセキュリティ的にgitRepositoryで管理するのが良くないとされている情報を入れておく為の物です。

例えば以下のような物が挙げられます。

- DBのユーザー名やパスワード
- GoogleやAWS等のAPIキーやAPIシークレット

`.env` はPHPだけでなく他の言語でも扱う事が可能です。

PHPの場合は `vlucas/phpdotenv` というパッケージを使って管理を行います。

`getenv('.envに書かれているキー名');` を呼び出すと対象の値が取得可能です。

## Composer

[Composer](https://getcomposer.org/) の簡単な使い方について説明します。

[Composer](https://getcomposer.org/) はPHPのpackage管理ツールです。

似たような物に [PEAR](http://pear.php.net/) がありますが、これは既にレガシーなpackage管理システムなので、現代では [Composer](https://getcomposer.org/) を使うのが一般的です。

この件に限らずネット上ではレガシーなPHPの情報で溢れています。

このような情報に惑わされない為にも [PHP The Right Way](http://ja.phptherightway.com/) を流し読みしておく事をオススメします。

### packageの追加

以下のコマンドをプロジェクトルートで実行すると `composer.json` や `composer.lock` に自動で書き込んでくれるのでオススメです。

- `require` にpackage `friendsofphp/php-cs-fixer` を追加する場合

`composer require friendsofphp/php-cs-fixer`

- `require-dev` にpackage `friendsofphp/php-cs-fixer` を追加する場合

`composer require friendsofphp/php-cs-fixer --dev`

## テストの実行

PHPのテストは [PHPUnit](https://phpunit.de/manual/current/ja/index.html) が良く利用されています。

`composer test` を実行すると `tests` 配下にあるテストクラスが全て実行されます。

下記のように引数にテストクラスを指定すると特定のテストだけを実行する事が可能です。

`composer test tests/app/models/repository/UserRepository/UserRepositoryTest.php`

さらに特定のメソッドだけをテストしたい場合は下記のように `--filter` オプションを指定して実行します。

`vendor/bin/phpunit tests/app/models/repository/UserRepository/UserRepositoryTest.php --filter testSuccess`

※ vendor/bin/phpunit を直接実行しないと `--filter` オプションを実行出来ませんでした。
方法が判明次第、本ドキュメントに追記します。

## テストの実行（コードカバレッジの出力）

`composer test:coverage` を実行します。

カバレッジレポートがHTML形式で `coverage/` 配下に出力されます。

## PHPDocについて

PHPDocを書きましょう。

全ての項目を書いているとかなりしんどいので重要な部分だけを抜粋しました。

なお書くのはクラスが宣言されているファイルだけでOKです。

下記はクラスの例です。

一見どうでもいいただのコメントに見えますが、ツールで出力した際にこの部分が参照されるので必要になります。

```php
/**
 * Logger
 */

namespace App\lib;

use Monolog\Handler\StreamHandler;

/**
 * Class Logger
 *
 * @package App\lib
 */
```

次はクラスに宣言されているメソッドです。

```php
<?php

// 省略

class UserFactory
{

    /**
     * ユーザーオブジェクトを生成する
     * 
     * @param int $id
     * @return User
     */
    public static function create(int $id): User
    {
        $userBuilder = new UserBuilder();
        $userBuilder->setId($id);

        return $userBuilder->build();
    }
}
```

ともかく必須なのは `@param` と `@return` です。

これがあるとIDEやテキストエディタによってはコードの補完を行ってくれたりするので結構重要です。

他にも `@throws` も結構大事です。

これはそのメソッドでどのような例外が発生するかを明示する為の物です。

`app/views/ErrorView.php` 等に記載されているので書き方は直接ファイルを参照して下さい。

[公式ドキュメント](https://docs.phpdoc.org/getting-started/your-first-set-of-documentation.html) にも軽く目を通しておいて下さい。
