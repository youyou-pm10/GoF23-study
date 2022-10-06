<?php
/*
GoF23-study : Command
This is a example.
*/
class Admiral{
    private $captains;
    public function __construct($captains)
    {
        $this->captains = $captains;
    }
    public function command(){
        $this->captains->herald();
    }
}
abstract class Weapons{
    protected $soldier;
    public function __construct($soldier)
    {
        $this->soldier = $soldier;
    }
    abstract public function herald();
}
class WeaponsA extends Weapons
{
    public function herald()
    {
        $this->soldier->attach();
    }
}
class WeaponsB extends Weapons
{
    public function herald()
    {
        $this->soldier->fire();
    }
}
class Soldiers{
    public function attach(){
        echo 'go go go！', PHP_EOL;
    }
}
class Tanks{
    public function fire(){
        echo 'boom boom boom!', PHP_EOL;
    }
}
$command1 = new Admiral(new WeaponsA(new Soldiers()));
$command1->command();

$command1 = new Admiral(new WeaponsB(new Tanks()));
$command1->command();