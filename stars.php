<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>

<?php
include_once "libray.php"; // 引入 'libray.php' 文件，如果已經引入則不再引入。通常這個文件包含一些自定義函式，如 'stars'。
stars('菱形', 21); // 呼叫 'stars' 函式，畫一個大小為 21 的菱形。
stars('正三角形', 17); // 呼叫 'stars' 函式，畫一個大小為 17 的正三角形。
stars('矩形', 10); // 呼叫 'stars' 函式，畫一個大小為 10 的矩形。
?>

