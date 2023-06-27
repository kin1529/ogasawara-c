<!DOCTYPE html>
<html>
    <head>
        <title>アルバイト画面</title>
        <link rel="stylesheet" type="text/css" href="6.css">
    </head>
    <body>
        <form action="" method="post">
            <h2>アルバイト個人情報ログイン</h2>
            <div style="text-align:center">
                <p>名前をセレクトボタンで選択し<br>
                電話番号を入力してください</p>
                <label>名前</label>
                <input type="text" name="name" placeholder="名前"><br>

                <label>電話番号</label>
                <input type="text" name="bangou" placeholder="電話番号"><br>

                <button type="submit">ログイン</button>
            </div>
        </form>
    </body>
</html>

<?php
// フォームが送信されたかどうかを確認
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 入力データを取得
    $name = $_POST["name"];
    $phone = $_POST["bangou"];

    // フォームのバリデーション
    if (empty($name) || empty($phone)) {
        // 必須フィールドが空の場合、エラーメッセージを表示して処理を中止
        echo "ユーザーIDとパスワードを入力してください";
        exit;
    }

    // データベース接続設定
    require_once("db.php");

    // プリペアドステートメントの準備
    $stmt = $db->prepare("SELECT * FROM arubaito_table WHERE 名前=? AND 電話番号=?");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $phone);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // ログインの判定と処理
    if ($result) {
        // ログイン成功の処理
        echo "ログインに成功しました";
        // ログイン成功の処理
        header("Location: 8.php");
        exit;
    } else {
        // ログイン失敗の処理
        echo "ユーザーIDまたはパスワードが間違っています";
        // ログイン画面に戻るためのリンクを表示
        echo '<a href="6.php">ログイン画面に戻る</a>';
        exit;
    }

    // データベース接続を閉じる
    $db = null;
}
?>