<!DOCTYPE html>
<html>
    <head>
        <title>アルバイト画面</title>
        <link rel="stylesheet" type="text/css" href="6.css">
</head>
<body>
    <form action="" method="post">
       <h2>アルバイト個人情報ログイン</h2>
       <div style="text-align:center" >名前をセレクトボタンで選択し<br>
       電話番号を入力してください</p>
       <label>名前</label>
       <input type="text" name="name" placeholder="名前"><br>

       <label>電話番号</label>
       <input type="text" name="bangou" placeholder="電話番号"><br>

       <button type="submit">ログイン</button>
    </from>
</body>
</html>


<?php
// フォームが送信されたかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力データを取得
    $userId = $_POST["name"];
    $password = $_POST["bangou"];

    // フォームのバリデーション
    if (empty($userId) || empty($password)) {
        // 必須フィールドが空の場合、エラーメッセージを表示して処理を中止
        echo "ユーザーIDとパスワードを入力してください";
        exit;
    }

    // データベース接続設定
    require_once ("db.php");

    $conn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPass);

    // ユーザーIDに対応するデータを取得
    $query = "SELECT 電話番号 FROM arubaito_table WHERE user_id= :名前";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":名前", $userId);
    $stmt->execute();

    // パスワードの照合
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $row["電話番号"];

        if (password_verify($password, $storedPassword)) {
            // ログイン成功の処理
            echo "ログインに成功しました";
             // ログイン成功の処理
            header("Location:8.php");
            exit;

            
        } else {
            // パスワードが一致しない場合の処理
            echo "ユーザーIDまたはパスワードが間違っています";
            // ログイン画面に戻るためのリンクを表示
            echo'<a href="'."6.php".'">'."ログイン画面に戻る".'</a>';
         exit;
        }
    } else {
        // ユーザーIDが存在しない場合の処理
        echo "ユーザーIDまたはパスワードが間違っています";
        // ログイン画面に戻るためのリンクを表示
        echo'<a href="'."6.php".'">'."ログイン画面に戻る".'</a>';
     exit;
    }


    // データベース接続を閉じる
    #$conn = null;



}



?>
