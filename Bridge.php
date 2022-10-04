<?php
/*
GoF23-study : Bridege
This is a example.
*/
interface CommonHurt{
    public function getValue($hurt, $resistance);
}
class MagicHurt implements CommonHurt{
    public function getValue($hurt, $resistance)
    {
        return $hurt-$resistance;
    }
}
class PhysicsHurt implements CommonHurt{
    public function getValue($hurt, $resistance)
    {
        return $hurt-$resistance*$resistance;
    }
}
abstract class Hurt{
    protected $common;
    private $handler;
    public function __construct($value, $hurt, $resistance){
        $this->handler = $value;
        $this->common = $this->handler->getValue($hurt, $resistance);
    }
    abstract public function specialHurt($value);
}
class NoneSpecial extends Hurt{
    public function specialHurt($value)
    {
        return $this->common;
    }
}
class Dodge extends Hurt{
    public function specialHurt($value)
    {
        $random = mt_rand(0,100);
        if($random < $value){
            return 0;
        }else{
            return $this->common;
        }
    }
}
class Buff extends Hurt{
    public function specialHurt($value)
    {
        return floor($this->common / (100 - $value));
    }
}
class Recovery extends Hurt{
    public function specialHurt($value)
    {
        return $this->common - $value;
    }
}

//取特殊攻击伤害最小值，不重复计算，保证游戏平衡
class Sum{
    private $result=array();
    public function __construct($hurt, $arr_special, $arr_common){
        foreach ($arr_special as $key => $value){
            foreach($arr_common as $resistance => $item){
                $result = new $key(new $resistance, $hurt, $item);
                array_push($this->result, $result->specialHurt($value));
            }
        }
    }
    public function compare(){
        $tmp = 0;
        $arr = $this->result;
        for($i=0;$i<sizeof($arr);$i++){
            if($arr[$i] >= $tmp && $arr[$i] >= 0){
                $tmp = $arr[$i];
            }
        }
        return $tmp;
    }
}
//$sum = new Dodge(new MagicHurt(),1000,200);
//echo $sum->specialHurt(1);
$arr_special = array('NoneSpecial'=>0, 'Dodge'=>5, 'Recovery'=>300, 'Buff'=>15);
$arr_common = array('MagicHurt'=>400,'PhysicsHurt'=>150);
$sum = new sum(1000, $arr_special, $arr_common);
echo $sum->compare();