<?php

class Souryo extends Lives
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

  public function doAttackSouryo($enemies, $members)
  {

    // 自分のHPが0以上か、敵のHPが0以上かなどをチェックするメソッドを用意。
    if (!$this->isEnableAttack($enemies)) {
      return false;
    }

    if (rand(1, 3) === 1) {
      // ターゲットの決定
      $member = $this->selectTarget($members);

      //スキルの発動
      echo "『" . $this->getName() . "』のスキルが発動した！\n";
      echo "『ベホイミ』\n";
      echo $member->getName() . "のHPを" . $this->intelligence * 1.5 . "回復！\n";
      $member->recoveryDamage($this->intelligence * 1.5, $member);
    } else { //スキルが発動しない時、
      parent::doAttack($enemies); //falseなら親（parent）クラスのメソッドを呼ぶ。という意味
    }
    return true;
  }
}
