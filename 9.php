<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="9.css">
    <title>シフト作成・登録</title>
    <script>
        function redirectToDestination() {
            var isShiftCreator = true; // シフト作成者かどうかの条件

            if (isShiftCreator) {
                window.location.href = "11.php"; // シフト作成者向けのURL
            } else {
                window.location.href = "12.php"; // アルバイト向けのURL
            }
        }
    </script>
</head>

<body>
    <h2 style="text-align:left">シフト作成・登録</h2>



    <button onclick="redirectToDestination()" class="btn_01">登録</button>
</body>

</html>