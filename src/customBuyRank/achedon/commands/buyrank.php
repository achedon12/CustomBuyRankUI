<?php

namespace customBuyRank\achedon\commands;

use customBuyRank\achedon\ui\buyrankUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class buyrank extends Command{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            buyrankUI::open($sender);
            if(count($args) != 1){
                $sender->sendMessage("Available commands:\n/buyrank\n/buyrank info");
            }else{
                if($args[0] != "info"){
                    $sender->sendMessage("Available commands:\n/buyrank\n/buyrank info");
                }else{
                    $sender->sendMessage("§6-- ----[§3CustomBuyRankUI§6]---- --§f\n\n\nPlugin made by §dAchedon12§f\n\nAvailable commands:\n/buyrank\n/buyrank info\n\ndiscord : achedon12#0034\n\n§6-- --- ---- ---- --- --");
                }
            }
        }else{
            $sender->sendMessage("Command to execute in game");
        }
    }
}
