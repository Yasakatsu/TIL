<?php
//ログを取るか //ログの出力ファイルを指定
ini_set('log_errors', 'on');
ini_set('error_log', 'php.log');

include 'lib/secure.php';       //管理画面にログインした状態状態にする
include 'lib/connect.php';      //DB接続のため
include 'lib/queryArticle.php'; //Articleの操作を行うため
include 'lib/article.php';      //Articleの操作を行うため

if (!empty($_GET['id'])) {
  $queryArticle = new QueryArticle();
  $article = $queryArticle->find($_GET['id']);
  if ($article) {
    $article->delete();
  }
}
header('Location: backend.php');
