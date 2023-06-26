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
       <input type="text" name="name" placeholder="名前"><br>

       <label>電話番号</label>
       <input type="text" name="phone" placeholder="電話番号"><br>

       <button type="submit">ログイン</button>
    </from>
</body>
</html>

<?php

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $hourlyRate = $_POST['hourly-rate'];

// データベース接続設定
require_once ("db.php");

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM arubaito_table WHERE 名前  = :name";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $mail);
$stmt->execute();
$member = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['phone'], $member['phone'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['name'] = $member['name'];
    $msg = 'ログインしました。';
    $link = '<a href="8.php">ホーム</a>';
} else {
    $msg = 'メールアドレスもしくはパスワードが間違っています。';
    $link = '<a href="6.php">戻る</a>';
}
}
?>