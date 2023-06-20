<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="4.css">
    <title>アルバイト情報　登録・消去</title>

</head>

<body>
    <div style="text-align: center;">
        <h1>アルバイト情報 登録・消去</h1>
        <form action="process.php" method="post">
    <label for="name" style="font-size: 30px;">名前:</label>
    <input name="name" id="name" style="font-size: 30px;">
    <br>
    
    <label for="phone" style="font-size: 30px;">電話番号:</label>
    <input type="tel" name="phone" id="phone" required style="font-size: 30px;">
    <br>

    <label for="hourly-rate" style="font-size: 30px;">時給:</label>
    <input type="number" name="hourly-rate" id="hourly-rate" required style="font-size: 30px;">
    <br>

    <input type="submit" name="register" value="登録" class="btn_01">
    <input type="submit" name="delete" value="消去" class="btn_02">
</form>
    </div>
</body>

</html>
<?php
session_start();

// データベース接続情報
$host = 'データベースのホスト名';
$dbUsername = 'データベースのユーザー名';
$dbPassword = 'データベースのパスワード';
$dbName = 'データベース名';

// データベースに接続
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// 接続エラーの確認
if ($conn->connect_error) {
    die("データベースへの接続に失敗しました: " . $conn->connect_error);
}

// 登録ボタンが押された場合の処理
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $hourlyRate = $_POST['hourly-rate'];

    // データベースに新しいアルバイト情報を登録
    $query = "INSERT INTO arubaito_table (バイトID, 名前, 電話番号, 時給) VALUES (NULL, '$name', '$phone', $hourlyRate)";
    if ($conn->query($query) === true) {
        echo "アルバイト情報が登録されました。";
    } else {
        echo "アルバイト情報の登録に失敗しました。";
    }
}

// 消去ボタンが押された場合の処理
if (isset($_POST['delete'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // データベースからアルバイト情報を削除
    $query = "DELETE FROM arubaito_table WHERE 名前='$name' AND 電話番号='$phone'";
    if ($conn->query($query) === true) {
        echo "アルバイト情報が削除されました。";
    } else {
        echo "アルバイト情報の削除に失敗しました。";
    }
}

// データベース接続を閉じる
$conn->close();
?>
