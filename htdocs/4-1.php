<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <link rel='stylesheet' href='4-1.css' />
    <title>アルバイトデータ表示</title>
  </head>
  <body>
    <table border="1">
      <tr>
        <th>名前</th>
        <th>電話番号</th>
        <th>時給</th>
      </tr>

      <?php
      // データベース接続設定
      $dbServer = '127.0.0.1';
      $dbName = 'mydb';
      $dsn = "mysql:host={$dbServer};dbname={$dbName};charset=utf8";
      $dbUser = 'root';
      $dbPass = '';
      // データベースへの接続
      $db = new PDO($dsn, $dbUser, $dbPass);

      // アルバイト情報の取得
      require 'arubaito_db.php'; 
      $sql = 'SELECT * FROM arubaito_table';
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($result as $row) {
        $name = htmlspecialchars($row['名前'], ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($row['電話番号'], ENT_QUOTES, 'UTF-8');
        $hourlyRate = htmlspecialchars($row['時給'], ENT_QUOTES, 'UTF-8');
        echo "<tr><td>{$name}</td><td>{$phone}</td><td>{$hourlyRate}</td></tr>";
      }
      ?>

    </table>

    <br>
    <a href="1.php" class="btn_01">
      <span class="vertical-text">戻る</span>
    </a>

  </body>
</html>
