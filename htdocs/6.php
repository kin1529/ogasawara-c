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

<?php
session_start();
include "6.db.php";

if (isset($_POST['uname']) && isset($_POST['bangou'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['bangou']);

    if (empty($uname)){
        header("location: 6.php?error=正しく入力されませんでした");
        exit();
    }else if(empty($pass)){
        header("location: 6.php?error=正しく入力されませんでした");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND bangou='$pass'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['bangou'] === $pass) {
                echo "成功";
        }else{
            header("location: 6.php?error=成功");
        exit();
        }
}else{
    header("location: 6.php?error=正しく入力されませんでした");
    exit();
}
}
}