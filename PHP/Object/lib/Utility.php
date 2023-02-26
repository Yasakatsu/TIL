<?php
// ********戦闘の終了条件の判定を行うメソッド（リファクタリング済み）********
function isFinish($objects)
{
  $deathCnt = 0; //HPが０以下の仲間の数
  foreach ($objects as $object) {
    // 1人でもHPが０を超えていたらfalseを渡す
    if ($object->getHitPoint() > 0) {
      return false;
    }
    $deathCnt++;
  }
  // 仲間の数が死亡数(HPが０以下の数)と同じであればtrueを返す
  if ($deathCnt === count($objects)) {
    return true;
  }
}
