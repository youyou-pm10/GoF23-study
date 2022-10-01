<?php
/*
GoF23-study : Factory
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
//----当我加入新功能----
interface arena{
    public function fight();
}
class airplane implements arena{
    public function fight()
    {
        echo '飞机上不准决斗';
    }
}
class ocean implements arena{
    public function fight()
    {
        echo '潜水后准许决斗';
    }
}
//-------------------
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
//----当我加入新功能----
class duel implements street{
    public function look($somewhere)
    {
        return new $somewhere();
    }
    public function enter($somewhere)
    {
        return $this->look($somewhere)->fight();
    }
}
//-------------------
class choose{
    public static function action($type){
        return new $type();
    }
}
$people = choose::action('shopping');
$people->enter('swordShop');
//----当我加入新功能----
$people = choose::action('duel');
$people->enter('ocean');
//-------------------