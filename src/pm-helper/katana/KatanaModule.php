<?php



namespace pocketmine\imagical;

use pocketmine\utils\Terminal;



class KatanaModule
{
    private $katana;

    private $name = "";
    public $needsTicking = false;

    public function __construct($katana)
    {
        $this->katana = $katana;
    }

    public function getKatana()
    {
        return $this->katana;
    }

    public function getServer()
    {
        return $this->katana->getServer();
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function writeLoaded()
    {
        $this->getKatana()->console->katana("Loaded " .Terminal::$COLOR_AQUA . $this->name . Terminal::$COLOR_GRAY . " module");
    }
}
