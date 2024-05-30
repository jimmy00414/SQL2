<?php
include_once "db.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自訂函式</title>
</head>

<body>
    <?php

    dd(all('students', " WHERE `id`<5"));
    dd(find('students', ['uni_id' => 'F200000035', 'parents' => '孔進豐']));
    update('students', ['dept' => '2'], ['dept' => '1']);
    //insert('dept', ['code' => '801', 'name' => '綜合演藝學系']);
    //del('dept', ['name' => '綜合演藝學系']);
    ?>
</body>

</html>