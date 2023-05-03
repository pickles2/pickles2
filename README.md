Pickles 2
=========

[Pickles 2](https://pickles2.com/) は、静的で大きなウェブサイトを効率よく構築できる オープンソースのHTML生成ツールです。

- サイトマップ(ページリスト)をCSV形式で管理し、グローバルナビゲーションの生成やカレント処理、パンくず生成、タイトルやメタタグの出力などを自動化します。
- コンテンツ(ページ固有の内容部分)と、テーマ(ヘッダ、フッタ、ナビゲーションなどの共通部分)に分けてコーディングします。テーマはサイト全体を通して一元化された共通コードから自動生成します。
- データベース不要、 PHP が動くウェブサーバーに手軽に導入できます。
- Markdown や SCSS などの文法を動的に導入できます。
- 簡単なコマンドで、スタティックなHTMLファイルを出力(パブリッシュ)できます。
- Composer 導入により、機能の追加、拡張が手軽にできるようになりました。


## インストール手順 - Install

Pickles 2 のインストールは、`composer` コマンドを使用します。

```bash
$ cd {$documentRoot}
$ composer create-project pickles2/pickles2 ./
$ chmod -R 777 ./px-files/_sys
$ chmod -R 777 ./src_px2/common/px_resources
```

ウェブサーバーにブラウザでアクセスして、トップページが表示されるか、または、次のコマンドで設定情報が表示されれば成功です。

```bash
$ php ./.px_execute.php /?PX=config
```

## パブリッシュ手順 - Publish

```bash
$ php ./.px_execute.php "/?PX=publish.run"
```

`./dist/` に、スタティックなHTMLとして出力されます。


## サーバーを起動する手順 - Start server

### プレビュー

```bash
$ composer start
```

### 公開ディレクトリ

```bash
$ composer run-script start-pub
```


## キャッシュを消去する手順 - Clear caches

```bash
$ php ./.px_execute.php "/?PX=clearcache"
```

## システム要件 - System Requirement

- Mac, Linux または Windowsサーバ
- Apache 1.3 以降
  - mod_rewrite が利用可能であること
  - .htaccess が利用可能であること
- PHP 7.4 以上
  - mb_string が有効に設定されていること
  - safe_mode が無効に設定されていること


## 付録 - Appendix

### composer のインストール

`composer` のインストール方法について
詳しくは [composerの公式サイト(英語)](https://getcomposer.org/doc/00-intro.md) を参照してください。

下記は公式サイトからの抜粋です。参考までに。

#### Macの方

Mac の方は、次のコマンドでグローバルインストールできます。

```bash
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
```
#### Windowsの方

Windows の方は、GUIインストーラ Composer-Setup.exe が用意されています。
次のコマンドでもインストールできますので、お好みの方法でインストールしてください。

```bash
$ cd C:\\bin
$ php -r "readfile('https://getcomposer.org/installer');" | php
```


### pickles2/pickles2 v2.1.0 (2023年5月4日)

- Pickles 2 Clover CMS を導入した。
- dotEnv を導入した。
- BlogKit を導入した。
- その他、初期コンテンツを更新した。


## ライセンス - License

Copyright (c)2001-2023 Tomoya Koyanagi, and Pickles Project<br />
MIT License https://opensource.org/licenses/mit-license.php


## 作者 - Author

- Tomoya Koyanagi <tomk79@gmail.com>
- website: <https://www.pxt.jp/>
- Twitter: @tomk79 <https://twitter.com/tomk79/>
