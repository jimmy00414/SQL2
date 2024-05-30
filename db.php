<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=school"; // 設置資料庫連接字串，指定資料庫為 'school'，使用 utf8 編碼。
$pdo = new PDO($dsn, 'root', ''); // 使用 PDO 創建到 MySQL 資料庫的連接，使用者為 'root'，密碼為空。

function all($table, $where) // 定義函式 'all'，用於查詢指定條件的所有記錄。
{
    global $pdo; // 使用全局變量 $pdo 來進行資料庫操作。
    $sql = "SELECT * FROM `{$table}` {$where}"; // 構建 SQL 查詢語句，從指定表中選擇所有符合條件的記錄。
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // 執行查詢並以關聯數組形式獲取所有結果。

    return $rows; // 返回查詢結果。
}

function find($id) // 定義函式 'find'，用於查詢指定 id 的記錄。
{
    global $pdo; // 使用全局變量 $pdo 來進行資料庫操作。
    $sql = "SELECT * FROM `dept` WHERE `id`='{$id}'"; // 構建 SQL 查詢語句，從 'dept' 表中選擇指定 id 的記錄。
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC); // 執行查詢並以關聯數組形式獲取單一結果。

    return $row; // 返回查詢結果。
}

/**
 * 在頁面上快速顯示陣列內容
 * direct dump
 * @param $array 輸入的參數需為陣列
 */

function dd($array) // 定義函式 'dd'，用於格式化輸出陣列內容，通常用於調試。
{
    echo "<pre>"; // 開啟 HTML 預格式化文本標籤。
    print_r($array); // 輸出陣列內容。
    echo "</pre>"; // 關閉 HTML 預格式化文本標籤。
}
