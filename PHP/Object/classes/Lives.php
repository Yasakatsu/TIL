<?php

class Lives
{
  // プロパティ
  private $name;
  private $hitPoint; //HP
  private $attackPoint; //攻撃力
  private $intelligence; //魔法攻撃力

  // メソッド
  public function __construct($name, $hitPoint = 50, $attackPoint = 10, $intelligence = 0)
  {
    $this->name = $name;
    $this->hitPoint = $hitPoint;
    $this->attackPoint = $attackPoint;
    $this->intelligence = $intelligence;
  }

  // 名前を取得するメソッド（ゲッター）
  public function getName()
  {
    return $this->name;
  }
  // 現在HPを取得するメソッド’(ゲッター）
  public function getHitPoint()
  {
    $result = $this->hitPoint;
    if ($result < 0) {
      $result = 0;
    }
    return $result;
  }
  // 現在HPを設定するメソッド(セッター）
  public function tookDamage($damage)
  {
    $this->hitPoint -= $damage;
    // HPが０未満にならない為の処理
    if ($this->hitPoint < 0) {
      $this->hitPoint = 0;
    }
  }
  // 現在HPを設定するメソッド（セッター）
  public function recoveryDamage($heal, $target)
  {
    $this->hitPoint += $heal;
    // 最大値を超えて回復しない
    if ($this->hitPoint > $target::MAX_HITPOINT) {
      $this->hitPoint = $target::MAX_HITPOINT;
    }
  }
  // 攻撃するメソッド
  public function doAttack($targets)
  {
    if (!$this->isEnableAttack($targets)) {
      return false;
    }
    // ターゲットの決定
    $target = $this->selectTarget($targets);
    echo "『" . $this->name . "』の攻撃！\n";
    echo "【" . $target->getName() . "】に" . $this->attackPoint . "のダメージ！\n";
    $target->tookDamage($this->attackPoint);
    return true;
  }

  // 攻撃ができるかどうかチェック
  public function isEnableAttack($targets)
  {
    // チェック１：自身のHPが０以下の場合
    if ($this->hitPoint <= 0) {
      return false;
    }
    // チェック２：敵全員のHPが０より大きい場合
    foreach ($targets as $target) {
      if ($target->getHitPoint() > 0) {
        return true;
      }
    }
  }

  // ターゲットを決めるメソッド
  public function selectTarget($targets)
  {
    $target = $targets[rand(0, count($targets) - 1)];
    // 敵のHPが０以下の場合、再度ターゲットを決める
    while ($target->getHitPoint() <= 0) {
      $target = $targets[rand(0, count($targets) - 1)];
    }
    return $target;
  }
}
