<?php

namespace customBuyRank\achedon\commands;



use customBuyRank\achedon\ui\adminrankUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;

class adminrank extends Command{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!$sender instanceof Player) {
            return;
        }

        if(!$sender->hasPermission("use.adminrank") && !Server::getInstance()->isOp($sender->getName())){
            $sender->sendMessage("§4/!\ §fyou don't have permission to use this command");
            return;
        }

        if(count($args) != 1){
            $sender->sendMessage("/adminrank <player>");
        }else{
            if(($target = Server::getInstance()->getPlayerByPrefix($args[0])) instanceof Player){
                    adminrankUI::open($sender,$target);
            }else{
                $sender->sendMessage("/adminrank <player>");
            }
        }
    }
}
