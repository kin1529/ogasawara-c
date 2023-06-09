<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <form action="login2.php" method="post">
       <h2>アルバイト個人情報ログイン</h2>
       <?php if (isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
       <?php } ?>
       <label>名前</label>
       <input type="text" name="uname" placeholder="名前"><br>

       <label>電話番号</label>
       <input type="text" name="bangou" placeholder="電話番号"><br>

       <button type="submit">次へ</button>
    </from>
</body>
</html>