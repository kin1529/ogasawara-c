<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>gamen4.php</title>
  <link rel="stylesheet" type="text/css" href="gamen3.css">
</head>
<body>
    <?php
    #コメントされたデータの取得
    $syouhinnmei=$_POST['query'];
    #検索結果の表示
    require 'db.php';                                                # 接続
    $sql = 'SELECT * FROM zihankidata';                              # SQL文
    $prepare = $db->prepare($sql);                                   # 準備
    $prepare->execute();                                             # 実行
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);                  # 結果の取得

        if (!empty($result)) {
            echo '<table>';
            echo '<tr><th>商品名</th><th>値段</th><th>号館</th><th>階数</th><th>メーカー名</th></tr>';
        
            foreach ($result as $row) {
                $s = h($row[商品名]);
                $n = h($row[値段]);
                $g = h($row[号館]);
                $k = h($row[階数]);
                $m = h($row[メーカー名]);
        
                echo '<tr><td>{$s}</td><td>{$n}</td><td>{$g}</td><td>{$k}</td><td>{$m}</td></tr>';
            }
        
            echo '</table>';
        } else {
            echo 'はありません。商品名を変更して検索してください。';
        }
    ?>
<img src="<?php echo $imagePath; ?>" alt="Image">
<img src="<?php echo $imagePath2; ?>" alt="Image">
</body>
</html>