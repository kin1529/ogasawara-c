<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<link rel='stylesheet' href='style.css' />
<title>アルバイト情報</title>
</head>
<body>
<?php
# 送信されたデータの取得
$name = $_POST['name'];
$phone = $_POST['phone'];
$hourlyRate = $_POST['hourly-rate'];
require 'db.php'; # 接続

$sql = 'insert into arubaito_table (productname, price, stock) values (:name, :phone, :hourlyRate)’;
$prepare = $db->prepare($sql); # 準備
$prepare->bindValue(':name', $name, PDO::PARAM_STR); # 埋め込み1
$prepare->bindValue(':phone', $phone, PDO::PARAM_STR); # 埋め込み2
$prepare->bindValue(':hourlyRate', $hourlyRate, PDO::PARAM_STR); # 埋め込み3
$prepare->execute(); # 実行
?>
<p><a href="show-all.php">確認</a></p>
</body>
</html>