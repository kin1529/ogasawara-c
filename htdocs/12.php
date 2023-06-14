<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="1.css">
    <title>シフト作成者シフト確認</title>
</head>

<body>
    <h1>シフト作成者シフト確認</h1>
    <?php
// シフトデータ（仮のデータ）
$shift_data = [
    ['id' => 1, 'name' => 'John'],
    ['id' => 2, 'name' => 'Jane'],
    ['id' => 3, 'name' => 'Mike'],
    // 他のスタッフデータ...
];

// シフト表の開始日と終了日を設定します
// シフト表の開始日と終了日を設定します
if (isset($_GET['date'])) {
    $start_date = new DateTime($_GET['date']);
} else {
    $start_date = new DateTime('2023-06-11');
}

// 開始日が日曜日でない場合、次の日曜日まで移動します
if ($start_date->format('w') !== '0') {
    $start_date->modify('next Sunday');
}

$end_date = clone $start_date;
$end_date->add(new DateInterval('P13D'));

// 前の2週間の開始日と終了日を計算します
$prev_start_date = clone $start_date;
$prev_start_date->sub(new DateInterval('P14D'));
$prev_end_date = clone $prev_start_date;
$prev_end_date->add(new DateInterval('P13D'));

// 次の2週間の開始日と終了日を計算します
$next_start_date = clone $start_date;
$next_start_date->add(new DateInterval('P14D'));
$next_end_date = clone $next_start_date;
$next_end_date->add(new DateInterval('P13D'));

// 曜日の配列
$weekdays = ['日', '月', '火', '水', '木', '金', '土'];

// 前の2週間へのリンクを表示します
echo "<a href='?date={$prev_start_date->format('Y-m-d')}'>前の2週間</a> | ";

// 次の2週間へのリンクを表示します
echo "<a href='?date={$next_start_date->format('Y-m-d')}'>次の2週間</a>";

// シフト表のヘッダーを作成します
echo "<table>";
echo "<tr><th>ID</th><th>名前</th>";

$current_date = clone $start_date;

// シフト表の各日についてループします
while ($current_date <= $end_date) {
    $date = $current_date->format('Y-m-d');
    $weekday = $weekdays[$current_date->format('w')];
    $cell_style = '';
    
    if ($weekday === '土') {
        $cell_style = 'background-color: blue; color: white;';
    } elseif ($weekday === '日') {
        $cell_style = 'background-color: red; color: white;';
    }
    
    echo "<th style='border: 1px solid black; $cell_style'>$date ($weekday)</th>";
    $current_date->add(new DateInterval('P1D'));
}

echo "</tr>";

// スタッフごとにループしてシフト情報を表示します
foreach ($shift_data as $staff) {
    $id = $staff['id'];
    $name = $staff['name'];

    echo "<tr>";
    echo "<td style='border: 1px solid black;'>$id</td>";
    echo "<td style='border: 1px solid black;'>$name</td>";

    $current_date = clone $start_date;

    while ($current_date <= $end_date) {
        $date = $current_date->format('Y-m-d');

        // シフト情報の開始時間と終了時間を取得します
        $start_time = $_POST['shift'][$id][$date]['start_time'] ?? '';
        $end_time = $_POST['shift'][$id][$date]['end_time'] ?? '';

        echo "<td style='border: 1px solid black;'>$start_time - $end_time</td>";

        $current_date->add(new DateInterval('P1D'));
    }

    echo "</tr>";
}

echo "</table>";
?>
</body>

</html>