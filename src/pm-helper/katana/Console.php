<?php

namespace pocketmine\katana;

use pocketmine\utils\Terminal;


class Console extends KatanaModule
{
    public function init()
    {
        parent::setName("console");
        parent::writeLoaded();
    }

    public function system($text, $level = "info")
    {
        parent::getServer()->getLogger()->{$level}(Terminal::$COLOR_AQUA . "system> " . Terminal::$COLOR_GRAY . $text);
    }

    public function game($text, $level = "info")
    {
        parent::getServer()->getLogger()->{$level}(Terminal::$COLOR_LIGHT_PURPLE . "game> " . Terminal::$COLOR_GRAY . $text);
    }

    public function plugin($text, $level = "info")
    {
        parent::getServer()->getLogger()->{$level}(Terminal::$COLOR_GREEN . "plugin> " . Terminal::$COLOR_GRAY . $text);
    }

    public function katana($text, $level = "info")
    {
        parent::getServer()->getLogger()->{$level}(Terminal::$COLOR_GOLD . "PocketMine-MP> " . Terminal::$COLOR_GRAY . $text);
    }
}
