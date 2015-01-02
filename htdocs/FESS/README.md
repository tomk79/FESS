Pickles 2
=========

Pickles 2 は、静的で大きなウェブサイトを効率よく構築できる オープンソースのHTML生成ツールです。

- サイトマップ(ページリスト)をCSV形式で管理し、グローバルナビゲーションの生成やカレント処理、パンくず生成、タイトルやメタタグの出力などを自動化します。
- コンテンツ(ページ固有の内容部分)と、テーマ(ヘッダ、フッタ、ナビゲーションなどの共通部分)に分けてコーディングします。テーマはサイト全体を通して一元化された共通コードから自動生成します。
- データベース不要、PHP5.3以上 が動くウェブサーバーに手軽に導入できます。
- Markdown や SCSS などの文法を動的に導入できます。
- 簡単なコマンドで、スタティックなHTMLファイルを出力(パブリッシュ)できます。
- Composer 導入により、機能の追加、拡張が手軽にできるようになりました。


## インストール手順 - Install

Pickles 2 のインストールは、`composer` コマンドを使用します。

```
$ cd {$documentRoot}
$ composer create-project tomk79/pickles2 ./ dev-master
$ chmod -R 777 ./px-files/_sys
$ chmod -R 777 ./caches
```

ウェブサーバーにブラウザでアクセスして、トップページが表示されるか、または、次のコマンドで設定情報が表示されれば成功です。

```
$ php ./.px_execute.php /?PX=config
```

## パブリッシュ手順 - Publish

```
$ php ./.px_execute.php /?PX=publish.run
```

`./px-files/_sys/ram/publish/` に、スタティックなHTMLとして出力されます。


## キャッシュを消去する手順 - Clear caches

```
$ php ./.px_execute.php /?PX=clearcache
```

## システム要件 - System Requirement

- Linux系サーバ または Windowsサーバ
- Apache1.3以降
  - mod_rewrite が利用可能であること
  - .htaccess が利用可能であること
- PHP5.3以上
  - mb_string が有効に設定されていること
  - safe_mode が無効に設定されていること



## ライセンス - License

MIT License


## 作者 - Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>


## 付録 - Appendix

### composer のインストール

`composer` のインストール方法について
詳しくは [composerの公式サイト(英語)](https://getcomposer.org/doc/00-intro.md) を参照してください。

下記は公式サイトからの抜粋です。参考までに。

#### Macの方

Mac の方は、次のコマンドでグローバルインストールできます。

```
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
```
#### Windowsの方

Windows の方は、GUIインストーラ Composer-Setup.exe が用意されています。
次のコマンドでもインストールできますので、お好みの方法でインストールしてください。

```
$ cd C:\bin
$ php -r "readfile('https://getcomposer.org/installer');" | php
```

