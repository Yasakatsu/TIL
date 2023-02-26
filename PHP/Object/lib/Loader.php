<?php
class Loader
{
  // オートロード対象対象となるディレクトリを保持するプロパティ
  private $directories = array();

  // オートロード対象のフォルダーのパスを$directoriesプロパティに配列形式で格納する
  public function regDirectory($dir)
  {
    $this->directories[] = $dir;
    return;
  }

  // クラスを読み込むオブジェクトを登録するメソッド
  public function register()
  {
    // 自身自身（Loader）のメソッドであるloadClass()をコールバック関数として登録
    spl_autoload_register(array($this, 'loadClass'));
  }
  // register()メソッドによってオートロードに登録されたコールバック
  public function loadClass($className)
  {
    // パスを１個ずつ取り出す
    foreach ($this->directories as $dir) {
      // クラスファイルへのパスを作成
      $filePath = $dir . '/' . $className . '.php';
      // $filePathが読み込めるかどうがチェックする処理
      if (is_readable($filePath)) {
        require $filePath; //読み込めたら,requireして、ループ終了
        return;
      }
    }
  }
}
