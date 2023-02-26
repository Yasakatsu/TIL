```php
<?php

require_once('./lib/Loader.php');
require_once('./lib/Utility.php');
// session_start();

//********************オートロード機能********************
$loader = new Loader();
// classesフォルダの中身をロード対象ディレクトリとして登録
$loader->regDirectory(__DIR__ . '/classes');
// classes/constantsフォルダの中身を全てロード対象ディレクトリとして登録
$loader->regDirectory(__DIR__ . '/classes/constants');
$loader->register();
//インスタンス化
$members = array();
$members[] = Brave::getInstance(CharacterName::BRAVE);
$members[] = new Mage(CharacterName::MAGE);
$members[] = new Souryo(CharacterName::SOURYO);

$enemies = array();
$enemies[] = new Enemy(EnemyName::SURAIMU, 20);
$enemies[] = new Enemy(EnemyName::DORAKEY, 25);
$enemies[] = new Enemy(EnemyName::OOKIZUTI, 30);

$turn = 1;
$isFinishFlg = false;
$messageObj = new Message;

while (!$isFinishFlg) {
  echo "\n";
  echo "*********   $turn ターン目 *********\n\n";
  // 仲間のステータスを表示（リファクタリング済み）
  $messageObj->displayStatusMessage($members);
  // 敵のステータスを表示（リファクタリング済み）
  $messageObj->displayStatusMessage($enemies);


  //＊＊＊＊＊＊＊＊＊＊＊＊＊攻撃＊＊＊＊＊＊＊＊＊＊＊＊＊
  // 仲間の攻撃（リファクタリング済み）
  $messageObj->displayAttackMessage($members, $enemies);
  // 敵の攻撃（リファクタリング済み）
  $messageObj->displayAttackMessage($enemies, $members);


  // 戦闘終了条件のチェック(リファクタリング済み)
  // 仲間全員のHPが0
  $isFinishFlg = isFinish($members);
  if ($isFinishFlg) {
    $message = "GAME OVER........\n\n";
    break;
  }
  // 敵全員のHPが0
  $isFinishFlg = isFinish($enemies);
  if ($isFinishFlg) {
    $message = "♪♪♪♪♪♪♪♪♪ファンファーレ♪♪♪♪♪♪♪♪♪\n\n";
    break;
  }

  $turn++;
}


echo "★★★★★★★★★★★★ 戦闘終了 ★★★★★★★★★★★★★★★\n\n";
echo $message;

//＊＊＊＊＊＊＊＊＊＊＊＊＊現在のHPの表示＊＊＊＊＊＊＊＊＊＊＊＊＊
// 仲間のステータスを表示（リファクタリング済み）
$messageObj->displayStatusMessage($members);
// 敵のステータスを表示（リファクタリング済み）
$messageObj->displayStatusMessage($enemies);


?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>

<body>
  <h1 style="text-align:center; color:#333;">ゲーム「ドラ◯エ!!」</h1>
  <div style="background:black; padding:15px; position:relative;">
    <?php if (empty($_SESSION)) { ?>
      <h2 style="margin-top:60px;">GAME START ?</h2>
      <form method="post">
        <input type="submit" name="start" value="▶ゲームスタート">
      </form>
    <?php } else { ?>
      <h2><?php echo $_SESSION['monster']->getName() . 'が現れた!!'; ?></h2>
      <div style="height: 150px;">
        <img src="<?php echo $_SESSION['monster']->getImg(); ?>" style="width:120px; height:auto; margin:40px auto 0 auto; display:block;">
      </div>
      <p style="font-size:14px; text-align:center;">モンスターのHP：<?php echo $_SESSION['monster']->getHp(); ?></p>
      <p>倒したモンスター数：<?php echo $_SESSION['knockDownCount']; ?></p>
      <p>勇者の残りHP：<?php echo $_SESSION['myhp']; ?></p>
      <form method="post">
        <input type="submit" name="attack" value="▶攻撃する">
        <input type="submit" name="escape" value="▶逃げる">
        <input type="submit" name="start" value="▶ゲームリスタート">
      </form>
    <?php } ?>
    <div style="position:absolute; right:-350px; top:0; color:black; width: 300px;">
      <p><?php echo (!empty($_SESSION['history'])) ? $_SESSION['history'] : ''; ?></p>
    </div>
  </div>

</body>

</html>
```
