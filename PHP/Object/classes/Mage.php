<?php

class Mage extends Human
{
  const MAX_HITPOINT = 80;
  private $hitPoint = 80;
  private $attackPoint = 10;
  private $intelligence = 30; //魔法攻撃力

  public function __construct($name)
  {
    // parent：：で親クラスのメソッドの効果を呼ぶ事が出来る
    // Humanクラスのコンストラクタを明示的に呼び、プロパティを上書き
    parent::__construct($name, $this->hitPoint, $this->attackPoint, $this->intelligence);
  }


  public function doAttack($enemies)
  {
    // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
    if (!$this->isEnableAttack($enemies)) {
      return false;
    }
    // ターゲットの決定
    $enemy = $this->selectTarget($enemies);

    if (rand(1, 2) === 1) {
      //スキルの発動
      echo "『" . $this->getName() . "』のスキルが発動した！\n";
      echo "『メラゾーマ』\n";
      echo $enemy->getName() . "に" . $this->intelligence * 1.5 . "のダメージ！\n";
      $enemy->tookDamage($this->attackPoint * 1.5);
    } else { //スキルが発動しない時、
      parent::doAttack($enemies); //falseなら親（parent）クラスのメソッドを呼ぶ。という意味
    }
    return true;
  }
}
