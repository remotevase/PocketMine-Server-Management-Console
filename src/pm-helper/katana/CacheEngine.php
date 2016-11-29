<?php

namespace pocketmine\katana;

use pocketmine\utils\Terminal;


class CacheEngine extends KatanaModule
{
    public $cacheDisk = true;

    public function init()
    {
        parent::setName("cache");
        parent::writeLoaded();

        if (parent::getKatana()->getProperty("caching.save-to-disk", true)) {
            parent::getKatana()->console->katana("Disk caching " . Terminal::$COLOR_GREEN . "enabled");
            if (!file_exists(parent::getServer()->getDataPath() . "chunk_cache/")) {
                mkdir(parent::getServer()->getDataPath() . "chunk_cache/", 0777);
            }
        } else {
            parent::getKatana()->console->katana("Disk caching " . Terminal::$COLOR_RED . "disabled");
        }

        $this->onFull = intval(parent::getKatana()->getProperty("redirect.on-full", true));
        $this->onThreshold = intval(parent::getKatana()->getProperty("redirect.on-threshold", 18));
        $this->dnsTTL = intval(parent::getKatana()->getProperty("redirect.dns-ttl", 300));
    }
}
