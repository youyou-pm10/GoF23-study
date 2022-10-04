<?php
/*
GoF23-study : Adapter
This is a example.
*/
interface Input{
    public function input($data);
}
class Xml implements Input{
    private $handler;
    public function __construct()
    {
        $this->handler = new SimpleXMLElement('<?xml version="1.0"?><root></root>');
    }

    public function input($data)
    {
        foreach($data as $key => $value){
            $this->handler->$key = $value;
        }
        return $this->handler->asXML();
    }
}
class Json implements Input{
    public function input($data)
    {
        return json_encode($data);
    }
}
class Adapter{
    private $obj;
    public function __construct($obj){
        $this->obj = $obj;
    }
    public function output($data){
        return $this->obj->input($data);
    }
}
interface Client{
    public function output($data);
}
class Client1 implements Client {
    public function output($data){
        return var_dump($data);
    }
}
class Client2 implements Client {
    public function output($data){
        return implode($data);
    }
}
$arr = Array('name'=>'onwer', 'order'=>'attach');
$action = new Client1();
echo $action->output($arr)."\n";
$action = new Client2();
echo $action->output($arr)."\n";
//适配后，输出格式相同
$action = new Adapter(new Json());
echo $action->output($arr)."\n";
$action = new Adapter(new Xml());
echo $action->output($arr)."\n";
