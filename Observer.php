<?php
/*
GoF23-study : Observer
This is a example.
*/
class Headquarters{
    private $order;
    private $units = array();
    public function attack($order){
        $this->order = $order;
        $this->direct($this);
    }
    public function order(){
        return $this->order;
    }
    private function direct($obj){
        foreach($this->units as $unit){
            $unit->fallin($obj);
        }
    }
    public function addUnit($unit){
        array_push($this->units, $unit);
    }
    public function losses($unit){
        array_splice($this->units,array_search($unit, $this->units),1);
    }
}
interface Corps{
    public function fallin($obj);
}
class Army implements Corps{
    public function fallin($obj)
    {
        echo '收到命令：'.$obj->order();
        echo "坦克旅已经朝预定位置移动！\n";
    }
}
class Navy implements Corps{
    public function fallin($obj)
    {
        echo '收到命令：'.$obj->order();
        echo "航母舰队已经靠近目标海域！\n";
    }
}
class Airforce implements Corps{
    public function fallin($obj)
    {
        echo '收到命令：'.$obj->order();
        echo "轰炸机序列即将抵达目标上空！\n";
    }
}
$Headquarters = new Headquarters();
$Headquarters->addUnit(new Army());
$Headquarters->addUnit(new Airforce());
$Headquarters->addUnit(new Navy());
$Headquarters->attack('闪击波兰！');
$Headquarters->losses(new Navy());
$Headquarters->attack('闪击瑞士！');
