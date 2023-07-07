<!<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>gamen1.php</title>
  <link rel="stylesheet" type="text/css" href="gamen1.css">
</head>
<body>
    <?php
    #コメントされたデータの取得
    $goukan=$_POST['building'];
    #地図の表示
   /* if($goukan==1){
        echo "./img/product6.png";
    }else if($goukan==2){
        echo "./src/img/gazou";
    }else if(goukan==3){
        echo "./src/img/gazou";
    }else if($goukan==4){
        echo "./src/img/gazou";
    }else if($goukan==6){
        echo "./src/img/gazou";
    }else if($goukan==9){
        echo "./src/img/gazou";
    }else if($goukan=="旧車両門"){
        echo "./src/img/gazou";
    }*/

    if($goukan==1){
        $imagePath = "niziu.jpg";
        $imagePath2 = "./img/product6.png";
    }else if($goukan==2){
        $imagePath = "./src/img/gazou";
    }else if($goukan==3){
        $imagePath = "./src/img/gazou";
    }else if($goukan==4){
        $imagePath = "./src/img/gazou";
    }else if($goukan==6){
        $imagePath = "./src/img/gazou";
    }else if($goukan==9){
        $imagePath = "./src/img/gazou";
    }else if($goukan=="旧車両門"){
        $imagePath = "./src/img/gazou";
    }



    #検索結果の表示
    require 'db.php';                                                # 接続
    $sql = "SELECT * FROM zihankidata WHERE 号館 = \"$goukan\"";     # SQL文
    $prepare = $db->prepare($sql);                                   # 準備
    $prepare->execute();                                             # 実行
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);                  # 結果の取得
    /*if (!empty($result)) {
    }
    foreach ($result as $row) {
        $s = h($row['商品名']); 
        $n = h($row['値段']);
        $g = h($row['号館']);
        $k = h($row['階数']);
        $m = h($row['メーカー名']);
        echo "<tr><td>{$s}</td>
        <td>{$n}</td>
        <td>{$g}</td>
        <td>{$k}</td>
        <td>{$m}</td>
        </tr>";
        $num++;*/

        /*foreach ($result as $row) {
            $s = h($row['商品名']);
            $n = h($row['値段']);
            $g = h($row['号館']);
            $k = h($row['階数']);
            $m = h($row['メーカー名']);
            echo "{$s}, {$n}, {$g}, {$k},{$m} <br/>";
         } if (empty($result)) {
            echo "自販機はありません。<br>号館を変更して検索してください。";
        }*/
        if (!empty($result)) {
            echo '<table>';
            echo '<tr><th>商品名</th><th>値段</th><th>号館</th><th>階数</th><th>メーカー名</th></tr>';
        
            foreach ($result as $row) {
                $s = h($row['商品名']);
                $n = h($row['値段']);
                $g = h($row['号館']);
                $k = h($row['階数']);
                $m = h($row['メーカー名']);
        
                echo "<tr><td>{$s}</td><td>{$n}</td><td>{$g}</td><td>{$k}</td><td>{$m}</td></tr>";
            }
        
            echo '</table>';
        } else {
            echo "自販機はありません。<br>号館を変更して検索してください。";
        }
    ?>
<img src="<?php echo $imagePath; ?>" alt="Image">
<img src="<?php echo $imagePath2; ?>" alt="Image">
</body>
</html>