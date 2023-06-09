<?php
session_start();
include "db_conn.php";

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
        header("location: index2.php?error=正しく入力されませんでした");
        exit();
    }else if(empty($pass)){
        header("location: index2.php?error=正しく入力されませんでした");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND bangou='$pass'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['bangou'] === $pass) {
                echo "成功";
        }else{
            header("location: index2.php?error=成功");
        exit();
        }
}else{
    header("location: index2.php?error=正しく入力されませんでした");
    exit();
}
}
}