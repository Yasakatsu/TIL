```php
function getDatabaseConnection()
{
  try {
    $dbh = new PDO('mysql:host=db;dbname=memoApp;charset=utf8mb4', 'root', 'password');
  } catch (PDOException $e) {
    echo "DBの接続に失敗しました。</br>";
    echo $e->getMessage();
    exit;
  }
  return $dbh;
}
```

## getDatabaseConnection関数の解説
```php
try {
    // データベース接続処理
} catch (Throwable $e) {
    // 失敗時の処理
}
```
最初にtry catchで囲む

そしてtryの中でnew PDOしている箇所で新しいインスタンスを作成しています。

PDOをnewするときにメソッドに渡すのは、接続文字列と接続ユーザーとパスワードです。
接続文字列には下記を渡しています。

-------------------------------------------------------------------------------
**mysql: : 接続するデータベースの種類**

**host= : 接続するサーバー**

**dbname= : 前回のパートで作成したデータベース名**

**charset= : 文字コード**

-------------------------------------------------------------------------------

$database_handlerに取得できたインスタンスを設定して、そのまま呼び出し元に返しています。

PDOをnewしたときに、データベース接続で問題があった場合は、catchでエラーを捕まえて、画面にエラーを出力して終わるようにしています。
