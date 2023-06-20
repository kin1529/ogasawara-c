<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='4-1.css' />
    <title>アルバイトデータ表示</title>
  </head>
  <body>
<table border="1">
<tr>
<th>名前</th>
<th>電話番号</th>
<th>自給</th>
</tr>
<?php
                                                             # 接続
$sql = 'SELECT * FROM arubaito_table';                           # SQL文
$prepare = $db->prepare($sql);                                   # 準備
$prepare->execute();                                                      # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC);  # 結果の取得
require '4.php'; 
foreach ($result as $row) {
  $name = h($row['name']);
  $phone = h($row['phone']);
  $hourlyRate  = h($row['hourly-rate']);
  echo "<tr><td>{$name}</td><td>{$phone}</td><td>{$hourlyRate}</td></tr>";
}
?>
</table>

<br>
<a href="1.php" class="btn_01">
  <span class="vertical-text">戻る</span>
</a>

  </body>
</html>
