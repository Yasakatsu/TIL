<?php
//ログを取るか //ログの出力ファイルを指定
ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

include 'lib/secure.php';       //ログイン状態の確認
include 'lib/connect.php';      ///QueryArticleクラスの基底クラス（継承元）のため
include 'lib/queryArticle.php'; //QueryArticleクラスのため
include 'lib/article.php';      //Articleクラスのため
include 'lib/queryCategory.php';

$limit = 10;
$page = 1;

if (!empty($_GET['page']) && intval($_GET['page']) > 0) {
  $page = intval($_GET['page']);
}

$queryArticle = new QueryArticle();   //QueryArticleクラスのインスタンスを生成
$pager = $queryArticle->getPager($page, $limit);
$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

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
      background-color: #ff6644 !important;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="" rel="stylesheet" />
</head>

<body>
  <?php include('lib/nav.php') ?>
  <main class="container">
    <div class="row">
      <div class="col-md-12">

        <h1>記事一覧</h1>
        <!-- 記事データがあるときの処理 -->
        <?php if ($pager['articles']) : ?>
          <table class="table table-bordered">

            <thead>
              <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>本文</th>
                <th>画像</th>
                <th>カテゴリー</th>
                <th>作成日</th>
                <th>更新日</th>
                <th>編集</th>
                <th>削除</th>
              </tr>
            </thead>
            <tbody>

              <?php foreach ($pager['articles'] as $article) : ?>
                <tr>
                  <!-- $articlesはArticleインスタンスの配列なので、$article->getId()のようにメソッドを呼ぶことができます -->
                  <td><?php echo $article->getId() ?></td>
                  <td><?php echo $article->getTitle() ?></td>
                  <td><?php echo $article->getBody() ?></td>
                  <td><?php echo $article->getFilename() ? '<img src="./album/thumbs-' . $article->getFilename() . '">' : 'なし' ?></td>
                  <td><?php echo isset($categories[$article->getCategoryId()]) ? $categories[$article->getCategoryId()]->getName() : 'なし' ?></td>
                  <td><?php echo $article->getCreatedAt() ?></td>
                  <td><?php echo $article->getUpdatedAt() ?></td>
                  <!-- ?id=xxとして記事のIDを渡しています。 -->
                  <td><a href="edit.php?id=<?php echo $article->getId() ?>" class="btn btn-success">編集</a></td>
                  <td><a href="delete.php?id=<?php echo $article->getId() ?>" class="btn btn-danger">削除</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <!-- 記事データがないときの処理 -->
        <?php else : ?>
          <div class="alert alert-info">
            <p>記事はありません。</p>
          </div>
        <?php endif ?>

        <?php if (!empty($pager['total'])) : ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= ceil($pager['total'] / $limit); $i++) : ?>
                <li class="gage-item">
                  <a href="backend.php?page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a>
                </li>
              <?php endfor ?>
            </ul>
          </nav>
        <?php endif ?>

      </div>
    </div>
    <!-- /.row -->
  </main>
  <!-- /.container -->
</body>

</html>
