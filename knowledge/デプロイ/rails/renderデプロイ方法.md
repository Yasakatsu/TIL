# 【完全版】Rails Renderデプロイガイド
Webサービスの作成から読めばOK！！

https://qiita.com/yuuki-h/items/9f594c046a6e676eb8f8

前回は、ちなみに、secretkeyのvalueが間違っていてfaildになった。
上のURlを実施すると、　config/master.key　のファイルが作成されるので、
作成されたファイルの内容をコピペ。

更に、renderでデプロイする場合、

bin/render-build.sh　ファイルを作成して
ファイル内に下記を記述して、commit＆push

```rails:render-build.sh
#!/usr/bin/env bash
#exit on error
set -o errexit
bundle install
bundle exec rails assets:precompile
bundle exec rails assets:clean
bundle exec rails db:migrate
```
それから、rennder側の「setting」項目内に、「Build & Deploy」というのがあり
その中の「build command」に『./bin/render-build.sh　』と入力し、
ファイルを読み込ませる。

