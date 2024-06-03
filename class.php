<?php

// 定義一個Animal類，表示一個動物
class Animal
{
    // 公共屬性name，預設值為'animal'
    public $name = 'animal';
    // 保護屬性age，預設值為12
    protected $age = 12;
    // 私有屬性weight，預設值為20
    private $weight = 20;

    // 構造函數，接受一個參數用來設置name屬性
    public function __construct($name)
    {
        // 將參數name賦值給當前物件的name屬性
        $this->name = $name;
    }

    // 公共方法run，輸出動物在奔跑的信息
    public function run()
    {
        // 輸出動物的名稱
        echo $this->name;
        // 輸出正在奔跑的信息
        echo " is running";
    }

    // 私有方法speed，返回字串'high speed'
    private function speed()
    {
        return 'high speed';
    }
}

// 定義一個Cat類，繼承自Animal類
class Cat extends Animal
{
    // 公共屬性name，預設值為'cat'
    public $name = 'cat';

    // 公共方法run，覆蓋父類的run方法
    public function run()
    {
        // 輸出cat is running
        echo "cat is running";
        // 嘗試調用私有方法speed，這裡會報錯，因為父類的私有方法不能被子類直接調用
        echo $this->speed();
        // 輸出保護屬性age，這裡是可以的，因為子類可以訪問父類的保護屬性
        echo $this->age;
    }

    // 私有方法speed，覆蓋父類的speed方法，返回字串'low speed'
    private function speed()
    {
        return 'low speed';
    }
}

// 創建一個Animal物件，名為$ani，名稱為'john'
$ani = new Animal('john');
// 調用$ani的run方法，輸出'john is running'
$ani->run();

// 創建另一個Animal物件，名為$dog，名稱為'Tom'
$dog = new Animal("Tom");
// 調用$dog的run方法，輸出'Tom is running'
$dog->run();

/* 創建一個Cat物件，名為$cat，並調用其方法
$cat = new Cat();
echo $cat->name; // 輸出'cat'
echo $cat->run(); // 會報錯，因為調用了私有方法speed
*/

//echo $cat->speed(); // 會報錯，因為speed是私有方法
//echo $cat->weight; // 會報錯，因為weight是私有屬性
