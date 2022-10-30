<?php

namespace customBuyRank\achedon;

use customBuyRank\achedon\commands\adminrank;
use customBuyRank\achedon\commands\buyrank;
use customBuyRank\achedon\commands\setnbrank;
use pocketmine\event\Listener;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class main extends PluginBase implements Listener
{


    use SingletonTrait;

    protected function onEnable(): void
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");

        PermissionManager::getInstance()->addPermission(new Permission("use.adminrank"));

        $this->getServer()->getCommandMap()->registerAll('Command', [
            new adminrank("adminrank", "player information", "/adminrank <player>"),
            new buyrank("buyrank", "buyrankUI a rank", "/buyrank"),
            new setnbrank("setnbrank", "put a number of purchasable ranks", "/setnbrank")
        ]);


        if(!$this->$this->getServer()->getPluginManager()->getPlugin("FormAPI") or !$this->$this->getServer()->getPluginManager()->getPlugin("PurePerms") or !$this->$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")){
            $this->getLogger()->alert("You don't <FormAPI|PurePerms|EconomyAPI> on your server\nPlease install them");
            $this->getServer()->getPluginManager()->disablePlugins();
        }
    }

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    public function config()
    {
        return new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

}