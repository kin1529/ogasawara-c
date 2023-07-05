<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="9-1.css">
    <title>シフト登録</title>
</head>

<body>
    <form action="9-1.php" method="post">
        <h2 style="text-align:left">シフト作成・登録</h2>

        <?php
        // データベース接続設定
        require_once("db.php");

        // ログインしたユーザーの名前を表示
        session_start();
        if (isset($_SESSION["name"])) {
            $name = $_SESSION["name"];
            echo "<p style='text-align:center'>ログインユーザー：$name</p>";
        } else {
            // ログインしていない場合はログイン画面にリダイレクト
            header("Location: 6.php");
            exit;
        }

        // シフトデータ（仮のデータ）
        $shift_data = [];

        // バイトID、名前、電話番号、時給のデータをデータベースから取得
        $stmt = $db->query("SELECT * FROM arubaito_table WHERE 名前 = '$name'");
        $staff_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // シフト情報をデータベースから取得
        $stmt = $db->query("SELECT * FROM sihuto_table");
        $shift_data_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // シフト情報をstaff_idとdateをキーにして配列に整形する
        foreach ($shift_data_db as $shift) {
            $staff_id = $shift['バイトID'];
            $date = $shift['日付'];
            $start_time = $shift['開始'];
            $end_time = $shift['終了'];
            $shift_data[$staff_id][$date]['start_time'] = $start_time;
            $shift_data[$staff_id][$date]['end_time'] = $end_time;
        }

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
        echo "<a href='?date={$prev_start_date->format('Y-m-d')}' >前の2週間</a> | ";

        // 次の2週間へのリンクを表示します
        echo "<a href='?date={$next_start_date->format('Y-m-d')}' >次の2週間</a>";

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
        foreach ($staff_data as $staff) {
            $id = $staff['バイトID'];
            $name = $staff['名前'];

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
                $start_time_html .= "<option value='---'>--</option>";

                // 開始時間の選択肢を生成します（9時から22時まで）
                for ($hour = 9; $hour <= 22; $hour++) {
                    $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
                    $selected = '';
                    if (isset($shift_data[$id][$date]['start_time']) && $shift_data[$id][$date]['start_time'] === $time) {
                        $selected = 'selected';
                    }
                    $start_time_html .= "<option value='$time' $selected>$time</option>";
                }

                $start_time_html .= "</select>";

                // シフト情報の終了時間のセレクトボックスの生成
                $end_time_name = "shift[$id][$date][end_time]";
                $end_time_id = "end_time_$id" . "_" . $current_date->format('Ymd');
                $end_time_html = "<select name='$end_time_name' id='$end_time_id'>";
                $end_time_html .= "<option value='---'>--</option>";

                // 終了時間の選択肢を生成します（10時から23時まで）
                for ($hour = 10; $hour <= 23; $hour++) {
                    $time = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
                    $selected = '';
                    if (isset($shift_data[$id][$date]['end_time']) && $shift_data[$id][$date]['end_time'] === $time) {
                        $selected = 'selected';
                    }
                    $end_time_html .= "<option value='$time' $selected>$time</option>";
                }

                $end_time_html .= "</select>";

                echo "<td style='border: 1px solid black;'>$start_time_html - $end_time_html</td>";

                $current_date->add(new DateInterval('P1D'));
            }

            echo "</tr>";
        }

        echo "</table>";

        // 送信ボタンを表示します
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<input type='submit' value='登録' class='btn_01'>";
        echo "</div>";
        ?>
        

    </form>
    <a href="11.php" class="btn_01">確認</a>
</body>

</html>
