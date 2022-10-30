<?php

namespace customBuyRank\achedon\ui;

use customBuyRank\achedon\main;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;
use pocketmine\Server;

class buyrankUI extends SimpleForm{

    public static function open(Player $player){

        $db = Main::getInstance()->config();

        $form = new SimpleForm(
            function(Player $player,int $data = null) use($db){

                if($data === null){
                    $player->sendMessage("BuyRankUI closed");
                    return true;
                }


                $price = $db->getNested("Rank.".$data.'.price');
                $RankName = $db->getNested("Rank.".$data.'.name');
                $money = EconomyAPI::getInstance()->myMoney($player);
                $rank = Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->getUserDataMgr()->getGroup($player);


                $difference = $db->get("DifferencePriceBuy");
                if($difference === "true"){
                    if($money < $price){
                        $differenceprice = $price - $money;
                        $player->sendMessage("You don't have enough money\nYou miss ".$differenceprice." $");
                        return true;
                    }
                }elseif($difference === "false"){
                    if($money < $price){
                        $player->sendMessage("You don't have enough money");
                        return true;
                    }
                }

                if($rank != $RankName){
                    EconomyAPI::getInstance()->reduceMoney($player,$price);
                    $player->sendMessage("You did buyrankUI the rank: ".$RankName);
                    Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->setGroup($player,$RankName);
                    return true;
                }else{
                    $player->sendMessage("You already have this rank");
                }

            }
        );

        $form->setTitle("BuyRankUI");
        $form->setContent("You can buyrankUI any grade you like");
        for($i = 0;$i < $db->get('NumberRank'); $i++){
            $form->addButton($db->getNested('Rank.'.$i.'.name'));
        }
        $player->sendForm($form);
    }
}