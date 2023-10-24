#エラー解消方法

[Recived a non-Vinyl object in dest()エラーの解消方法](https://stackoverflow.com/questions/51162471/gulpfile-error-recived-a-non-vinyl-object)

結論、gulp以外に入れてるパッケージのverとの互換性が正しくなく、改めてpackage.jsonファイルに組み込んでいるパッケージのverを確認し、

必要に応じ、rmして最新の物にinstallし直す。

インストール後は、 npm i コマンドを忘れないように注意。
