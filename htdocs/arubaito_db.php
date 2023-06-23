<?php
// データベース接続の設定
$dbServer = '127.0.0.1';
$dbName = 'mydb';
$dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
$dbUser = 'root';
$dbPass = '';

// データベースに接続
$db = new PDO($dsn, $dbUser, $dbPass);

// クエリを実行してデータを取得する例
$query = "SELECT * FROM arubaito_table";
$result = $conn->query($query);

// 結果を表示
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}

// 接続を閉じる
$conn = null;
?>