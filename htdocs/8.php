<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="8.css">
    <title>シフト提出・シフト確認　選択</title>

</head>

<body>
    <h1 style="text-align:center">シフト提出とシフト確認</h1>
    <br>
    <a href="9.php" class="btn_01">シフト提出</a>
    <br>
    <a href="11.php" class="btn_01">シフト確認</a>
    <br>
</body>

</html>

<?php
session_start();
include "db2.php";

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

        $result = mysqli_query($conn,$sql);

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

