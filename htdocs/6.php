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
       <?php if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
       <?php } ?>
       <label>名前</label>
       <input type="text" name="uname" placeholder="名前"><br>

       <label>電話番号</label>
       <input type="text" name="bangou" placeholder="電話番号"><br>

       <button type="submit">ログイン</button>
    </from>
</body>
</html>

<<<<<<< HEAD
<?php

$sname= "localhost";
$unmae= "root";
$bangou= "";

$db_name = "arubaito_db";

$conn = mysqli_connect($sname, $unmae, $bangou, $db_name);

if (!$conn) {
    echo "Connection failed!";
}
=======

>>>>>>> adecf4a5aa325b3cce8d2bbba644af39b2c39d8a
