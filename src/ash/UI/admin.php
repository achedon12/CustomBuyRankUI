<?php

namespace ash\UI;

use ash\main;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\Player;
use pocketmine\Server;

class admin extends SimpleForm{

    public static function open(Player $player){

        $db = main::config();

        $form = new SimpleForm(
            function(Player $player, int $data = null){
                $db = main::config();
                if($data === null){
                    $player->sendMessage("AdminRankUI closed");
                    $db->remove("AdminInfo");
                    $db->save();
                }else{
                    $visedplayer = $db->get("AdminInfo");
                    if($data === 1){
                        $player->teleport($visedplayer);
                        $player->sendMessage("Teleportation to ".$visedplayer);
                    }
                    if($data === 2){
                        $player->sendMessage("AdminRankUI closed");
                    }
                }
            }
        );

        $money = EconomyAPI::getInstance()->myMoney($player);
        $rank = Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->getUserDataMgr()->getGroup($player);
        $visedplayer = $db->get("AdminInfo");

        $form->setTitle("AdminRankUI");
        $form->setContent("NameTag : {$visedplayer}\nRank: {$rank}\nMonnaie : {$money} $\n\nPosition: {$visedplayer->getLevel()}\nX: {$visedplayer->getX()}\nY: {$visedplayer->getY()}\n\nZ: {$visedplayer->getZ()}");
        $form->addButton("teleportation");
        $form->addButton("Close");
        $player->sendForm($form);
    }
}
