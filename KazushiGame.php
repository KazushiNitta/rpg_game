<?php

namespace KazushiGame;

use KazushiGame\Systems;
use KazushiGame\Battle;

require_once("Systems.php");
require_once("Battle.php");

echo "和志ゲームへようこそ!" . PHP_EOL;
$player = Systems::create_character();

while (true) {
    echo "" . PHP_EOL;
    $number_of_menu = Systems::game_menu();
    if (($number_of_menu === "1") || ($number_of_menu === "2") || ($number_of_menu === "3")) {
        echo "" . PHP_EOL;
        $enemy = Systems::pop_up_enemy($player->get_level(), $number_of_menu);
        echo "" . PHP_EOL;
        Battle::start();
        while (true) {
            if ($enemy->get_hp() <= 0) {
                Battle::win($player, $enemy);
                break;
            } elseif ($player->get_hp() <= 0) {
                Battle::lose($player);
                break;
            }

            Battle::show_turn();
            Battle::show_special_attack_gauge();
            $number = Battle::select_action();
            if ($number === "1") {
                Battle::attack($player, $enemy, 1);
                $turn = Battle::get_turn();
                if (end($turn) === "3") {
                    Battle::cancelAccumulate($player);
                }
                if ($enemy->get_hp() > 0) {
                    Battle::attack($enemy, $player, 1);
                }
                Battle::set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "2") {
                $turn = Battle::get_turn();
                if (end($turn) === "3") {
                    Battle::cancelAccumulate($player);
                }
                Battle::guard($player);
                if ($enemy->get_hp() > 0) {
                    Battle::attack($enemy, $player, 1);
                }
                if ($number === "2") {
                    Battle::cancelGuard($player);
                }
                Battle::set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "3") {
                $turn = Battle::get_turn();
                if (end($turn) === "3") {
                    Battle::cancelAccumulate($player);
                }
                Battle::accumulate($player);
                if ($enemy->get_hp() > 0) {
                    Battle::attack($enemy, $player, 1);
                }
                Battle::set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "4") {
                $turn = Battle::get_turn();
                if (end($turn) === "3") {
                    Battle::cancelAccumulate($player);
                }
                Battle::magic($player, $enemy, 1);
                if ($enemy->get_hp() > 0) {
                    Battle::attack($enemy, $player, 1);
                }
                Battle::set_turn($number);
                echo "" . PHP_EOL;

            } elseif ($number === "5") {
                if ((count(Battle::get_turn()) + 1) % 5 === 0) {
                    $turn = Battle::get_turn();
                    if (end($turn) === "3") {
                        Battle::cancelAccumulate($player);
                    }
                    Battle::special_attack($player, $enemy);
                    Battle::set_turn($number);
                    echo "" . PHP_EOL;

                } else {
                    Systems::invalid_value() . PHP_EOL;
                }

            } else {
                Systems::invalid_value();
            }
        }

    } elseif ($number_of_menu === "4") {
        echo "ゲームを終了しました。" . PHP_EOL;
        break;

    } else {
        Systems::invalid_value();
    }
}
