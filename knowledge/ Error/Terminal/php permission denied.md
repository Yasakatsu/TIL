ルートディレクトリにて
php -v コマンドを入力し、反応なしなら

PATHが通っていない確率、高めなので、

以下、コマンドをルートディレクトリ上で実施。

`vi .bash_profile`

.bash_profile が開くので、編集を行うためキーボード【e】を入力

すでにごちゃごちゃ書いてあると思うので、下記内容を追記(ver内に自分が起動しているphpのver数値を入力し記述する)

`export PATH=/usr/local/opt/php@ver.ver.ver/bin:$PATH`


