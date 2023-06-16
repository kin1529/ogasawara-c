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

// 開始日の選択肢の範囲を設定します
$min_date = new DateTime('2020-01-01');
$max_date = new DateTime('2025-12-31');

// 選択された開始日を取得します
if (isset($_GET['date'])) {
    $selected_date = new DateTime($_GET['date']);
} else {
    $selected_date = new DateTime('2023-06-11');
}

// 選択肢の日付を生成します
$date_options = generateDateOptions($min_date, $max_date, $selected_date);

// シフト表の開始日と終了日を設定します
$start_date = new DateTime($selected_date->format('Y-m-d'));


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

// フォームの開始
echo "<form method='get' action=''>";

// セレクトボックスで開始日を選択させる
echo "<label for='start_date'>指定日:</label>";
echo "<select name='date' id='start_date'>";
foreach ($date_options as $date_option) {
    $option_value = $date_option['value'];
    $option_label = $date_option['label'];
    $selected = ($selected_date->format('Y-m-d') === $option_value) ? 'selected' : '';
    echo "<option value='$option_value' $selected>$option_label</option>";
}
echo "</select>";

// シフト表を表示するボタン
echo "<input type='submit' value='シフト表を表示'>";

echo "</form>";

// 関数: 選択肢の日付を生成する
function generateDateOptions($min_date, $max_date, $selected_date) {
    $date_options = [];

    $current_date = clone $min_date;
    while ($current_date <= $max_date) {
        $value = $current_date->format('Y-m-d');
        $label = $current_date->format('Y-m-d (D)');
        $date_options[] = [
            'value' => $value,
            'label' => $label,
        ];
        $current_date->add(new DateInterval('P1D'));
    }

    return $date_options;
}

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
<br>
<a href="1.php" class="btn_01">
  <span class="vertical-text">戻る</span>
</a>

</body>

</html>