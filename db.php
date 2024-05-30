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


// 簡易一
// function find($id)    // 定義函式 'find'，用於查詢指定 id 的記錄。
// {
//     global $pdo;     // 使用全局變量 $pdo 來進行資料庫操作。
//     $sql = "SELECT * FROM `dept` WHERE `id`='{$id}'";    // 構建 SQL 查詢語句，從 'dept' 表中選擇指定 id 的記錄。
//     $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);   // 執行查詢並以關聯數組形式獲取單一結果。

//     return $row;   // 返回查詢結果。
// }


// 方法二
// function find($table, $arg)
// {
//     global $pdo;           // 使用全局變量 $pdo 來進行資料庫操作。

//     if (is_array($arg)) {              // 如果 $arg 是陣列，則進行複合條件查詢。
//         foreach ($arg as $key => $value) {         // 遍歷 $arg 陣列，將每個鍵值對轉換為 SQL 條件。
//             $tmp[] = "`$key`='{$value}'";        // 將鍵和值轉換為 `key`='value' 的形式，並存入 $tmp 陣列中。
//         }

//         $sql = "SELECT * FROM `{$table}` WHERE " . join(" && ", $tmp);        // 將 $tmp 陣列中的條件用 " && " 連接，生成完整的 SQL 查詢語句。
//     } else { // 如果 $arg 不是陣列，則進行單條件查詢。
//         $sql = "SELECT * FROM `{$table}` WHERE `id`='{$arg}'";       // 生成查詢語句，查詢 id 等於 $arg 的記錄。
//     }

//     //echo $sql; // 可以解除註解以輸出生成的 SQL 查詢語句，用於調試。

//     $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);            // 執行查詢並以關聯數組形式獲取單一結果。

//     return $row;         // 返回查詢結果。
// }


方法三

function find($table, $arg)
{
    global $pdo; // 使用全局變量 $pdo 來進行資料庫操作

    $sql = "SELECT * FROM `{$table}` WHERE ";       // 開始構建 SQL 查詢語句，選取指定表中的所有字段並開始 WHERE 子句

    if (is_array($arg)) { // 如果 $arg 是陣列
        foreach ($arg as $key => $value) {        // 遍歷 $arg 陣列中的每個鍵值對
            $tmp[] = "`$key`='{$value}'";        // 將每個鍵值對轉換為 `key`='value' 的 SQL 條件，並存入 $tmp 陣列中
        }

        $sql .= join(" && ", $tmp);         // 將 $tmp 陣列中的條件用 " && " 連接，並附加到 SQL 語句後面
    } else { // 如果 $arg 不是陣列
        $sql .= " `id`='{$arg}'";           // 構建查詢語句，查詢 id 等於 $arg 的記錄，並附加到 SQL 語句後面
    }

    //echo $sql; // 可以解除註解以輸出生成的 SQL 查詢語句，用於調試

    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);    // 執行查詢並以關聯數組形式獲取單一結果

    return $row;    // 返回查詢結果
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
