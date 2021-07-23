<?php

namespace ash;

use ash\Commands\adminrank;
use ash\Commands\buyrank;
use ash\Commands\setnbrank;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener
{

    /**@var $db Config */
    public $db;
    /** @vr main $instance*/
    private static $instance;

    public function onEnable()
    {
        self::$instance = $this;
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getServer()->getCommandMap()->registerAll('Command', [
            new adminrank("adminrank", "player information", "/adminrank <player>"),
            new buyrank("buyrank", "buyrankUI a rank", "/buyrank"),
            new setnbrank("setnbrank", "put a number of purchasable ranks", "/setnbrank")
        ]);

        $this->db = new Config($this->getDataFolder() . "config.yml" . Config::YAML);
    }

    public static function config()
    {
        return new Config(self::$instance->getDataFolder() . "config.yml", Config::YAML);
    }

    public static function getInstance()
    {
        return self::$instance;
    }
}