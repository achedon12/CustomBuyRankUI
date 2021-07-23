<?php

namespace ash\Commands;

use ash\main;
use ash\UI\admin;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;

class adminrank extends Command{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if($sender->hasPermission("use.adminrank")){
                if(count($args) != 1){
                    $sender->sendMessage("/adminrank <player>");
                }else{
                    if($args[0] instanceof Player){
                        if(!$args[0]->isConnected()){
                            $sender->sendMessage("This player does not exist or is not online");
                        }else{
                            $db = main::config();
                            $db->set("AdminRank",$args[0]);
                            admin::open($sender);
                        }
                    }else{
                        $sender->sendMessage("/adminrank <player>");
                    }
                }
            }else{
                $sender->sendMessage("§4/!\ §fyou don't have permission to use this command");
            }
        }else{
            $sender->sendMessage("Command to execute in game");
        }
    }
}
