<?php
//ログを取るか
ini_set('log_errors', 'on');
//ログの出力ファイルを指定
ini_set('error_log', 'php.log');

class Article
{
  // このパラメータは外部から変更されたくないので、privateにしておきます。こうすることで、$article->id=XXのように直接値を設定できなくなり、$article->setID(XX)のようにメソッドを通してのみ設定できるようになります。
  // 同様に、$article->idと直接取得するのではなく$article->getId()のようにメソッドを通して取得できるようになります。
  private $id = null;
  private $title = null;
  private $body = null;
  private $category_id = null;
  private $filename = null;
  private $file = null;
  private $created_at = null;
  private $updated_at = null;

  public function save()
  {
    $queryArticle = new QueryArticle();
    $queryArticle->setArticle($this);
    $queryArticle->save();
  }

  public function delete()
  {
    $queryArticle = new QueryArticle();
    $queryArticle->setArticle($this);
    $queryArticle->delete();
  }

  /////////////////////////インスタンスから値の取得//////////////////
  public function getId()
  {
    return $this->id;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getBody()
  {
    return $this->body;
  }
  public function getCategoryId()
  {
    return $this->category_id;
  }
  public function getFilename()
  {
    return $this->filename;
  }
  public function getFile()
  {
    return $this->file;
  }
  public function getCreatedAt()
  {
    return $this->created_at;
  }
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }

  /////////インスタンスから値のセットを行う/////////////////////
  public function setId($id)
  {
    $this->id = $id;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function setBody($body)
  {
    $this->body = $body;
  }
  public function setCategoryId($category_id)
  {
    $this->category_id = $category_id;
  }
  public function setFilename($filename)
  {
    $this->filename = $filename;
  }
  public function setFile($file)
  {
    $this->file = $file;
  }
  public function setCreatedAt($created_at)
  {
    $this->created_at = $created_at;
  }
  public function setUpdatedAt($updated_at)
  {
    $this->updated_at = $updated_at;
  }
}
