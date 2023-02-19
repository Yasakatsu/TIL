<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

class connect
{
  const DB_NAME = "blog";
  const HOST = "localhost";
  const USER = "root";
  const PASS = "root";

  protected $dbh;

  public function __construct()
  {
    $dsn = "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
    try {
      //PDOのインスタンスをクラスの中の変数（メンバ変数）に格納し、$this->を使ってメンバ変数（dbh）にアクセスする
      // メンバ変数(クラス内変数)にアクセスする際には、$this->変数　でアクセス可能
      $this->dbh = new PDO($dsn, self::USER, self::PASS);
    } catch (Exception $e) {
      //Exceptionが発生したら表示して終了
      exit($e->getMessage());
    }

    //DBのエラーを表示するモードを設定
    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }

  //第一引数はsql文を入力し必須、第二引数はパラメータを割り当てる。
  //修飾子がpublicなので、作ったインスタンスから呼び出しができる。
  public function query($sql, $param = null)
  {
    //プリペアードステートメントを作成し、SQL文を実行する準備をする
    //セキュリティの面でも大きなメリットがあり->不正な値を入れてSQLを実行させ、意図しない結果を生む攻撃から守る
    $stmt = $this->dbh->prepare($sql);
    //パラメータを割り当てて実行し、結果セットを返す
    $stmt->execute($param);
    return $stmt;
  }
}
