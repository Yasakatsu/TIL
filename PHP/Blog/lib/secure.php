<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

session_start();
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
}
