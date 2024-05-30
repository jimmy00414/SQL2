<?php

echo sum(10, 25); // 呼叫 sum 函式並顯示結果

function sum(...$args)
{
    $sum = 0; // 初始化總和變數
    foreach ($args as $arg) {
        $sum += $arg; // 將每個參數加到總和中
    }
    return $sum; // 返回計算後的總和
}


/**
 * 在頁面上快速顯示陣列內容
 * direct dump
 * @param $array 輸入的參數需為陣列
 */
function dd($array)
{
    echo "<pre>"; // 開啟 HTML 預格式化文本標籤，便於更清晰地顯示陣列結構
    print_r($array); // 使用 print_r 函數輸出陣列的結構和內容
    echo "</pre>"; // 關閉 HTML 預格式化文本標籤
}

/**
 * 使用迴圈來畫星星
 * @param $shape 形狀名,字串
 * @param $stars 星星的大小,數值
 */
function stars($shape = '正三角形', $stars = 7)
{
    switch ($shape) { // 根據 $shape 參數的值選擇不同的圖形畫星星
        case "正三角形":
        case 'equilateral triangle': // 當 $shape 是 "正三角形" 或 "equilateral triangle" 時，畫一個正三角形
            for ($i = 0; $i < $stars; $i++) { // 外層迴圈控制行數
                for ($k = 0; $k < $stars - 1 - $i; $k++) { // 在每行開始前輸出空白，形成三角形左側的空間
                    echo "&nbsp;";
                }

                for ($j = 0; $j < $i * 2 + 1; $j++) { // 在每行中輸出星星
                    echo "*";
                }
                echo "<br>"; // 每行結束後換行
            }
            break;
        case '菱形':
        case 3: // 當 $shape 是 "菱形" 或 3 時，畫一個菱形
            $odd = ($stars % 2 == 0) ? $stars + 1 : $stars; // 如果 $stars 是偶數，將其變為奇數，保證菱形的對稱性
            $mid = (($odd + 1) / 2) - 1; // 計算菱形的中間行數
            $tmp = 0; // 暫存變量，用於控制星星的數量
            for ($i = 0; $i < $stars; $i++) { // 外層迴圈控制行數
                if ($i <= $mid) {
                    $tmp = $i; // 遞增部分
                } else {
                    $tmp = $tmp - 1; // 遞減部分
                }
                for ($k = 0; $k < $mid - $tmp; $k++) { // 在每行開始前輸出空白，形成菱形的對稱性
                    echo "&nbsp;";
                }
                for ($j = 0; $j < $tmp * 2 + 1; $j++) { // 在每行中輸出星星
                    echo "*";
                }
                echo "<br>"; // 每行結束後換行
            }
            break;
        case '矩形'; // 當 $shape 是 "矩形" 時，畫一個矩形
            for ($i = 0; $i < $stars; $i++) { // 外層迴圈控制行數
                for ($j = 0; $j < $stars; $j++) { // 內層迴圈控制每行中的列數
                    if ($i == 0 || $i == $stars - 1) { // 第一行和最後一行，全部輸出星星
                        echo "*";
                    } else if ($j == 0 || $j == $stars - 1) { // 其他行的第一列和最後一列，輸出星星
                        echo "*";
                    } else {
                        echo "&nbsp;"; // 其他位置輸出空白
                    }
                }
                echo "<br>"; // 每行結束後換行
            }
            break;
    }
}
