<?php

namespace KazushiGame;

use KazushiGame\Systems;
use KazushiGame\Battle;

require_once("Systems.php");
require_once("Battle.php");

$systems = new Systems();
$systems->start();
$player = $systems->create_character();

while (true) {
    echo "" . PHP_EOL;
    $number_of_menu = $systems->game_menu();
    if (($number_of_menu === "1") || ($number_of_menu === "2") || ($number_of_menu === "3")) {
        echo "" . PHP_EOL;
        $enemy = $systems->pop_up_enemy($player->get_level(), $number_of_menu);
        echo "" . PHP_EOL;
        $battle = new Battle();
        $battle->start();
        while (true) {
            if ($enemy->get_hp() <= 0) {
                $battle->win($player, $enemy);
                break;
            } elseif ($player->get_hp() <= 0) {
                $battle->lose($player);
                break;
            }

            $battle->show_turn();
            $battle->show_special_attack_gauge();
            $number = $battle->select_action();
            // echo "" . PHP_EOL;
            if ($number === "1") {
                $battle->attack($player, $enemy, 1);
                $turn = $battle->get_turn();
                if (end($turn) === "3") {
                    $battle->cancelAccumulate($player);
                }
                if ($enemy->get_hp() > 0) {
                    $battle->attack($enemy, $player, 1);
                }
                $battle->set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "2") {
                $turn = $battle->get_turn();
                if (end($turn) === "3") {
                    $battle->cancelAccumulate($player);
                }
                $battle->guard($player);
                if ($enemy->get_hp() > 0) {
                    $battle->attack($enemy, $player, 1);
                }
                if ($number === "2") {
                    $battle->cancelGuard($player);
                }
                $battle->set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "3") {
                $turn = $battle->get_turn();
                if (end($turn) === "3") {
                    $battle->cancelAccumulate($player);
                }
                $battle->accumulate($player);
                if ($enemy->get_hp() > 0) {
                    $battle->attack($enemy, $player, 1);
                }
                $battle->set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "4") {
                $turn = $battle->get_turn();
                if (end($turn) === "3") {
                    $battle->cancelAccumulate($player);
                }
                $battle->magic($player, $enemy, 1);
                if ($enemy->get_hp() > 0) {
                    $battle->attack($enemy, $player, 1);
                }
                $battle->set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "5") {
                if ((count($battle->get_turn()) + 1) % 5 === 0) {
                    $turn = $battle->get_turn();
                    if (end($turn) === "3") {
                        $battle->cancelAccumulate($player);
                    }
                    $battle->special_attack($player, $enemy);
                    $battle->set_turn($number);
                    echo "" . PHP_EOL;

                } else {
                    $systems->invalid_value() . PHP_EOL;
                }

            } else {
                $systems->invalid_value();
            }
        }

    } elseif ($number_of_menu === "4") {
        echo "ゲームを終了しました。" . PHP_EOL;
        break;

    } else {
        $systems->invalid_value();
    }
}
