<?php

namespace KazushiGame;

class Battle
{
    private static $turn = [];

    public static function set_turn($turn)
    {
        self::$turn[] = $turn;
    }

    public static function get_turn()
    {
        return self::$turn;
    }

    public static function start()
    {
        echo "バトルスタート!" . PHP_EOL;
    }

    public static function show_turn()
    {
        echo "ターン数 : " . (count(self::$turn) + 1) . PHP_EOL;
    }

    public static function select_action() {
        echo "以下のいずれかの番号を選択してください。" . PHP_EOL;
        echo "1. 攻撃する" . PHP_EOL;
        echo "2. 防御する" . PHP_EOL;
        echo "3. ためる" . PHP_EOL;
        echo "4. 魔法を発動する" . PHP_EOL;
        if ((count(self::$turn) + 1) % 5 === 0) {
            echo "5. 必殺技を発動する" . PHP_EOL;
        }
        $number = trim(fgets(STDIN));
        return $number;
    }

    public static function attack($active, $passive, $rate)
    {
        echo $active->get_name() . "の攻撃" . PHP_EOL;
        if (($active->get_atk() - $passive->get_def()) > 0) {
            $damage = $active->get_atk() * $rate - $passive->get_def();
        } else {
            $damage = 0;
        }
        echo $passive->get_name() . "に" . $damage . "のダメージを与えた。" . PHP_EOL;
        $remaining_hp = $passive->get_hp() - $damage;
        $passive->set_hp($remaining_hp);
        if ($passive->get_hp() > 0) {
            echo $passive->get_name() . "のHPは残り" . $passive->get_hp() . "です。" . PHP_EOL;
        } else {
            $passive->set_hp(0);
            echo $passive->get_name() . "のHPは残り0です" . PHP_EOL;
        }
    }

    public static function magic($active, $passive, $rate)
    {
        echo $active->get_name() . "の魔法" . PHP_EOL;
        $damage = $active->get_mind() * $rate;
        echo $passive->get_name() . "に" . $damage . "のダメージを与えた。" . PHP_EOL;
        $remaining_hp = $passive->get_hp() - $damage;
        $passive->set_hp($remaining_hp);
        if ($passive->get_hp() > 0) {
            echo $passive->get_name() . "のHPは残り" . $passive->get_hp() . "です。" . PHP_EOL;
        } else {
            $passive->set_hp(0);
            echo $passive->get_name() . "のHPは残り0です" . PHP_EOL;
        }
    }

    public static function guard($active)
    {
        echo $active->get_name() . "はガードした。" . PHP_EOL;
        $guard = $active->get_def() * 3;
        $active->set_def($guard);
        echo "防御力が一時的に3倍になった。防御力 : " . $active->get_def() . PHP_EOL;
    }

    public static function cancelGuard($active)
    {
        $cancelGuard = $active->get_def() / 3;
        $active->set_def($cancelGuard);
        echo $active->get_name() . "の防御力が" . $active->get_def() . "に戻った。" . PHP_EOL;
    }

    public static function accumulate($active)
    {
        echo $active->get_name() . "はためるを発動。" . PHP_EOL;
        $accumulate = $active->get_atk() * 3;
        $active->set_atk($accumulate);
        echo "攻撃力が一時的に3倍になった。攻撃力 : " . $active->get_atk() . PHP_EOL;
    }

    public static function cancelAccumulate($active)
    {
        $cancelAccumulate = $active->get_atk() / 3;
        $active->set_atk($cancelAccumulate);
        echo $active->get_name() . "の攻撃力が" . $active->get_atk() . "に戻った。" . PHP_EOL;
    }

    public static function show_special_attack_gauge()
    {
        if ((count(self::$turn) + 1) % 5 === 0) {
            echo "必殺技ゲージ : 5/5" . PHP_EOL;
        } else {
            echo "必殺技ゲージ : " . (count(self::$turn) + 1) % 5 . "/5" . PHP_EOL;
        }
    }

    public static function special_attack($active, $passive)
    {
        echo $active->get_name() . "は必殺技を発動!" . PHP_EOL;
        if ($active->get_job() === "ハンター") {
            self::attack($active, $passive, 5);

        } elseif ($active->get_job() === "レンジャー") {
            echo $active->get_name() . "の攻撃" . PHP_EOL;
            if (($active->get_atk() - $passive->get_def()) > 0) {
                $attack_damage = $active->get_atk() * 3 - $passive->get_def();
            } else {
                $attack_damage = 0;
            }
            $magic_damage = $active->get_mind() * 3;
            $damage = $attack_damage + $magic_damage;
            echo $passive->get_name() . "に" . $damage . "のダメージを与えた。" . PHP_EOL;
            $remaining_hp = $passive->get_hp() - $damage;
            $passive->set_hp($remaining_hp);
            if ($passive->get_hp() > 0) {
                echo $passive->get_name() . "のHPは残り" . $passive->get_hp() . "です。" . PHP_EOL;
            } else {
                $passive->set_hp(0);
                echo $passive->get_name() . "のHPは残り0です。" . PHP_EOL;
            }

        } elseif ($active->get_job() === "フォース") {
            self::magic($active, $passive, 5);
        }
    }

    public static function win($player, $enemy)
    {
        $exp = $player->get_exp() - $enemy->get_exp();
        $player->set_exp($exp);
        if ($player->get_exp() <= 0) {
            $player->levelUp();
        }
    }

    public static function lose($player)
    {
        echo $player->get_name() . "のHPが0になりました。" . PHP_EOL;
        echo "ゲームオーバー!" . PHP_EOL;
        echo "4を入力し、ゲームを終了してください。" . PHP_EOL;
    }
}
