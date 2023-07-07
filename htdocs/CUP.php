<?php

$d = $_POST['datetime'];
$b = $_POST['building'];
$p = $_POST['product'];
$c = $_POST['comment'];


echo "$d<br/>";
echo "$b<br/>";
echo "$p<br/>";
echo "$c<br/>";

require 'db.php';

$sql = "INSERT into comment2 (日時, 号館, 商品名, コメント) values (:d, :b, :p, :c)";

$prepare = $db->prepare($sql);

$prepare->bindValue(':d', $d, PDO::PARAM_STR);
$prepare->bindValue(':b', $b, PDO::PARAM_STR);
$prepare->bindValue(':p', $p, PDO::PARAM_STR);
$prepare->bindValue(':c', $c, PDO::PARAM_STR);

$prepare->execute();

header('Location: ./kome2.php');

?>