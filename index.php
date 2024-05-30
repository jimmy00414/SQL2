<?php
include_once "db.php"; // 引入 db.php 文件，如果已經引入則不再引入。通常這個文件包含資料庫連接和相關函式。
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設置視窗大小，確保在不同裝置上有良好的顯示效果 -->
    <title>自訂函式</title>
</head>

<body>
    <?php

    dd(all('students', " WHERE `id`<5")); // 呼叫 `all` 函式查詢 `students` 表中 `id` 小於 5 的所有記錄，並用 `dd` 函式顯示結果。
    dd(find(3)); // 呼叫 `find` 函式查詢 `id` 為 3 的記錄，並用 `dd` 函式顯示結果。

    ?>
</body>

</html>