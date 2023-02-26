<?php

class Message
{

  public function displayStatusMessage($objects)
  {
    foreach ($objects as $object) {

      echo $object->getName() . "：" . $object->getHitPoint() . "/" . $object::MAX_HITPOINT . "\n";
    }
    echo "\n";
  }

  public function displayAttackMessage($objects, $targets)
  {
    foreach ($objects as $object) {
      // 僧侶の場合、味方のオブジェクトも渡す
      if (get_class($object) == "Souryo") {
        $attackResult = $object->doAttackSouryo($targets, $objects);
      } else {
        $attackResult = $object->doAttack($targets);
      }
      if ($attackResult) {
        echo "\n";
      }
      $attackResult = false;
    }
    echo "\n";
  }
}
