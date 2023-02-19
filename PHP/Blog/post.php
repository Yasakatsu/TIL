<!--管理画面をログイン限定にする -->
<!--セッションの開始--><!--ログインの判別-->
<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

include 'lib/secure.php';
include 'lib/connect.php';
include 'lib/queryArticle.php';
include 'lib/article.php';
include 'lib/queryCategory.php';

$title = "";       //タイトル
$body = "";        //本文
$title_alert = ""; //タイトルのエラー文言
$body_alert = "";   //本文のエラー文言
$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

if (!empty($_POST['title']) && !empty($_POST['body'])) {
  //titleとbodyがPOSTメソッドで送信された時、
  $title = $_POST['title'];
  $body = $_POST['body'];

  $db = new connect();
  $sql = "INSERT INTO articles (title, body, created_at, updated_at) VALUES (:title, :body, NOW(), NOW())";
  $result = $db->query($sql, array(':title' => $title, ':body' => $body));
  header('Location: backend.php');

  // Articleクラスのインスタンスを作成し、タイトルと本文をセットしsave()メソッドを実行
  $article = new Article();
  $article->setTitle($title);
  $article->setBody($body);

  if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $article->setFile($_FILES['image']);
  }
  // 指定されたカテゴリーが存在していれば、記事のカテゴリーIDとしてセット
  if (!empty($_POST['category'])) {
    $category = $queryCategory->find($_POST['category']);
    if ($category) {
      $article->setCategoryId($category->getId());
    }
  }

  $article->save();
  header('Location:backend.php');
} else if (!empty($_POST)) {
  //POST送信されたが、titleかbodyに入力不足が発生した場合
  //存在する方は変数に入力内容をいれ、空の場合は、変数の中身を空文字にして、フォームの値(value)に設定する
  if (!empty($_POST['title'])) {
    $title = $_POST['title'];
  } else {
    $title_alert = "タイトルを入力してください。";
  }

  if (!empty($_POST['body'])) {
    $title = $_POST['body'];
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

        <h1>記事の投稿</h1>

        <form action="post.php" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label class="form-label">タイトル</label>
            <?php echo !empty($title_alert) ? '<div class="alert alert-danger">' . $title_alert . '</div>' : '' ?>
            <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">本文</label>
            <?php echo !empty($body_alert) ? '<div class="alert alert-danger">' . $body_alert . '</div>' : '' ?>
            <textarea name="body" class="form-control" rows="10"><?php echo $body; ?></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">カテゴリー</label>
            <select name="category" class="form-control">
              <option value="0">なし</option>
              <?php foreach ($categories as $c) : ?>
                <option value="<?php echo $c->getId() ?>"><?php echo $c->getName() ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">画像</label>
            <input type="file" name="image" class="form-control">
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
        </form>

      </div>
    </div>

  </main>

</body>

</html>
