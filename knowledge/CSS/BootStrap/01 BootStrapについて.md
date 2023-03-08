# BootStrapとは
[公式HP](https://getbootstrap.com/)

- cssのフレームワーク(isも含まれているのでisの「レームワークともいえる）
- class属性などで簡単にボタンが作れたり、モーダルが作れるので1から実装する必要がない(ただし、、便利な反面、自由度が低くなってしまい、現場独自のパーツが多い場合はBootStrapのcssコードやjsコードを拡張しなければならず、1から作るより逆にコストがかかってしまうので、大規模なシステムを扱う現場では使われない)
- CSSフレームワークにはBootStrapが有名だが、他にも色々なものがある（BootStrapの使い方さえ知っておけばみんな使い方はほぼ変わらな

## 使い方
1.CDNを使う

2.手動でダウンロードしたファイルを読み込む

3.パッケージ管理ツールでダウンロードしたファイルを読み込む

`@import../css/reset.css';`(cssを指定した場合は@import url(../css/reset.css)，に変換されるだけなので注意)

`@import '…. /node_modules/bootstrap/scss/bootstrap';`(bootstrapを読み込んでから独自のCSSを読み込むこと)

## BootStrapの注意点

1.被るclass名は使わない

(containerというクラス名が被っているため使わない)

2.ver3とver4とでclass名やブレークポイントが違う

