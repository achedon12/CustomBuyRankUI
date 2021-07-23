<?php
namespace ash\UI;
use ash\main;
use jojoe77777\FormAPI\SimpleForm;
use onebone\economyapi\EconomyAPI;
use pocketmine\Player;
use pocketmine\Server;

class buy extends SimpleForm{

    public static function open(Player $player){

        $db = main::config();

        $form = new SimpleForm(
            function(Player $player,int $data = null){
                $db = main::config();

                if($data === null){
                    $player->sendMessage("BuyRankUI closed");
                    return true;
                }

                $price = $db->getNested("Rank.".$data.'.price');
                $RankName= $db->getNested("Rank.".$data.'.name');
                $money = EconomyAPI::getInstance()->myMoney($player);
                $rank = Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->getUserDataMgr()->getGroup($player);
                if($money < $price){
                    $player->sendMessage("You don't have enough money");
                    return true;
                }
                if($rank != $RankName){
                    EconomyAPI::getInstance()->reduceMoney($player,$price);
                    $player->sendMessage("You did buy the rank: ".$RankName);
                    Server::getInstance()->getPluginManager()->getPlugin("PurePerms")->setGroup($player,$RankName);
                    return true;
                }else{
                    $player->sendMessage("You already have this rank");
                }

            }
        );

        $form->setTitle("BuyRankUI");
        $form->setContent("You can buy any grade you like");
        for($i = 0;$i < $db->get('NumberRank'); $i++){
            $form->addButton($db->getNested('Rank.'.$i.'.name'));
        }
        $player->sendForm($form);
    }
}