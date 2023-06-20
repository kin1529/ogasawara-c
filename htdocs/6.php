<!DOCTYPE html>
<html>
    <head>
        <title>アルバイト画面</title>
        <link rel="stylesheet" type="text/css" href="6.css">
</head>
<body>
    <form action="8.php" method="post">
       <h2>アルバイト個人情報ログイン</h2>
       <div style="text-align:center" >名前をセレクトボタンで選択し<br>
       電話番号を入力してください</p>
       <label>名前</label>
       <input type="text" name="uname" placeholder="名前"><br>

       <label>電話番号</label>
       <input type="text" name="bangou" placeholder="電話番号"><br>

       <button type="submit">ログイン</button>
    </from>
</body>
</html>
<?php
// データベース接続情報
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = 'データベースのパスワード';
$dbName = 'arubaito_table';

// データベースに接続
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// 接続エラーの確認
if ($conn->connect_error) {
    die("データベースへの接続に失敗しました: " . $conn->connect_error);
}

if (isset($_POST['name']) && isset($_POST['phone'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // データベースにデータを挿入するクエリを作成
    $query = "INSERT INTO employees (name, phone) VALUES ('$name', '$phone')";

    // クエリを実行して結果を確認
    if ($conn->query($query) === true) {
        // データの挿入成功
        echo "データの挿入に成功しました";
    } else {
        // データの挿入失敗
        echo "データの挿入に失敗しました: " . $conn->error;
    }
}

// データベース接続を閉じる
$conn->close();
?>