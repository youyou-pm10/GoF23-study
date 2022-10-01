<?php
/*
GoF23-study : Singleton
This is a example.
*/
class roles{
    private $HP;
    protected static $Instance = Null;
    final protected function __construct(){
        //禁止随意创建对象
    }
    final protected function __clone(){
        //禁止克隆
    }
    protected static function getInstance(){
        if(self::$Instance === Null){
            return self::$Instance = new roles();
        }
        return self::$Instance;
    }
    public function attack(){
        return $this->HP = $this->HP - 100;
    }
    public function setHP($HP){
        $this->HP = $HP;
    }
}
class player extends roles{

    public static function getInstance()
    {
        return parent::getInstance();
    }
}
class monster extends roles{
    public static function getInstance()
    {
        return new monster();
    }
}
$a = player::getInstance();
$b = player::getInstance();
if($a===$b){
    echo $a->attack();
    $a->setHP(5000);
    echo $b->attack();
};
/*
//玩家只有一个，怪物有很多
$m = monster::getInstance();
$m->setHP(1000);
$p = monster::getInstance();
    echo $m->attack();
    echo $p->attack();
*/