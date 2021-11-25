<?php

namespace KazushiGame;

use KazushiGame\Player;
use KazushiGame\Enemy;

require_once("Player.php");
require_once("Enemy.php");

class Systems
{
    public function start()
    {
        echo "和志ゲームへようこそ!" . PHP_EOL;
    }

    public function create_character()
    {
        echo "キャラクターを作成します。" . PHP_EOL;
        echo "職業を番号で選んでください。" . PHP_EOL;
        echo "1. ハンター" . PHP_EOL;
        echo "2. レンジャー" . PHP_EOL;
        echo "3. フォース" . PHP_EOL;
        $number_of_job = trim(fgets(STDIN));
        if ($number_of_job === "1") {
            $player = new Player("ハンター", 1, 10, 10, 7, 4, 1);
        } elseif ($number_of_job === "2") {
            $player = new Player("レンジャー", 1, 10, 10, 5, 4, 2);
        } elseif ($number_of_job === "3") {
            $player = new Player("フォース", 1, 10, 5, 10, 4, 4);
        } else {
            $this->invalid_value();
            exit;
        }
        echo "キャラクター名を入力してください。" . PHP_EOL;
        $name = trim(fgets(STDIN));
        $player->set_name($name);
        echo "" . PHP_EOL;
        echo "ステータスは以下の通り。" . PHP_EOL;
        $player->show_status();
        return $player;
    }

    public function pop_up_enemy($level, $number_of_menu)
    {
        echo "敵が現れました。" . PHP_EOL;
        if ($number_of_menu === "1") {
            $enemy = new Enemy("ザコ", $level);
        } elseif ($number_of_menu === "2") {
            $level += 3;
            $enemy = new Enemy("強敵", $level);
        } elseif ($number_of_menu === "3") {
            $level += 5;
            $enemy = new Enemy("ボス", $level);
        }
        $enemy->show_status();
        return $enemy;
    }

    public function game_menu()
    {
        echo "以下のいずれかの番号を選択してください。" . PHP_EOL;
        echo "1. ザコを倒しに行く。" . PHP_EOL;
        echo "2. 強敵を倒しに行く。" . PHP_EOL;
        echo "3. ボスを倒しに行く。" . PHP_EOL;
        echo "4. ゲームを終了する。" . PHP_EOL;
        $number_of_menu = trim(fgets(STDIN));
        return $number_of_menu;
    }

    public function invalid_value()
    {
        echo "無効な値です。" . PHP_EOL;
    }
}
