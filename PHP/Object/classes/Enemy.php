<?php

class Enemy extends Lives
{
  // プロパティ(リファクタリング済み)
  const MAX_HITPOINT = 50;  //最大HPの定義
  // メソッド(リファクタリング済み)
  public function __construct($name, $attackPoint)
  {
    $hitPoint = 50;
    $intelligence = 0;
    parent::__construct($name, $hitPoint, $attackPoint, $intelligence);
  }
}
