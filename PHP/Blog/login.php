<!-- ログイン処理の実装 -->
<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

error_reporting(E_ALL); //全てのエラーを報告する
ini_set('display_errors', 'On'); //画面にエラーを表示させる

//DB接続用の関数の入ったファイルを呼び出す
include 'lib/connect.php';
//エラーメッセージを初期化する
$err = null;

// ユーザー情報の取得

if (isset($_POST['name']) && isset($_POST['password'])) {
  // newキーワードを使って、connectクラスのインスタンスを作成
  // インスタンスのメソッド[query]に、下記内容で実行したいsqlと割り当てるパラメータを設定する
  // connectクラスは'lib/connect.php'ファイル内から呼び出し
  $db = new connect();
  //実行したいsqlを記述し、変数[$select]に格納
  $select = "SELECT * FROM users WHERE name=:name";
  //第二引数（array〜）には、どのパラメータにどんな変数を割り当てるのかをきめる
  $stmt = $db->query($select, array(':name' => $_POST['name']));
  //fetchメソッドを使い、結果セット（DBの表形式のデータ）からレコードをとってくることができる
  //取ってきたレコード１件を[連想配列形式]（FETCH_ASSOC）で取得する指定方法を採用
  // 結果セットをすべて取得したあとで、fetchすると次の行が取得できず返り値がfalseになる
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  //もし、結果が取得できて、かつ、パスワードがハッシュ値とマッチしている場合,sessionスタート
  //password_verify関数は、第1引数のパスワードが、第2引数のハッシュ値にマッチしているかどうかを調べる
  if ($result && password_verify($_POST['password'], $result['password'])) {
    session_start();
    $_SESSION['id'] = $result['id'];
    header('Location:backend.php');
  } else {
    $err = "ログインできませんでした。";
  }
}
?>

<!doctype html>
<html lang="ja">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>loginページ</title>

  <!-- Custom styles for this template -->
  <!-- ここに自身で任意の場所に.cssファイルを作成し読み込む -->
  <link href="./css/signin.css" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

</head>

<body class="text-center">

  <main class="form-signin">

    <form action="login.php" method="post">
      <h1 class="h3 mb-3 fw-normal">ログインする</h1>
      <?php
      if (!is_null($err)) {
        echo '<div class="alert alert-danger">' . $err  . '</div>';
      }
      ?>
      <label class="visually-hidden">ユーザ名</label>
      <input type="text" name="name" class="form-control" placeholder="ユーザ名" required autofocus>
      <label class="visually-hidden">パスワード</label>
      <input type="password" name="password" class="form-control" placeholder="パスワード" required>
      <button class="w-100 btn btn-lg btn-primary" type="submit">ログインする</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    </form>
  </main>



</body>

</html>
