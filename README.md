# ojt-php

[web-developer-ojt](https://github.com/keita-nishimoto/web-developer-ojt) のPHP学習で使うリポジトリです。

## クイックスタート

### パッケージのインストール

プロジェクトルートで `composer install` を実行して下さい。

すると `vendor` 配下に `composer.json` に書かれたpackageがダウンロードされてきます。

このあたりは Node.jsでもあった npm や yarn と良く似ていますね。

### データベース・MySQLユーザー・テーブルの作成

MySQLのインストールとユーザーの作成を行って下さい。

作成するユーザー情報等は `database/database.sql` を参考にして下さい。

ちなみにMySQLのユーザーやデータベースはともかく、テーブルの管理は [DBマイグレーションツール](https://qiita.com/hypermkt/items/e48ca78f626faf23b41a) を使うのが一般的です。

最初のうちは面倒ですがMySQLの操作に慣れる意味でも手動でデータベースやユーザー、テーブルの作成等を行ってみましょう。

ちなみにPHPからMySQLに接続する際は [PDO](http://php.net/manual/ja/book.pdo.php) という標準クラスを使います。

PHPにはたくさんのフレームワークがありますが裏側では大抵このPDOが使われています。

よってPDOを十分に理解しておくと後のアプリケーションフレームワークを学ぶ際に大変役に立ちます。

Qiitaに [PHPでデータベースに接続するときのまとめ](https://qiita.com/mpyw/items/b00b72c5c95aac573b71) という良い記事もありますので、PDOへの理解を深めておく事をオススメします。

### サーバの起動

以下のコマンドでサーバを起動させましょう。

`composer start`

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

※ [SendGrid](https://sendgrid.kke.co.jp/) の契約はフリープランで十分です。

```
APP_URL=アプリケーションのURL
DB_NAME=あなたが決めたデータベース名
DB_USER=あなたが決めたMySQLのユーザー名
DB_PASSWORD=あなたが決めたMySQLのユーザーのパスワード
TEST_DB_NAME=あなたが決めたテスト用データベース名
TEST_DB_USER=あなたが決めたテスト用MySQLユーザー名
TEST_DB_PASSWORD=あなたが決めたテスト用MySQLユーザーパスワード
SENDGRID_API_KEY=SendGridで発行したAPIキー
ADMIN_EMAIL=受信可能なあなたのメールアドレス
```

例としては以下のような形になります。

```
APP_URL=http://192.168.33.100:8080
DB_NAME=ojt_php
DB_USER=ojt_php
DB_PASSWORD=ZVgvWcO_Zndw3hcC
TEST_DB_NAME=ojt_php_test
TEST_DB_USER=ojt_php_test
TEST_DB_PASSWORD=(YourPassword999)
SENDGRID_API_KEY=YOUR_API_KEY
ADMIN_EMAIL=keita.koga@example.com
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

※ 他にも [個人的にPHPで開発する上で頭に入れておきたいと思っている事](https://qiita.com/n_mogi/items/252dc4dcf75f3b2ea977) という記事も人気を集めています。

[PHP The Right Way](http://ja.phptherightway.com/) で書かれている事とも共通点が多いです。

### packageの追加

以下のコマンドをプロジェクトルートで実行すると `composer.json` や `composer.lock` に自動で書き込んでくれるのでオススメです。

- `require` にpackage `friendsofphp/php-cs-fixer` を追加する場合

`composer require friendsofphp/php-cs-fixer`

- `require-dev` にpackage `friendsofphp/php-cs-fixer` を追加する場合

`composer require friendsofphp/php-cs-fixer --dev`

## テストの実行

PHPのテストは [PHPUnit](https://phpunit.readthedocs.io/ja/latest/) が良く利用されています。

`composer test` を実行すると `tests` 配下にあるテストクラスが全て実行されます。

下記のように引数にテストクラスを指定すると特定のテストだけを実行する事が可能です。

`composer test tests/app/models/repository/UserRepository/UserRepositoryTest.php`

さらに特定のメソッドだけをテストしたい場合は下記のように `--filter` オプションを指定して実行します。

`vendor/bin/phpunit tests/app/models/repository/UserRepository/UserRepositoryTest.php --filter testSuccess`

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

namespace App\Lib;

use Monolog\Handler\StreamHandler;

/**
 * Class Logger
 *
 * @package App\Lib
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

PHPDocに関してはPSR-5で標準仕様の策定が進められています。

詳しくは [2018年のPHPDoc事情とPSR-5](https://qiita.com/tadsan/items/72b02339d12120ca37d7) という記事を参考にして下さい。

このプロジェクト内では [公式ドキュメント](https://docs.phpdoc.org/getting-started/your-first-set-of-documentation.html) のルールで書いておけば良いです。

## PHPの標準規約についての説明

ここから先はPHPの標準的な仕組みに関して説明していきます。

最初はルールが多くて大変に感じるかもしれませんが一度慣れてしまえばPHPの中では長く使える知識になるので少しづつ慣れていきましょう。

### PSR

[web-developer-ojt PHP](https://github.com/keitakn/web-developer-ojt/tree/master/docs/server-side-programming/PHP) にも書きましたが、PHPにはPHPフレームワークを開発している団体が定めている標準規約があります。

それがPSRです。

後のセクションで一部は説明しますが、基本的にライブラリやフレームワークを選ぶ際はこのPSRに準拠している物を選ぶと良いでしょう。

基本的な骨組みは一緒なので例え他のフレームワークやライブラリを利用する事になってもPSRに準拠していれば学習コストの面で有利です。

### オートロード（PSR-4）

PHPは通常 `require_once "hogehoge.php";` のように利用したいファイルを読み込む必要があります。

これを自動的にやってくれる仕組みがオートロードです。

そしてオートロードのルールを定めているのが [PSR-4](https://qiita.com/inouet/items/0208237629496070bbd4) になります。

本プロジェクトでは `public/index.php` でオートローダーの読み込みを行っています。

ちなみにオートローダーは自分で作成する事も出来ますが、現在は `composer` がこの仕組みを実装しているのでこれを利用するのが一般的です。

### リクエスト・レスポンス（PSR-7）

初心者向けのPHPの教材にはクエリパラメータやフォームの値を取得する時に `$_GET` や `$_POST` 等のスーパーグローバル変数を使っている例を一度は見た事があるかと思います。

しかしこれらの変数をプログラマのほうで上書きする事が出来てしまいます。

例えば `http://192.168.33.10:8080/?name=k` でリクエストすると `$_GET['name']` で 'k' という文字列が取得出来ます。

しかし以下のように明示的に上書きをする事が出来ます。

```php
<?php
$_GET['name'] = 'kkk';

// こうすると本来ユーザーから送られてきた 'k' が上書きされてしまう。
```

もちろんこんな極端な事をする人はそうそういないと思いますが、ユーザーからのリクエストを上書き出来るという時点でバグが入り込む不安が残ります。

HTTPのメッセージを扱う際は [PSR-7](https://www.php-fig.org/psr/psr-7/) に準拠したライブラリを利用します。

本プロジェクトでは [Slim Framework](https://www.slimframework.com/) が実装している物を利用しています。

# リクエストからレスポンスまでの流れ

基本的な流れは下記の通りです。

`public/index.php`
↓
`app/routes.php`
↓
Controllers配下にあるControllerクラス
↓
models配下にあるビジネスロジックの呼び出し

最初のうちは処理の流れが理解出来るまでデバッグを行ってみると良いでしょう。

# デバッグ方法について

一番簡単なデバッグ方法に関しては [var_dump()](http://php.net/manual/ja/function.var-dump.php) を利用する事です。

引数に変数名を渡すと中身を表示させてくれます。

初心者向けに [もうエラーでつまずかない！PHP言語でデバッグを行う方法【初心者向け】](https://techacademy.jp/magazine/11647) という記事がありますのでこちらも読んでおくと良いでしょう。

使ってみると分かりますが、デバッグの内容が画面上に出力されてしまいます。

よって利用した後は削除するのを忘れないようにしないと重要な情報が流出してしまう危険性があります。（防ぐ為の仕組みは色々あります）

処理完了後にすぐにリダイレクトするケース等で画面に出力出来ないケースもあるでしょう。

そういう場合は `\App\Lib\Logger` を利用します。

```php
<?php
use App\Lib\Logger;

$renderParams = [
    'title' => 'PHP OJT トップ',
];

$logger = new Logger();
$logger->debug($renderParams);
```

`logs/app.log` に変数の中身を含めたデバッグログが出力されます。

上記の例だと下記のように書き込まれます。

```text
[2018-03-15 00:53:02] ojt-php.DEBUG: App\Lib\Logger:debug {"debugValue":{"title":"PHP OJT トップ"}} []
```

Node.jsの時と同じくDebuggerを利用する事が出来ます。

XdebugというDebuggerを使うのが便利ですが、ステップ実行等を行う為にはIDEの力を借りる必要があります。

- [VisualStudioCode + Vagrant + XdebugでPHPをリモートデバッグ](https://qiita.com/ushi_d/items/f4b5af012725728842d7)
- [PhpStorm で Vagrant 環境のリモートデバッグを実行する](https://luftgarden.work/phpstorm-xdebug-vagrant/)
- [Atom+Xdebug+Vagrantでデバッグ環境の構築](https://qiita.com/hazcauch/items/d8ad88ba906982ea9589)
- [PHPSTORMでXdebugを使えるようにしよう！](https://qiita.com/taniai-lvgs/items/8e9eba112d2d0ed2530f)

[phpdbg](http://php.net/manual/ja/migration56.new-features.php#migration56.new-features.phpdbg) という標準のDebuggerが一応存在しますが、個人的にはまだXdebugのほうが扱いやすい印象があります。

# テンプレートエンジンについて

PHPはそれ自体がテンプレートエンジンとしての機能を持っています。

しかし実戦では他の言語と同じようにテンプレートエンジンを利用するのが一般的です。

本プロジェクトでは [Twig](https://twig.sensiolabs.org/) を利用しています。

- [PHPでWebアプリ開発！人気テンプレートエンジン「Twig」を使ってみよう](https://www.webprofessional.jp/twig-popular-stand-alone-php-template-engine/)

# フレームワークについて

本プロジェクトでは [Slim](https://www.slimframework.com/) というマイクロフレームワーク（最小限の機能だけを備えたフレームワーク）を利用しています。

しかし課題を進めていく際にはなるべくフレームワークの機能に頼らない実装を行い基本的な仕組みを理解するほうが大事だと考え、本プロジェクトではあえてフレームワークの機能を使っていない場所も多いです。

CookieやSession、HTTP等のWebアプリケーションの開発の基礎を身につけるほうがフレームワークを覚えるよりも有効な学習となるので、PHP向けの課題ではそのあたりを意識しています。

[Slim](https://www.slimframework.com/) に関しては非常に分かりやすい記事がQiitaにあるので参考にすると良いでしょう。

- [私家版 Slim Framework チュートリアル (1) 〜 特徴と準備編](https://qiita.com/nunulk/items/4b5c15f13ade660cafbc)
- [私家版 Slim Framework チュートリアル (2) 〜 ルーティングと新規作成編](https://qiita.com/nunulk/items/8492548678aac697d0aa)
- [私家版 Slim Framework チュートリアル (3) 〜 表示編](https://qiita.com/nunulk/items/33adfbba55057a7d0c5c)
- [私家版 Slim Framework チュートリアル (4) 〜 編集と削除、ついでにパーシャルビュー編](https://qiita.com/nunulk/items/fb5ef759c1337e99d878)
- [私家版 Slim Framework チュートリアル (5) 〜 Controllerクラス編](https://qiita.com/nunulk/items/92d06bada7657ce212e7)
- [私家版 Slim Framework チュートリアル (6) 〜 テスト編](https://qiita.com/nunulk/items/99c12ac8e7b631bd8ed3)
