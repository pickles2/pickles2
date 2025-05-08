Pickles 2 - ファイルベースの静的CMS
=========

[Pickles 2](https://pickles2.com/) は、オープンソースの静的ファイルベースCMSです。

- データベース不要、 PHPが動くウェブサーバーに手軽に導入できます。
- サイトマップ(ページリスト)をExcelまたはCSV形式で管理し、ビゲーションの生成やパンくず生成、タイトルやメタタグの出力などを一元管理します。
- 直感的なドラッグ&ドロップの操作で編集できるブロックエディタ機能を搭載しています。
- Markdown で記事を編集することも可能です。
- コンテンツ(ページ固有の内容部分)と、テーマ(ヘッダ、フッタ、ナビゲーションなどの共通部分)に分けてコーディングします。テーマはサイト全体を通して一元化された共通コードから自動生成します。
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

PHPビルトインサーバーで起動することができます。

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
- Apache
  - mod_rewrite が利用可能であること
  - .htaccess が利用可能であること
  - または、Nginx、 PHPビルトインサーバー でも利用可能
- PHP 7.3 以上
  - [mbstring](https://www.php.net/manual/ja/book.mbstring.php) PHP Extension
  - [JSON](https://www.php.net/manual/ja/book.json.php) PHP Extension
  - [PDO](https://www.php.net/manual/ja/book.pdo.php) PHP Extension
  - [PDO SQLite (PDO_SQLITE)](https://www.php.net/manual/ja/ref.pdo-sqlite.php) PHP Extension


## 更新履歴 - Change log

### pickles2/pickles2 v2.5.1 (リリース日未定)

- モジュールを更新した。
- テーマを更新した。
- 依存パッケージのバージョンを更新。

### pickles2/pickles2 v2.5.0 (2025年2月12日)

- 依存パッケージのバージョンを更新。

### pickles2/pickles2 v2.4.0 (2025年1月18日)

- コンテンツテンプレートを追加した。
- 依存パッケージのバージョンを更新。

### pickles2/pickles2 v2.3.2 (2024年9月10日)

- モジュールを更新した。
- テーマを更新した。
- 新しい 画像スライダーモジュール に対応した。

### pickles2/pickles2 v2.3.1 (2024年7月21日)

- `tomk79/px2-page-list-generator` を削除。

### pickles2/pickles2 v2.3.0 (2024年5月3日)

- モジュールを更新した。
- `.htaccess` の修正。
- `composer.json` に `px2package` 情報を追加。
- キャッシュバスターを有効に設定した。
- `PHP_BINARY` が利用可能な場合に、PHPコマンドのパス設定のデフォルトになるようになった。

### pickles2/pickles2 v2.2.1 (2024年2月18日)

- モジュールを更新した。
- テーマを更新した。
- ページ内目次機能に、クラス名 `.px2-index-list` を与えるようになった。

### pickles2/pickles2 v2.2.0 (2023年9月24日)

- デフォルトのテーマを更新。 `article` レイアウトに対応した。
- 標準モジュールを更新した。
- 依存パッケージを更新した。

### pickles2/pickles2 v2.1.2 (2023年7月18日)

- `.env` 項目に、`CMD_COMPOSER`、`CMD_GIT` を追加した。
- `config.php` の末尾に `setlocale()` のサンプルを追加した。

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

Copyright (c)2001-2025 Tomoya Koyanagi, and Pickles Project<br />
MIT License https://opensource.org/licenses/mit-license.php


## 作者 - Author

- Tomoya Koyanagi <tomk79@gmail.com>
- website: <https://www.pxt.jp/>
- Twitter: @tomk79 <https://twitter.com/tomk79/>
