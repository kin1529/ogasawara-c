<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="4.css">
    <title>アルバイト情報　登録・消去</title>

</head>

<body>
    <div style="text-align: center;">
        <h1>アルバイト情報 登録・消去</h1>
        <form action="process.php" method="post">
    <label for="name" style="font-size: 30px;">名前:</label>
    <input name="name" id="name" style="font-size: 30px;">
    <br>
    
    <label for="phone" style="font-size: 30px;">電話番号:</label>
    <input type="tel" name="phone" id="phone" required style="font-size: 30px;">
    <br>

    <label for="hourly-rate" style="font-size: 30px;">時給:</label>
    <input type="number" name="hourly-rate" id="hourly-rate" required style="font-size: 30px;">
    <br>

    <input type="submit" name="register" value="登録" class="btn_01">
    <input type="submit" name="delete" value="消去" class="btn_02">
</form>
    </div>
</body>

</html>