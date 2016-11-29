<?php


namespace pocketmine\katana;

use pocketmine\Server;
use pocketmine\utils\Terminal;


class Katana
{
    /** @var Server */
    private $server;

    public function __construct($server)
    {
        $this->server = $server;
        $this->logger = $this->server->getLogger();

$this->logger->info(Terminal::$COLOR_GOLD . "------------------------------------------------------------------------------------ ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "    ____  ____ _  __ _____ _____ _____ _    _ _         _____" . Terminal::$COLOR_PURPLE . "      _    _ ____   " . Terminal::$COLOR_GOLD . " | ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   /  __\/  _ \/   _Y |/ //  __//__ __| \__/|/ \/ \  /|/  __/" . Terminal::$COLOR_PURPLE . "     / \__/|/  __\   " . Terminal::$COLOR_GOLD . "| ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   |  \/|| / \||  / |   / |  \    / \ | |\/||| || |\ |||  \ " . Terminal::$COLOR_GOLD . " ___ " . Terminal::$COLOR_PURPLE . " | |\/|||  \/|  " . Terminal::$COLOR_GOLD . " | ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   |  __/| \_/||  \_|   \ |  /_   | | | |  ||| || | \|||  /_ " . Terminal::$COLOR_GOLD . "\__\ " . Terminal::$COLOR_PURPLE . "| |  |||  __/   " . Terminal::$COLOR_GOLD . "| ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   \_/   \____/\____|_|\_\|____\  \_/ \_/  \|\_/\_/  \|\____\ " . Terminal::$COLOR_PURPLE . "    \_/  \|\_/      " . Terminal::$COLOR_GOLD . "| ");
$this->logger->info(Terminal::$COLOR_GOLD . "------------------------------------------------------------------------------------ ");
        
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getLogger()
    {
        return $this->logger;
    }
}
