# ローカルリポジトリ操作

プロジェクト上のディレクトリを確認。

ディレクトリ内に`.git`ファイルがない場合、

下記、コマンドを掲題ディレクトリ上で行う。

`git init`（初期化）

### 既存のファイルを全てステージ（インデックス）にあげる

１）　コマンド`git add .`(全てのファイルがあがる)

２）コマンド `git commit -m "〇〇〇〇（メッセージ送信）"
`

# github操作

１）新規、既存のディレクトリを作成、確認する

２）`コード`というタブをクリックし、HTTPSのURLをコピー

例：`https://github.com/Yasakatsu/TIL.git`

# ローカルリポジトリ操作

作業ディレクトリに戻り、コマンド`git remote add main https://github.com/Yasakatsu/TIL.git`を入力

`git push main main`コマンド入力。


# pushできない場合

大体が、前のcommit内容と、衝突している事が多いので、

一度、コマンド`git rebase main/main`打って、その後、pushするとgood

