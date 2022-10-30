<?php

namespace customBuyRank\achedon\commands;


use customBuyRank\achedon\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class setnbrank extends Command{

    public function construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->setPermission('setnbrank');
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player){
            $sender->sendMessage("Command to execute in game");
        }
        if(!$this->testPermission($sender)) return;
        $value = array_shift($args);
        if(!is_numeric($value)){
            $sender->sendMessage("The value must be numeric");
            return;
        }
        $db = main::config();
        $db->set("NumberRank",(int)$value);
        $db->save();
        $sender->sendMessage("You have put ".$value." available for purchase");
    }
}