<?php include_once "base.php"; // 包含base.php檔案，通常用於設置資料庫連接等 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- 設置網頁的字符編碼為UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設置視窗寬度，適應不同設備 -->
    <title>分頁</title> <!-- 網頁標題 -->
</head>

<body>
    <?php
    // 獲取學生資料表中的總記錄數
    $total = $Student->count();
    // 每頁顯示的記錄數
    $div = 20;
    // 計算總頁數
    $pages = ceil($total / $div);
    // 獲取當前頁碼，若未設定則預設為第1頁
    $now = $_GET['p'] ?? 1;
    // 計算查詢數據的起始位置
    $start = ($now - 1) * $div;
    // 獲取當前頁的數據
    $rows = $Student->all([], " limit $start,$div");

    // 輸出當前頁的學生名單
    foreach ($rows as $idx => $row) {
        echo ($idx + 1) . '=>' . $row['name'] . "<br>"; // 顯示學生名字和序號
    }
    ?>
    <hr> <!-- 分隔線 -->

    <?php
    // 輸出上一頁的連結
    if ($now - 1 > 0) {
        echo "<a href='?p=" . ($now - 1) . "'> < </a>"; // 顯示上一頁的連結
    }

    // 輸出所有頁碼的連結
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?p=$i'> $i </a>"; // 顯示所有頁碼的連結
    }

    // 輸出下一頁的連結
    if ($now + 1 <= $pages) {
        echo "<a href='?p=" . ($now + 1) . "'> > </a>"; // 顯示下一頁的連結
    } else {
        echo ' > '; // 若無下一頁則顯示大於符號
    }
    ?>
</body>

</html>