<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<h1>自訂函式</h1>
<?php
include_once "libray.php";

$a = ['A', 'B', 'C', 'D', 'E'];
$b = [
    '姓名' => '劉勤永',
    '學號' => '103001',
    '數學' => '90',
    '國文' => 67,
    '英文' => 56
];

//dd($a);
//dd($b);

stars();
stars('菱形', 11);
stars('矩形', 7);


?>