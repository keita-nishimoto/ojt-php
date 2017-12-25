# ojt-php

[web-developer-ojt](https://github.com/keita-nishimoto/web-developer-ojt) のPHP学習で使うリポジトリです。

## クイックスタート

プロジェクトルートで `composer install` を実行して下さい。

すると `vendor` 配下に `composer.json` に書かれたpackageがダウンロードされてきます。

このあたりは Node.jsでもあった npm や yarn と良く似ていますね。

以下のコマンドでサーバを起動させましょう。

[ojt-linux-vagrant](https://github.com/keita-nishimoto/ojt-linux-vagrant) を利用している場合は、以下のURLで確認が出来ます。

`http://192.168.33.10:8080`

これは、[Built-in web server](http://php.net/manual/ja/features.commandline.webserver.php) と呼ばれるPHPの組み込みサーバです。

本番環境に耐えうる性能はないですが、手元で開発する分には早くサーバを立ち上げられるので便利です。

ちなみに、実際のサーバでは以下のどれかの方法で起動させるのが一般的です。

- [ApacheモジュールとしてPHPを実行する](http://php.net/manual/ja/security.apache.php)
- [php-fpmを利用しFastCGIとして実行する](http://php.net/manual/ja/install.fpm.php)

本カリキュラムでは php-fpm を使ってFastCGIで実行する方法をメインに学ぶ予定です。

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
