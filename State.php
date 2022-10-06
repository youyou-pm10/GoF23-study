<?php
/*
GoF23-study : State
This is a example.
*/
class soldier{
    private $number;
    public function setNumber($obj){
        $this->number = $obj;
    }
    public function oneByOne(){
        $this->number = $this->number->count();
    }
}
interface Count{
    public function count();
}
class One implements Count{
    public function count(){
        echo 1;
        return new Two();
    }
}
class Two implements Count{
    public function count(){
        echo 2;
        return new One();
    }
}
$start = new soldier();
$start->setNumber(new One());
$start->oneByOne();
$start->oneByOne();
$start->oneByOne();
$start->oneByOne();