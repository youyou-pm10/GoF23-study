<?php
/*
GoF23-study : Decorator
This is a example.
*/
class Transform{
    private $file;
    public function __construct($file)
    {
        $this->file = $file;
    }
    public function decorator(){
        return $this->file;
}
}
class Pdf extends Transform{
    private $tmp;
    public function __construct($obj)
    {
        $this->file = $obj->decorator();
    }
    public function decorator(){
        return $this->tmp = $this->file."\n（转为pdf格式）";
}
}
class Title extends Transform{
    private $tmp;
    public function __construct($obj)
    {
        $this->file = $obj->decorator();
    }
    public function decorator(){
        return $this->tmp = $this->file."\n（添加标题）";
    }
}
$result = new Title(new Pdf(new Transform('独立宣言.docx')));
echo $result->decorator();