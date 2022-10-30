<?php

namespace customBuyRank\achedon\ui;


use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\Server;

class adminrankUI extends SimpleForm{

    public static function open(Player $player, Player $target){

        $form = new SimpleForm(
            function(Player $player, int $data = null) use ($target) {
                if($data === 1){
                    $player->teleport($target->getPosition());
                    $player->sendMessage("Teleportation to ".$target->getName());
                }
            }
        );

        $money = EconomyAPI::getInstance()->myMoney($player);
        $rank = Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->getUserDataMgr()->getGroup($player);

        $form->setTitle("AdminRankUI");
        $form->setContent("NameTag : {$target->getName()}\nRank: {$rank}\nMonnaie : {$money} $\n\nPosition: {$target->getPosition()->getWorld()->getDisplayName()}\nX: {$target->getPosition()->getX()}\nY: {$target->getPosition()->getY()}\n\nZ: {$target->getPosition()->getZ()}");
        $form->addButton("teleportation");
        $form->addButton("Close");
        $player->sendForm($form);
    }
}
