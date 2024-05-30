<?php

// 建立資料庫連接字串
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";

// 通過PDO建立資料庫連接
$pdo = new PDO($dsn, 'root', '');

// 取得指定條件下的所有資料
function all($table, $where)
{
    global $pdo;
    // 準備 SQL 查詢字串，使用佔位符避免 SQL 注入攻擊
    $sql = "SELECT * FROM `{$table}` {$where}";
    // 使用 PDO 物件執行 SQL 查詢，並將結果以關聯陣列的形式返回
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return $rows;
}

// 根據指定條件尋找單一資料
function find($table, $arg)
{
    global $pdo;

    $sql = "SELECT * FROM `{$table}` WHERE ";

    if (is_array($arg)) {
        // 如果條件是陣列，轉換成 SQL 條件語句
        $tmp = array2sql($arg);
        // 將多個條件用 AND 連接起來
        $sql .= join(" && ", $tmp);
    } else {
        // 如果條件是單一值（通常是 ID），直接使用 WHERE 條件
        $sql .= " `id`='{$arg}'";
    }

    // 執行 SQL 查詢並返回第一筆結果（單一資料）
    $row = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    return $row;
}

// 儲存或更新資料到資料庫
function save($table, $array)
{

    if (isset($array['id'])) {
        // 如果資料中有 ID，表示要更新既有資料
        update($table, $array, $array['id']);
    } else {
        // 如果資料中沒有 ID，表示要插入新資料
        insert($table, $array);
    }
}

// 更新資料庫中的資料
function update($table, $cols, $arg)
{
    global $pdo;

    $sql = "UPDATE `{$table}` SET ";

    $tmp = array2sql($cols);

    $sql .= join(",", $tmp);

    if (is_array($arg)) {
        // 如果條件是陣列，轉換成 SQL 條件語句
        $tt = array2sql($arg);
        // 將多個條件用 AND 連接起來
        $sql .= " WHERE " . join(" && ", $tt);
    } else {
        // 如果條件是單一值（通常是 ID），直接使用 WHERE 條件
        $sql .= " WHERE `id`='{$arg}'";
    }

    // 執行 SQL 更新操作並返回受影響的行數
    return $pdo->exec($sql);
}

// 插入資料到資料庫
function insert($table, $cols)
{
    global $pdo;

    $sql = "INSERT INTO `{$table}` ";

    $sql .= "(`" . join("`,`", array_keys($cols)) . "`)";

    $sql .= " VALUES('" . join("','", $cols) . "')";

    // 執行 SQL 插入操作並返回受影響的行數
    return $pdo->exec($sql);
}

// 刪除資料庫中的資料
function del($table, $arg)
{
    global $pdo;

    $sql = "DELETE FROM `{$table}` WHERE ";

    if (is_array($arg)) {
        // 如果條件是陣列，轉換成 SQL 條件語句
        $tmp = array2sql($arg);
        // 將多個條件用 AND 連接起來
        $sql .= join(" && ", $tmp);
    } else {
        // 如果條件是單一值（通常是 ID），直接使用 WHERE 條件
        $sql .= " `id`='{$arg}'";
    }

    // 執行 SQL 刪除操作並返回受影響的行數
    return $pdo->exec($sql);
}

// 將陣列轉換成 SQL 條件語句
function array2sql($array)
{
    foreach ($array as $key => $value) {
        $tmp[] = "`$key`='$value'";
    }

    return $tmp;
}

// 執行任意 SQL 查詢並返回結果
function q($sql)
{
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

// 在網頁上顯示陣列內容（用於測試）
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
