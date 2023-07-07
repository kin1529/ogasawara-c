<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>gamen1.php</title>
  <link rel="stylesheet" href="gamen1.css">
</head>
<body>
  <div class="container">
    <h2>ドリンク検索</h2>
    <form action="gamen2.php" method="post">
      <select name="building" id="building">
        <option value="1">1号館</option>
        <option value="2">2号館</option>
        <option value="3">3号館</option>
        <option value="4">4号館</option>
        <option value="5">5号館</option>
        <option value="6">6号館</option>
        <option value="7">7号館</option>
        <option value="8">8号館</option>
        <option value="9">9号館</option>
        <option value="old">旧車両問</option>
      </select>
      <div class="button-container">
        <input type="button" value="戻る" onclick="history.back()">
        <input type="submit" value="検索">
      </div>
    </form>
  </div>
</body>
</html>
