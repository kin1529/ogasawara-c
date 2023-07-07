<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <title>書き込み画面</title>
  <link rel="stylesheet" href="kome2.css"> <!-- CSSファイルのリンク -->

  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 400px;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      display: inline-block;
      width: 80px;
    }

    input[type="text"] {
      width: 300px;
    }

    .button-container {
      display: flex;
      justify-content: flex-end;
    }

    button {
      padding: 5px 10px;
    }
  </style>

</head>

<body>
<style>
  #comment-input {
    height: 150px; /* コメント */
  }
</style>

<div class="container">
  <form method="POST" action="CUP.php">
    <div class="form-group">
      <label for="datetime-input">日時:</label>
      <input type="text" name="datetime" id="datetime-input" required>
    </div>
    <div class="form-group">
     <label for="building-input">号館:</label>
     <select name="building" id="building-input" required>
      <option value="1号館">1号館</option>
      <option value="2号館">2号館</option>
      <option value="3号館">3号館</option>
      <option value="4号館">4号館</option>
      <option value="5号館">5号館</option>
      <option value="6号館">6号館</option>
      <option value="7号館">7号館</option>
      <option value="8号館">8号館</option>
      <option value="9号館">9号館</option>
      <option value="旧車両門">旧車両門</option>
      </select>
    </div>
    <div class="form-group">
      <label for="product-input">商品名:</label>
      <input type="text" name="product" id="product-input" required>
    </div>
    <div class="form-group">
      <label for="comment-input">コメント:</label>
      <input type="text" name="comment" id="comment-input" required>
    </div>
    <div class="button-container">
      <button type="submit">更新</button>
    </div>
  </form>
</div>

<?php

require 'db.php';                               # 接続
$sql = 'SELECT * FROM comment2';                # SQL文
$prepare = $db->prepare($sql);                  # 準備
$prepare->execute();                            # 実行
$result = $prepare->fetchAll(PDO::FETCH_ASSOC); # 結果の取得

//

echo '<table style="border-collapse: collapse;">';
echo '<tr><th style="border: 1px solid black;">ID</th><th style="border: 1px solid black;">日時</th><th style="border: 1px solid black;">号館</th><th style="border: 1px solid black;">商品名</th><th style="border: 1px solid black;">コメント</th></tr>';

foreach ($result as $row) {
    $id       = h($row['ID']);
    $varcharA = h($row['日時']);
    $intA     = h($row['号館']);
    $intB     = h($row['商品名']);
    $intc     = h($row['コメント']);

    echo "<tr>";
    echo "<td style='border: 1px solid black;'>{$id}</td>";
    echo "<td style='border: 1px solid black;'>{$varcharA}</td>";
    echo "<td style='border: 1px solid black;'>{$intA}</td>";
    echo "<td style='border: 1px solid black;'>{$intB}</td>";
    echo "<td style='border: 1px solid black;'>{$intc}</td>";
    echo "</tr>";
}

echo '</table>';

?>
  
</body>

</html>