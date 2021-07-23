<?php

namespace ash\Commands;

use ash\UI\buy;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class buyrank extends Command{

    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            buy::open($sender);
        }else{
            $sender->sendMessage("Command to execute in game");
        }
    }
}
