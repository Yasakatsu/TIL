# The following tasks did not complete: default, hoge Did you forget to signal async completion?

[gulpコマンド入力後に発生。解決方法は、こちら](https://www.tweeeety.blog/entry/2018/06/18/060030)

原因は、gulp.taskのメソッド記述方法が、v3系からv4系になっった事で、変更となった。

そのため、gulpfile.js記載のgulp.taskメソッドに対し、

function()記述中に　return をつけ、記述し直す事で解消。

