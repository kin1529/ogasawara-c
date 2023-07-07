<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
  <title>ドリンク検索</title>
  <link rel="stylesheet" type="text/css" href="gamen4.css">
</head>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    .search-box {
      text-align: center;
    }
  </style>
</head>
<body>
  <form action="gamen4.php" method="post">
  <div class="search-box">
    <h1>ドリンク検索</h1>

      <input type="text" name="query" placeholder="商品名を入力">
      <div class="button-container">
        <input type="button" value="戻る" onclick="history.back()">
        <input type="submit" value="検索">

      </div>
  </div>
      
    </form>
    
</html>
