<?php

class Human extends Lives
{

  //プロパティ (リファクタリング済み) 
  const MAX_HITPOINT = 100;  //最大HPの定義
  // メソッド(リファクタリング済み)
  public function __construct($name, $hitPoint = 100, $attackPoint = 20, $intelligence = 0)
  {
    parent::__construct($name, $hitPoint, $attackPoint, $intelligence);
  }
}
