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

<?php
// シフト表の開始日と終了日を設定します
$start_date = new DateTime('2023-06-12');
$end_date = new DateTime('2023-06-25');

// 曜日に対応する色を設定します
$colors = [
    'Sunday' => 'red',
    'Monday' => 'yellow',
    'Tuesday' => 'green',
    'Wednesday' => 'blue',
    'Thursday' => 'orange',
    'Friday' => 'purple',
    'Saturday' => 'pink',
];

// シフト表のヘッダーを作成します
echo "<table>";
echo "<tr><th>日付</th><th>曜日</th><th>ランチ</th><th>ディナー</th></tr>";

$current_date = clone $start_date;

// シフト表の各日についてループします
while ($current_date <= $end_date) {
    $date = $current_date->format('Y-m-d');
    $day_of_week = $current_date->format('l');
    $lunch_staff = rand(1, 5); // ランチのスタッフ数（仮の値）
    $dinner_staff = rand(1, 5); // ディナーのスタッフ数（仮の値）
    $background_color = isset($colors[$day_of_week]) ? $colors[$day_of_week] : '';

    // シフト表の行を表示します
    echo "<tr>";
    echo "<td>$date</td>";
    echo "<td style='background-color: $background_color;'>$day_of_week</td>";
    echo "<td>$lunch_staff</td>";
    echo "<td>$dinner_staff</td>";
    echo "</tr>";

    // 次の日に進みます
    $current_date->add(new DateInterval('P1D'));
}

echo "</table>";
?>


    <button onclick="redirectToDestination()" class="btn_01">登録</button>
</body>

</html>