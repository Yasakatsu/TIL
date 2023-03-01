```php 
/*************データベース登録処理ファイル*************/
<?php
require '../../common/database.php';

// パラメータ取得
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

// DB接続処理
$database_handler = getDatabaseConnection();

try {
  // インサートsql文を作成して実行
  if ($stmt = $database_handler->prepare('INSERT INTO users(name,email,password)VALUES(:name,:email,:password)')) {
    $pass = password_hash($user_password, PASSWORD_DEFAULT);

    $stmt->bindParam(':name', htmlspecialchars($user_name)); //htmlspecialcharsを使って、特殊文字をHTML記号に変換して設定
    $stmt->bindParam(':email', $user_email);
    $stmt->bindParam(':password', $pass); //ハッシュ化したpass($pass)に代入する
    $stmt->execute();
  }
} catch (Throwable $e) {
  echo $e->getMessage();
  exit;
}

// メモ投稿画面にリダイレクト
header('Location:../../memo/'); //index.phpは省略できるように、docker環境に設定済
exit;
```
------------------------------------------------
最初にrequire関数を使って、DB接続関数を呼び出し、呼び出し先の関数を使用し、インスタンスを作成

:nameの箇所にはユーザーが入力した名前をhtmlspecialcharsを使って、特殊文字をHTML記号に変換して設定

:emailには画面から渡されたemailを設定して、:passwordには作成したパスワードのハッシュ値が設定されます。

最後に$stmt（$statement)のexecuteメソッドを呼び出すと、SQLが実行されます。

-----------------------------------------------------
### password_hashについて

password_hashはパスワードのハッシュ値を作成してくれます。

パスワードはusersテーブルのカラムで直接確認できると、セキュリティ的によくないので、今回はハッシュ値を作成し、DBに登録。

ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

### htmlspecialcharsについて
htmlspecialcharsを使用すると、特殊文字をHTMLでの記号に変換してくれます。

例えば、下記のようにリンクを使用されるのを防ぐことができます。
```html
<a href="">google.com</a>
```
htmlspecialcharsを使用することにより、下記のような文字列になります。
```html
&lt; a href=&quot;&quot;&gt;google.com&lt;/a&gt;
```
これはHTML表示される時は、タグではなく文字列として認識され、元の下記のような形で表示されます。
```html
<a href="">google.com</a>
```
これはHTML表示される時は、タグではなく文字列として認識され、元の下記のような形で表示されます。
