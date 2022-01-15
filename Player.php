<?php

namespace KazushiGame;

use KazushiGame\Character;

require_once("Character.php");

class Player extends Character
{
    private $job;

    public function __construct($job, $level, $exp, $hp, $atk, $def, $mind)
    {
        $this->job = $job;
        parent::__construct($level, $exp, $hp, $atk, $def, $mind);
    }

    public function set_job($job)
    {
        $this->job = $job;
    }

    public function get_job()
    {
        return $this->job;
    }

    public function show_status()
    {
        echo "職業 : " . $this->job . PHP_EOL;
        parent::get_status("次のレベルまで : ");
    }

    public function levelUp()
    {
        echo $this->name . "のレベルが上がりました。" . PHP_EOL;
        $this->level++;
        if ($this->job === "ハンター") {
            $this->exp = 50 + $this->level * 10;
            $this->hp = 5 * $this->level;
            $this->atk += 7;
            $this->def += 4;
            $this->mind += 1;
        } elseif ($this->job === "レンジャー") {
            $this->exp = 50 + $this->level * 10;
            $this->hp = 5 * $this->level;
            $this->atk += 5;
            $this->def += 4;
            $this->mind += 2;
        } elseif ($this->job === "フォース") {
            $this->exp = 50 + $this->level * 10;
            $this->hp = 5 * $this->level;
            $this->atk += 3;
            $this->def += 4;
            $this->mind += 3;
        }
        $this->show_status();
    }
}
