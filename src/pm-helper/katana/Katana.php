<?php


namespace pm-helper\katana;

use pm-helper\Terminal;


class Katana
{
    private $logger;
	
    public function __construct($server)
    {
        $this->server = $server;
        $this->logger = $this->getLogger();

$this->logger->info(Terminal::$COLOR_GOLD . "--------------------------------" . Terminal::$COLOR_BLUE . "PocketMine Helper" . Terminal::$COLOR_GOLD . "-------------------------------- ");
$this->logger->info(Terminal::$COLOR_GREEN . "This tool is perfect for beginners who want some help running a server! It has a simple interface that is free to use! \n Click on one of the links below to get started!");    
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
