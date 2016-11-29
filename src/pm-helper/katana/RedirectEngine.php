<?php



namespace pocketmine\imagical;


class RedirectEngine extends KatanaModule
{
    public $onFull = false;
    public $onThreshold = 18;

    private $dns;
    public $ip = "";
    public $port = 19132;

    private $dnsTTL = 0;
    private $lastDNSRefresh = 0;

    public function init()
    {
        parent::setName("redirect");
        parent::writeLoaded();

        $destination = parent::getKatana()->getProperty("redirect.destination", "play.myserver.com:19132");
        if (count($targets = explode(":", $destination)) !== 2) {
            parent::getKatana()->console->katana("Invalid redirect destination (" . $destination . ").", "warning");
            $targets = ["play.myserver.com", "19132"];
        }

        if (filter_var($targets[0], FILTER_VALIDATE_IP)) {
            $this->ip = $targets[0];
        } else {
            $this->dns = $targets[0];
        }

        if (intval($targets[1]) === 0) {
            parent::getKatana()->console->katana("Invalid port (" . $targets[1] . ").", "warning");
        } else {
            $this->port = intval($targets[1]);
        }

        $this->onFull = intval(parent::getKatana()->getProperty("redirect.on-full", true));
        $this->onThreshold = intval(parent::getKatana()->getProperty("redirect.on-threshold", 18));
        $this->dnsTTL = intval(parent::getKatana()->getProperty("redirect.dns-ttl", 300));
    }

    public function getIP()
    {
        if (time() > ($this->lastDNSRefresh + $this->dnsTTL)) {
            parent::getKatana()->console->katana("Refreshed DNS for player redirection", "debug");
            $this->ip = gethostbyname($this->dns);
            $this->lastDNSRefresh = time();
        }

        return $this->ip;
    }

    public function getPort()
    {
        return $this->port;
    }
}
