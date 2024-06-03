<?php

// 定義一個DB類，負責與資料庫交互
class DB
{
    // 定義資料源名稱（DSN），包含資料庫連接資訊
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    // PDO實例，用於資料庫連接
    protected $pdo;
    // 當前操作的資料表名稱
    protected $table;

    // 構造函數，初始化資料表名稱並建立資料庫連接
    public function __construct($table)
    {
        // 建立PDO連接
        $this->pdo = new PDO($this->dsn, 'root', '');
        // 設置操作的資料表名稱
        $this->table = $table;
    }

    // 獲取資料表中的所有記錄，支持可選的條件參數
    public function all(...$arg)
    {
        // 基本的SELECT語句
        $sql = "select * from $this->table ";
        // 使用select方法處理可選參數
        $sql = $this->select($sql, ...$arg);
        //echo $sql;
        // 執行查詢並返回結果
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 根據ID或條件查找特定記錄
    function find($arg)
    {
        // 基本的SELECT語句，帶WHERE子句
        $sql = "SELECT * FROM `{$this->table}` WHERE ";

        // 如果參數是陣列，轉換為SQL條件
        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            $sql .= join(" && ", $tmp);
        } else {
            // 如果參數不是陣列，假設其為ID
            $sql .= " `id`='{$arg}'";
        }

        // 調試輸出SQL語句
        echo $sql;

        // 執行查詢並返回單條記錄
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // 保存記錄（插入或更新）
    function save($array)
    {
        if (isset($array['id'])) {
            // 更新記錄
            $sql = "UPDATE `{$this->table}` SET ";
            $tmp = $this->array2sql($array);
            $sql .= join(",", $tmp);
            $sql .= " WHERE `id`='{$array['id']}'";
        } else {
            // 插入新記錄
            $sql = "INSERT INTO `{$this->table}` ";
            $sql .= "(`" . join("`,`", array_keys($array)) . "`)";
            $sql .= " VALUES('" . join("','", $array) . "')";
        }
        // 調試輸出SQL語句
        echo $sql;
        // 執行SQL語句
        return $this->pdo->exec($sql);
    }

    // 刪除記錄
    function del($arg)
    {
        // 基本的DELETE語句
        $sql = "DELETE FROM `{$this->table}` WHERE ";

        // 如果參數是陣列，轉換為SQL條件
        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            $sql .= join(" && ", $tmp);
        } else {
            // 如果參數不是陣列，假設其為ID
            $sql .= " `id`='{$arg}'";
        }

        // 執行SQL語句
        return $this->pdo->exec($sql);
    }

    // 計算資料表中某列的數學函數結果
    function math($math, $col, ...$arg)
    {
        // 基本的SELECT語句，帶數學函數
        $sql = "SELECT $math(`$col`) FROM `{$this->table}`";
        // 使用select方法處理可選參數
        $sql = $this->select($sql, ...$arg);
        //echo $sql;
        // 執行查詢並返回單個結果
        return $this->pdo->query($sql)->fetchColumn();
    }

    // 計算資料表中的記錄數
    function count(...$arg)
    {
        // 基本的SELECT COUNT語句
        $sql = "SELECT COUNT(*) FROM `{$this->table}`";
        // 使用select方法處理可選參數
        $sql = $this->select($sql, ...$arg);
        // 執行查詢並返回單個結果
        return $this->pdo->query($sql)->fetchColumn();
    }

    // 將陣列轉換為SQL條件語句
    protected  function array2sql($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    // 將可選參數應用到SQL查詢語句
    protected function select($sql, ...$arg)
    {
        // 如果有條件參數且為陣列，轉換為SQL條件
        if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg[0]);
            $sql = $sql . " where " . implode(" && ", $tmp);
        }

        // 如果有額外參數，附加到SQL語句
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }

        return $sql;
    }

    // 執行原始SQL查詢並返回所有結果
    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll();
    }
}


/**
 * 在頁面上快速顯示陣列內容
 * direct dump
 * @param $array 輸入的參數需為陣列
 */
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// 創建DB類的實例，用於操作students資料表
$Student = new DB('students');
// 創建DB類的實例，用於操作dept資料表
$Dept = new DB('dept');
/* 測試代碼
$dept = $Dept->find(2);
$dept['name'] = '電子商務系';
$Dept->save($dept);
*/

// 獲取dept=2的學生數量
echo $Student->count(['dept' => 2]);
echo "<br>";
// 獲取graduate_at列的最大值
echo $Student->math('max', 'graduate_at');
