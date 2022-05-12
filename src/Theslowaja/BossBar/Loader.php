<?php

namespace Theslowaja\BossBar;

use pocketmine\{Server, player\Player, plugin\PluginBase, event\Listener, event\player\PlayerJoinEvent, event\player\PlayerQuitEvent, utils\Config};
use libs\xenialdan\apibossbar\DiverseBossBar;

class Loader extends PluginBase implements Listener {

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->BossBar = new BossBar();
    }

    public function onJoin(PlayerJoinEvent $event){
        $p = $event->getPlayer();
        $this->bossBar->setPercentage($this->config->get("percentage"));
        $this->bossBar->setTitle(str_replace("&", "§", $this->getConfig()->get("Top-Title")));
        $this->bossBar->setSubTitle(str_replace("&", "§", $this->getConfig()->get("Sub-Title")));
        $this->bossBar->addPlayer($p);
    }

    public function quit(PlayerQuitEvent $ev){
        $p = $ev->getPlayer();
        $this->bossBar->removePlayer($p);
    }
}
