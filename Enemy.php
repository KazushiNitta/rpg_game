<?php

namespace KazushiGame;

use KazushiGame\Character;

require_once("Character.php");

class Enemy extends Character
{
    public function __construct($name, $level)
    {
        $this->name = $name;
        $this->level = $level;
        $this->exp = $level * 10;
        $this->hp = $level * 5;
        $this->atk = $level * 2;
        $this->def = $level * 2;
        $this->mind = 0;
    }

    public function show_status()
    {
        parent::get_status("経験値 : ");
    }
}
