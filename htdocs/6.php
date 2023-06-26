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

// データベース接続設定
require_once ("db.php");


// ログインボタンが押された時の処理
if (isset($_POST['login'])) {
    // 入力枠に空が無いことをチェック
    if($_POST['名前'] == "" || $_POST['電話番号'] == "") {
        $_SESSION['index_err_msg'] = "ID・パスワードを入力してからログインボタンを押して下さい";
        header("Location: ".$_SERVER['HTTP_REFERER']);  
    }else{
        try {
            // データベースへの接続
            $dsn = 'mysql:dbname=music_archive;host=127.0.0.1';
            $dbh = new PDO($dsn, 'db_admin', 'admin');

            // 入力されたIDのパスワード取得
            $sql = 'SELECT 電話番号 FROM arubaito_table WHERE 名前 = :名前'; // SQL文を構成
            $sth = $dbh->prepare($sql); // SQL文を実行変数へ投入
            $sth->bindParam(':名前', $_POST['名前']); // ユーザIDを実行変数に挿入
            $sth->execute(); // SQLの実行
            $user_pass = $sth->fetch(); // 処理結果の取得
            
            // ログイン認証処理
            if($user_pass!=0 && password_verify($_POST['電話番号'], $user_pass['電話番号'])) {
                // ログイン成功時の処理
                $_SESSION['名前'] = $_POST['名前']; // ログインIDを格納したセッション変数を定義
                $_SESSION['index_err_msg'] = ""; // エラーメッセージの削除
                header("Location:recorder.php");
                }else{
                    // ログイン失敗時にエラーメッセージを表示する処理
                    $_SESSION['6_err_msg'] = "ユーザIDまたはパスワードに不備があります";
                    header("Location: ".$_SERVER['HTTP_REFERER']);
                }

        // データベースへの接続に失敗した場合
        } catch (PDOException $e) {
            print('データベースへの接続　に失敗しました:' . $e->getMessage());
        die();
        }
    }
}
?>