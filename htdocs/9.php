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
// シフトデータ（仮のデータ）
$shift_data = [
    ['id' => 1, 'name' => 'John'],
    ['id' => 2, 'name' => 'Jane'],
    ['id' => 3, 'name' => 'Mike'],
    // 他のスタッフデータ...
];

// シフト表の開始日と終了日を設定します
if (isset($_GET['date'])) {
    $start_date = new DateTime($_GET['date']);
} else {
    // 一か月後の日曜日の日付を取得します
    $next_sunday = strtotime('next Sunday +1 month');
    $next_sunday_date = date('Y-m-d', $next_sunday);
    $start_date = new DateTime($next_sunday_date);
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

        // シフト情報の開始時間のセレクトボックスの生成
        $start_time_name = "shift[$id][$date][start_time]";
        $start_time_id = "start_time_$id" . "_" . $current_date->format('Ymd');
        $start_time_html = "<select name='$start_time_name' id='$start_time_id'>";
        $start_time_html .= "<option value='--'>--</option>";

        // 開始時間の選択肢を生成します（9時から22時まで）
        for ($hour = 9; $hour <= 22; $hour++) {
            $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
            $start_time_html .= "<option value='$time'>$time</option>";
        }

        $start_time_html .= "</select>";

        // シフト情報の終了時間のセレクトボックスの生成
        $end_time_name = "shift[$id][$date][end_time]";
        $end_time_id = "end_time_$id" . "_" . $current_date->format('Ymd');
        $end_time_html = "<select name='$end_time_name' id='$end_time_id'>";
        $end_time_html .= "<option value='--'>--</option>";

        // 終了時間の選択肢を生成します（開始時間以降の時間）
        for ($hour = 9; $hour <= 22; $hour++) {
            $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
            $end_time_html .= "<option value='$time'>$time</option>";
        }

        $end_time_html .= "</select>";

        echo "<td style='border: 1px solid black;'>$start_time_html - $end_time_html</td>";

        $current_date->add(new DateInterval('P1D'));
    }

    echo "</tr>";
}

echo "</table>";

?>

    <button onclick="redirectToDestination()" class="btn_01">登録</button>
</body>

</html>