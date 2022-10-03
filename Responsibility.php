<?php
/*
GoF23-study : Responsibility
This is a example.
*/
abstract class Exanmine{
    private $sir;
    public function setSir($sir){
        $this->sir = $sir;
    }
    protected function askSir($target){
        if($this->sir != Null){
            $this->sir->action($target);
        }else{
            echo '很安全呢，开心:)';
        }
    }
    abstract public function action($target);
}
class Username extends Exanmine{
    public function action($target)
    {
        if(preg_match('/[^a-z0-9]/i', $target)){
            echo '用户名非法！';
        }else{
            $this->askSir($target);
        }
    }
}
class Password extends Exanmine{
    public function action($target)
    {
        if(strlen($target) < 8){
            echo '密码不安全！';
        }else{
            $this->askSir($target);
        }
    }
}
//添加新功能
class Verification extends Exanmine{
    public function action($target)
    {
        if(strlen($target) > 12){
            echo '太长了，啊喂';
        }else{
            $this->askSir($target);
        }
    }
}
$username = new Username();
$password = new Password();
$username->setSir($password);
//增加新功能后
$code = new Verification();
$password->setSir($code);
//上面都是插入的
$username->action('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
