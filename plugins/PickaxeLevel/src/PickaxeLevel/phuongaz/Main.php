<?php

namespace PickaxeLevel\phuongaz;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use onebone\economyapi\EconomyAPI;
use pocketmine\item\Item;
use pocketmine\event\player\{PlayerInteractEvent, PlayerItemHeldEvent, PlayerJoinEvent, PlayerChatEvent};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\utils\Config;
use pocketmine\entity\Effect;
use pocketmine\network\protocol\SetTitlePacket;
use pocketmine\item\enchantment\Enchantment;
use PickaxeLevel\phuongaz\PopupTask;
class Main extends PluginBase implements Listener{


	public function onEnable(){
		@mkdir($this->getDataFolder()); 


		$this->lv = new Config($this->getDataFolder() . "user.yml", Config::YAML);
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
		$this->config->save();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getLogger()->info("\n\n§c§l❤§b P༶I༶C༶K༶A༶X༶E༶ L༶E༶V༶E༶L༶ §6Version§e 2\n§c❤§b By Phuongaz\n\n");
		$this->eco =  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->point =  $this->getServer()->getPluginManager()->getPlugin("PointAPI");
        if(is_null($this->point)){
            $this->getLogger()->warning("Please download [PointAPI]: github.com/ZzKino/PointAPI");
        }else{
            $this->getLogger()->notice("Loading PickaxeLEVEL by Phuongaz");
		}
	}

	public function getNamePickaxe($player){
		if($player instanceof Player){
			$p = $player->getName();
		}
		$this->lv->load($this->getDataFolder() . "user.yml", Config::YAML);
        $pa = "§l§c|§b ＫＵＲＯ §aＭＣＰＥ§c ❤ §6".$this->lv->get(strtolower($p))["Level"]." §b➡§e ".$p;
		return $pa;
    }
	public function onJoin(PlayerJoinEvent $ev){
		$p = $ev->getPlayer()->getName();
		if(!($this->lv->exists(strtolower($p)))){
			$this->getLogger()->notice(" Không tìm thấy dữ liệu $p ");
			$this->getLogger()->notice(" Tạo dữ liệu $p ");
			$this->lv->set(strtolower($p), ["Level" => 1, "exp" => 0, "nextexp" => 100]);
			$this->lv->save();
			$p1 = $ev->getPlayer();
			$player = $ev->getPlayer();
			$inv = $player->getInventory();  
			$item = Item::get(274, 0, 1);
			$item->setCustomName($this->getNamePickaxe($player));
			$inv->addItem($item);
			$player->sendMessage("§l§c•§b Cúp đã được thêm vào túi đồ của bạn, hãy cùng đồng hành với nó lâu nhé, cúp có thể trở nên một cây cúp §evip");
			return true;
		}
	}




    public function onItemHeld(PlayerItemHeldEvent $ev){


        $task = new PopupTask($this, $ev->getPlayer());
        $this->tasks[$ev->getPlayer()->getId()] = $task;
        server::getInstance()->getScheduler()->scheduleRepeatingTask($task, 20);

        $p = $ev->getPlayer();
        $contents = $p->getInventory()->getContents();
        $i = $p->getInventory()->getItemInHand();
       /* if ($damage > 30) {
            $i->setDamage(0);
            $player->sendMessage("§l§6⚒§e Cúp đã được sửa chữa miễn phí ");
        }*/
        if(isset($this->need[$p->getName()])){

            $i->setCustomName($this->getNamePickaxe($p));

            if($this->getLevel($p) == 3){
                $i = Item::get(257,0,1);
                $i->setCustomName($this->getNamePickaxe($p));
                $p->sendMessage("§l§6⚒§e Cúp của bạn đã được nâng cấp");
            }elseif($this->getLevel($p) == 20){
                $i = Item::get(278,0,1);
                $i->setCustomName($this->getNamePickaxe($p));
                $p->sendMessage("§l§6⚒§e Cúp của bạn đã được nâng cấp");
            }
            if(in_array($this->getLevel($p), array(10, 20))){
            }
            if(in_array($this->getLevel($p), array(2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50))){
                $id = 15;
                $lv = $this->getLevel($p)/2.5;
                $i->addEnchantment(Enchantment::getEnchantment($id), $lv);
                $p->sendMessage("§l§6⚒§e Cúp đã được cường hóa: §cHiệu xuất§e Cấp độ §c".$lv);
            }elseif(in_array($this->getLevel($p), array(52, 54, 56, 58, 60, 62, 64, 66, 68, 70, 72, 74, 76, 78, 80, 82, 84, 86, 88, 90, 92, 94, 96, 98 ,100))){
                    $id = 18;
                    $lv = $this->getLevel($p)/3;
                    $i->addEnchantment(Enchantment::getEnchantment($id), $lv);
                    $p->sendMessage("§l§6⚒§e Cúp đã được cường hóa: §cGia tài§e Cấp độ §c".$lv);
                }
            $p->getInventory()->setItemInHand($i);
            unset($this->need[$p->getName()]);
        }

    }
	public function onBreak(BlockBreakEvent $ev){
		$p = $ev->getPlayer();
		$name = $p->getName();
		$i = $p->getInventory()->getItemInHand();
		$icn = $i->getCustomName();
		$pas = explode(" ", $icn);
		if($pas[0] == "§l§c|§b"){
			if(!in_array($name, explode(" ", $icn))){
				$ev->setCancelled(true);
				$p->sendMessage("§l§c•§6 Vật Phẩm Không Phải Của Bạn");
				}
		}


		if(!$ev->isCancelled()){
		    if($pas[0] == "§l§c|§b"){

				$block = $ev->getBlock();
				$name = strtolower($p->getName());
				$n = $this->lv->get($name);
				
				//  if(in_array($block->getId(), array(16, 56, 129, 14, 15, 21))){
               switch($block->getId()) {
                   case 56:
                       $this->addExp($p, 4);
                       break;
                   case 14:
                       $this->addExp($p, 3);
                       break;
                   case 15:
                       $this->addExp($p, 4);
                       break;
                   case 16:
                       $this->addExp($p, 2);
                       break;
                   case 129:
                       $this->addExp($p, 6);
                       break;
                   case 133:
                       $this->addExp($p, 8);
                       break;
                   case 57:
                           $this->addExp($p, 7);
                   case 42:
                       $this->addExp($p, 6);
                   case 41:
                       $this->addExp($p, 6);
                       break;
                   default:
                       $this->addExp($p, 2);
                       break;

                }
			//	$this->addExp($p ,rand(1,3));
				//$p->sendPopup($this->getNamePickaxe($p)."\n"."§l§a⚒§e ".$n["exp"]."§c/§e ".$n["nextexp"]."§a ⚒");
				if($this->getExp($p) >= $this->getNextExp($p)){
					$this->setLevel($p, $this->getLevel($p) +1);
					//$p->sendMessage("§l§aPickaxe Level: §e".$this->getLevel($p));
					$money = $this->getLevel($p) * 1000;
					if(in_array($this->getLevel($p), array(10, 20, 30, 40, 50,60,70,80,90,100 ))){
					    $point = $this->getLevel($p)/2;
                        $this->point->addMoney($p->getName(), $point);
                    }
					$this->eco->addMoney($p->getName(), $money);
					$p->sendMessage("§l§c•§a Bạn được cộng§e $money §aYên");
					$p->sendMessage("§l§c•§6 Cúp Của Bạn Đã Được Nâng Cấp");
                    $this->getServer()->broadcastMessage("§l§6•§e Cúp của người chơi§b ".$p->getName()."§e Vừa lên cấp§d : ".$this->getLevel($p));
					$this->need[$p->getName()] = true;
				}
			}
		}
	}
	/*   public function onChat(PlayerChatEvent $ev){
	$p = $ev->getPlayer();
	$name = $p->getName();
	$p->setDisplayName("§b[§a".$this->getLevel($p)."§b]§r ".$p->getName());
	}*/
     public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
         if($cmd->getName() == "givecup"){
             if($sender->isOp() || $sender->getName() == "phuongaz"){
                if(!isset($args[0])){
                    $sender->sendMessage("§l§b•§a /givecup <player>");
                    return true;
                }else{
                    $player = $this->getServer()->getPlayer($args[0]);
                    if(!$player == null){
                        if($player->isOnline()) {
                            $inv = $player->getInventory();
                            if ($this->getLevel($player) < 3){
                                $cup = Item::get(274, 0, 1);

                        }elseif($this->getLevel($player) >= 3 and $this->getLevel($player) < 15){
                                $cup = Item::get(257, 0, 1);
                            }elseif( $this->getLevel($player) > 15){
                                $cup = Item::get(278, 0, 1);
                            }
                            $pickname = $this->getNamePickaxe($player);
                            $cup->setCustomName($pickname);
                            $inv->addItem($cup);
                            $player->sendMessage("§l§6⚒§e Cúp §bKuro§AMCPE§e ...");
                        }
                    }
                }

             }else{
                 $sender->sendMessage("§f§l•§b You don't permission use command");
                 return true;
             }
         }

         return true;
     }
	public function getLevel($player){
		if($player instanceof Player){
		$name = $player->getName();
		}
		$level = $this->lv->get(strtolower($name))["Level"];
		return $level;
	}
	public function setLevel($player, $level){
		if($player instanceof Player){
			$name = $player->getName();
		}

		$nextexp = ($this->getLevel($player)+1)*50;
		$this->lv->set(strtolower($name), ["Level" => $level, "exp" => 0, "nextexp" => $nextexp]);
		$this->lv->save();
	}

	public function setNextExp($player, $exp){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$lv = $this->lv->get($player)["nextexp"] + $exp;
		$this->lv->set($player, ["Level" => $this->lv->get($player)["Level"], "exp" => $this->lv->get($player)["exp"], "nextexp" => $lv]);
		$this->lv->save();
	}

	public function getExp($player){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$e = $this->lv->get($player)["exp"];
		return $e;
	}

	public function getNextExp($player){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$lv = $this->lv->get($player)["nextexp"];
		return $lv;
	}

	public function addExp($player, $exp){
		if($player instanceof Player){
			$player = $player->getName();
		}

		$player = strtolower($player);
		$e = $this->lv->get($player)["exp"];
		$lv = $this->lv->get($player)["Level"];
		$this->lv->set($player, ["Level" => $lv, "exp" => $e + $exp, "nextexp" => $this->getNextExp($player)]);
		$this->lv->save();

	}




}