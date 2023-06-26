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
          
           

            // 入力されたIDのパスワード取得
            $sql = 'SELECT 電話番号 FROM arubaito_table WHERE 名前 = :名前'; // SQL文を構成
            $sth = $dbh->prepare($sql); // SQL文を実行変数へ投入
            $sth->bindParam(':名前', $_POST['名前']); // ユーザIDを実行変数に挿入
            $sth->execute(); // SQLの実行
            $phone = $sth->fetch(); // 処理結果の取得
            
            // ログイン認証処理
            if($phone!=0 && password_verify($_POST['電話番号'], $user_pass['電話番号'])) {
                // ログイン成功時の処理
                $_SESSION['名前'] = $_POST['名前']; // ログインIDを格納したセッション変数を定義
                $_SESSION['index_err_msg'] = ""; // エラーメッセージの削除
                header("Location:recorder.php");
                }else{
                    // ログイン失敗時にエラーメッセージを表示する処理
                    $_SESSION['index_err_msg'] = "ユーザIDまたはパスワードに不備があります";
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