<?php

namespace PickaxeLevel\phuongaz;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\Player;
use PickaxeLevel\phuongaz\Main;

Class PopupTask extends Task{


    public function __construct(Main $plugin, Player $player){

        $this->plugin = $plugin;
        $this->player = $player;
    }

    public function onRun($currentTick){
        foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {
            $level = $this->plugin->getLevel($player);
            $exp = $this->plugin->getExp($player);
            $next = $this->plugin->getNextExp($player);
            $pickaxename = $this->plugin->getNamePickaxe($player);
            $i = $player->getInventory()->getItemInHand();
            $hand = $i->getCustomName();
            $it = explode(" ", $hand);
            $damage = $i->getDamage();
            if ($it[0] == "§l§c|§b") {
                if ($damage > 30) {
                    $i->setDamage(0);
                    $player->getInventory()->setItemInHand($i);
                    $player->sendMessage("§l§6⚒§e Cúp đã được sửa chữa miễn phí ");
                }
                $player->sendPopup("  §l§e⎳§d CÚP: §b ＫＵＲＯ §aＭＣＰＥ§c §e\n" . "§c⊱§b Kinh Nghiệm:§a " . $exp ."§l§3 /§a ".$next. "§c |§b Cấp Cúp: §a" . $level);
            } else {
            }
        }
    }



}