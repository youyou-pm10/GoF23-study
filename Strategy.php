<?php
/*
GoF23-study : Strategy
This is a example.
*/
interface shop{
    public function showUI();
    public function product();
}
class swordShop implements shop{
    public function showUI(){
        echo '宝剑[sowrd.jpg]';
    }
    public function product(){
        echo '获得【石中剑】x1';
    }
}
class magicPillShop implements shop{
    public function showUI(){
        echo '魔法药水[magicPill.jpg]';
    }
    public function product(){
        echo '获得【圣水】x1';
    }
}
interface street{
    public function look($somewhere);
    public function enter($somewhere);
}
class shopping implements street{
    public function look($somewhere){
        return new $somewhere();
    }
    public function enter($somewhere){
        return $this->look($somewhere)->product();
    }
}
class dating implements street{
    public function look($somewhere)
    {
        return new $somewhere();
    }
    public function enter($somewhere)
    {
        return $this->look($somewhere)->showUI();
    }
}
class choose{
    private $mode;
    private $act;
    public function __construct($mode)
    {
        $this->mode = new $mode;
    }

    public function action($act, $place){
        $this->mode->$act($place);
    }
}
//与工厂模式很相似，工厂模式返回对象操作，策略模式返回行为结果。
$people = new choose('shopping');
$people->action('enter', 'swordShop');