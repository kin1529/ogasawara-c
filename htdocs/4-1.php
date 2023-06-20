<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<link rel='stylesheet' href='4-1.css' />
<title>アルバイト情報</title>
</head>
<body>
<?php
# 送信されたデータの取得
$name = $_POST['name'];
$phone = $_POST['phone'];
$hourlyRate = $_POST['hourly-rate'];

require 'mydb.sql'; # 接続
$sql = 'insert into arubaito_table (name,phone,`hourly-rate`) values (:name, :phone, :hourlyRate)’;
$prepare = $db->prepare($sql); # 準備
$prepare->bindValue(':name', $name, PDO::PARAM_STR); # 埋め込み1
$prepare->bindValue(':phone', $phone, PDO::PARAM_STR); # 埋め込み2
$prepare->bindValue(':hourlyRate', $hosurlyRate, PDO::PARAM_STR); # 埋め込み3
$prepare->execute(); # 実行
?>
<br>
<a href="1.php" class="btn_01">
<span class="vertical-text">戻る</span>
</a>

</body>
</html>