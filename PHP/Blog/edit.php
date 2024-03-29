<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

//管理画面をログイン限定にする
//セッションの開始  ログインの判別
include 'lib/secure.php';
include 'lib/connect.php';
include 'lib/queryArticle.php';
include 'lib/article.php';
include 'lib/queryCategory.php';

$id = "";          //ID
$title = "";       //タイトル
$body = "";        //本文
$title_alert = ""; //タイトルのエラー文言
$body_alert = "";  //本文のエラー文言
$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

if (isset($_GET['id'])) {
  $queryArticle = new QueryArticle();
  $article = $queryArticle->find($_GET['id']);

  if ($article) {

    //編集する記事データが存在している場合、フォームに既存のデータ内容を埋め込む
    $id = $article->getId();
    $title = $article->getTitle();
    $body = $article->getBody();
    $category_id = $article->getCategoryId();

    //編集するデータが存在しない時
  } else {
    header('Location:backend.php');
    exit;
  }


  //id,title、bodyがPOSTメソッドで送信され時
} else if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['body'])) {
  $title = $_POST['title'];
  $body = $_POST['body'];

  $queryArticle = new QueryArticle();
  $article = $queryArticle->find($_POST['id']);

  ///記事データが保存されていれば、タイトルと本文の内容を変更
  if ($article) {

    $article->setTitle($title);
    $article->setBody($body);

    //画像がアップロードされていたとき
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
      //画像の内容を変更
      $article->setFile($_FILES['image']);
    }

    if (!empty($_POST['category'])) {
      $category = $queryCategory->find($_POST['category']);
      if ($category) {
        $article->setCategoryId($category->getId());
      }
    } else {
      $article->setCategoryId(null);
    }
    //save()メソッドを使って,変更内容を上書き保存
    $article->save();
  }
  header('Location:backend.php');
  exit;


  /// POSTメソッドで送信されたが、titleかbodyが足りないとき
} else if (!empty($_POST)) {
  if (!empty($_POST['id'])) {
    $id = $_POST['id'];
  } else {
    //編集する記事IDがセットされていなければ、backend.phpへ戻る
    header('Location:backend.php');
    exit;
  }

  //存在するほうは、変数へ代入、存在しない場合は空文字にしてフォームの値(value)に設定する
  if (!empty($_POST['title'])) {
    $title = $_POST['title'];
  } else {
    $title_alert = "タイトルを入力してください。";
  }
  if (!empty($_POST['body'])) {
    $body = $_POST['body'];
  } else {
    $body_alert = "本文を入力してください。";
  }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Blog Backend</title>

  <!-- Bootstrap core CSS -->
  <link href="./css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      padding-top: 5rem;
    }

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

    .bg-red {
      background-color: #4495ff !important;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="" rel="stylesheet" />
</head>

<body>
  <?php include('lib/nav.php'); ?>

  <main class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>記事の編集</h1>

        <form action="edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id ?>">

          <div class="mb-3">
            <label class="form-label">タイトル</label>
            <!-- 三項演算子形式でphp記述　→[式１？　式２：式３]→式１がtrueの時、式２を値とし、式１がfalseの時、式３を値にする -->
            <?php echo !empty($title_alert) ? '<div class="alert alert-danger">' . $title_alert . '</div>' : '' ?>
            <!-- valueに値を設定すると、入力した文字がフォーム送信をかけても残る -->
            <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">本文</label>
            <!-- 三項演算子形式でphp記述　→[式１？　式２：式３]→式１がtrueの時、式２を値とし、式１がfalseの時、式３を値にする -->
            <?php echo !empty($body_alert) ? '<div class="alert alert-danger">' . $body_alert . '</div>' : '' ?>
            <textarea name="body" rows="10" class="form-control"><?php echo $body; ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">カテゴリー</label>
            <select name="category" class="form-control">
              <option value="0">
                なし
              </option>
              <?php foreach ($categories as $c) : ?>
                <option value="<?php echo $c->getId() ?>" <?php echo $category_id == $c->getId() ? 'selected="selected"' : '' ?>>
                  <?php echo $c->getName() ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>

          <?php if ($article->getFilename()) : ?>
            <label for="" class="form-label">現在の画像</label>
            <div class="mb-3">
              <img src="./album/thumbs-<?php echo $article->getFilename() ?>">
            </div>
          <?php endif ?>

          <div class="mb-3"><label class="form-label">画像</label>
            <input type="file" name="image" class="form-control">
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
        </form>

      </div>
    </div>
    <!-- /.row -->
  </main>
  <!-- /.container -->
</body>

</html>
