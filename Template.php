<?php
/*
GoF23-study : Template
This is a example.
*/
abstract class Decode{
    public $flag = 0;
    public function init($text){
        $text = $this->toStr($text);
        $this->flag = 1;
        $this->str_decode($text);
        $this->flag = 0;
        $this->finish();
    }
    protected function toStr($text){
        if(is_array($text)){
            $tmp = '';
            foreach ($text as $k => $v){
                $tmp .= $k.":".$v.";";
            }
            $text = $tmp;
        }
        return $text;
    }
    protected function finish(){
        echo PHP_EOL,'OK';
    }
    abstract public function str_decode($content);
}
class JsonDecode extends Decode{
    public function str_decode($content){
        echo json_decode($content);
    }
}
class SerializeDecode extends Decode{
    public function str_decode($content)
    {
        echo unserialize($content);
    }
}
class ArrayDecode extends Decode{
    public function str_decode($content)
    {
        echo $content;
    }
}
$handler = new ArrayDecode();
$handler->init(Array('a','b'));