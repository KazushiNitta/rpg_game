<?php

namespace KazushiGame;

class Character
{
    protected $name;
    protected $level;
    protected $exp;
    protected $hp;
    protected $atk;
    protected $def;
    protected $mind;

    public function __construct($level, $exp, $hp, $atk, $def, $mind)
    {
        $this->level = $level;
        $this->exp = $exp;
        $this->hp = $hp;
        $this->atk = $atk;
        $this->def = $def;
        $this->mind = $mind;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function set_exp($exp)
    {
        $this->exp = $exp;
    }

    public function set_hp($hp)
    {
        $this->hp = $hp;
    }

    public function set_atk($atk)
    {
        $this->atk = $atk;
    }

    public function set_def($def)
    {
        $this->def = $def;
    }

    public function set_mind($mind)
    {
        $this->mind = $mind;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_level()
    {
        return $this->level;
    }

    public function get_exp()
    {
        return $this->exp;
    }

    public function get_hp()
    {
        return $this->hp;
    }

    public function get_atk()
    {
        return $this->atk;
    }

    public function get_def()
    {
        return $this->def;
    }

    public function get_mind()
    {
        return $this->mind;
    }

    public function get_status($exp)
    {
        echo "名前 : " . $this->name . PHP_EOL;
        echo "レベル : " . $this->level . PHP_EOL;
        echo $exp . $this->exp . PHP_EOL;
        echo "HP : " . $this->hp . PHP_EOL;
        echo "攻撃力 : " . $this->atk . PHP_EOL;
        echo "防御力 : " . $this->def . PHP_EOL;
        echo "魔力 : " . $this->mind . PHP_EOL;
    }
}
