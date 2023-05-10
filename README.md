Pickles 2
=========

[Pickles 2](https://pickles2.com/) は、オープンソースの静的CMSです。

- データベース不要、 PHP が動くウェブサーバーに手軽に導入できます。
- サイトマップ(ページリスト)をExcelまたはCSV形式で管理し、グローバルナビゲーションの生成やカレント処理、パンくず生成、タイトルやメタタグの出力などを自動化します。
- 直感的なドラッグ&ドロップの操作で編集できるブロックエディタ機能を搭載しています。
- コンテンツ(ページ固有の内容部分)と、テーマ(ヘッダ、フッタ、ナビゲーションなどの共通部分)に分けてコーディングします。テーマはサイト全体を通して一元化された共通コードから自動生成します。
- Markdown や SCSS などの文法を動的に導入できます。
- 簡単なコマンドで、スタティックなHTMLファイルを出力(パブリッシュ)できます。
- モバイルブラウザにも対応した管理画面は、公開コードから完全に切り離され、安全です。
- Gitによる完全な編集履歴の管理、編集内容のバックアップ、復元、転送が可能です。


## インストール手順 - Install

Pickles 2 のインストールは、`composer` コマンドを使用します。
`${documentRoot}` の部分は、インストール先の任意のディレクトリパスに置き換えてください。

```bash
$ cd ${documentRoot}
$ composer create-project pickles2/pickles2 ./
$ chmod -R 777 ./px-files/_sys
$ chmod -R 777 ./src_px2/common/px_resources
```

ウェブサーバーにブラウザでアクセスして、トップページが表示されるか、または、次のコマンドで設定情報が表示されれば成功です。

```bash
$ php ./src_px2/.px_execute.php "/?PX=config"
```

## パブリッシュ手順 - Publish

```bash
$ php ./src_px2/.px_execute.php "/?PX=publish.run"
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
$ php ./src_px2/.px_execute.php "/?PX=clearcache"
```

## システム要件 - System Requirement

- Mac, Linux または Windowsサーバ
- Apache 1.3 以降
  - mod_rewrite が利用可能であること
  - .htaccess が利用可能であること
- PHP 7.3 以上
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


## 更新履歴 - Change log

### pickles2/pickles2 v2.1.1 (2023年5月10日)

- 簡易サーバーの起動時のオリジン指定を追加。プレビュー環境は `127.0.0.1:8080` 、静的パブリッシュ環境は `127.0.0.1:8081` とした。
- ブロックエディタから登録する画像の画質を 0.3 から 0.5 に変更した。
- 管理画面拡張 BlogKit を削除した。 (Clover CMS が提供するブログ管理画面があるので不要なため)

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
