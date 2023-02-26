<?php
class Brave extends Human
{
  const MAX_HITPOINT = 120;              //最大HPの定義
  private $hitPoint = self::MAX_HITPOINT; //self::　自身の定数にアクセス。
  private $attackPoint = 30;              //攻撃力

  // 自身（Braveクラス）のインスタンスが入る
  private static $instance;
  // コンストラクタをprivateにすることで、外部からコンストラクタを呼ぶことを不可能不可能する
  private function __construct($name)
  {
    // parent：：で親クラスのメソッドの効果を呼ぶ事が出来る
    // Humanクラスのコンストラクタを明示的に呼び、プロパティを上書き
    parent::__construct($name, $this->hitPoint, $this->attackPoint);
  }

  // 設計パターン「シングルトン」を採用する為、常にインスタンスは１つしか生成しない
  public static function getInstance($name)
  {
    if (empty(self::$instance)) {
      self::$instance = new Brave($name);
    }
    return self::$instance;
  }


  //Humanクラスのメソッドをオーバーライド
  //オーバーライドする時は、継承元の引数の数と合わせないとならない
  public function doAttack($enemies)
  {
    // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
    if (!$this->isEnableAttack($enemies)) {
      return false;
    }
    // ターゲットの決定
    $enemy = $this->selectTarget($enemies);

    // 乱数の発生
    if (rand(1, 3) === 1) {
      //スキルの発動
      echo "『" . $this->getName() . "』のスキルが発動した！\n";
      echo "『ギガスラッシュ』\n";
      echo $enemy->getName() . "に" . $this->attackPoint * 1.5 . "のダメージ！\n";
      $enemy->tookDamage($this->attackPoint * 1.5);
    } else {
      parent::doAttack($enemies); //falseなら親（parent）クラスのメソッドを呼ぶ。という意味
    }
    return true;
  }

  public function geAttackPoint()
  {
    return $this->attackPoint;
  }
}
