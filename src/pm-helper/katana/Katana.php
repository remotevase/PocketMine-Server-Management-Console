<?php


namespace pm-helper\katana;

use pm-helper\Server;
use pocketmine\utils\Terminal;


class Katana
{
    private $logger;
    	
    public function getLogger(){
		return $this->logger;
	}
    public function __construct($server)
    {
        $this->server = $server;
        $this->logger = $this->getLogger();

$this->logger->info(Terminal::$COLOR_GOLD . "------------------------------------------------------------------------------------ ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "    ____  _    _" . Terminal::$COLOR_PURPLE . "      _    _ ____   " . Terminal::$COLOR_GOLD . " | ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   /  __\| \__/| . Terminal::$COLOR_PURPLE . "     / \__/|/  __\   " . Terminal::$COLOR_GOLD . "| ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   |  \/|| |\/||" . Terminal::$COLOR_GOLD . " ___ " . Terminal::$COLOR_PURPLE . " | |\/|||  \/|  " . Terminal::$COLOR_GOLD . " | ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   |  __/| |  || " . Terminal::$COLOR_GOLD . "\__\ " . Terminal::$COLOR_PURPLE . "| |  |||  __/   " . Terminal::$COLOR_GOLD . "| ");
$this->logger->info(Terminal::$COLOR_GOLD . "|" . Terminal::$COLOR_AQUA . "   \_/   \_/  \| " . Terminal::$COLOR_PURPLE . "    \_/  \|\_/      " . Terminal::$COLOR_GOLD . "| ");
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
