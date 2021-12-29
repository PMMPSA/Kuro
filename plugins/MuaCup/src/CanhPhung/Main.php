<?php

namespace CanhPhung;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use pocketmine\command\CommandReader;
use pocketmine\command\CommandExecuter;
use pocketmine\command\ConsoleCommandSender;
class Main extends PluginBase implements Listener{
	public $tag = "§l§d[§eMua§bCup§d]§r ";
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		$this->getLogger()->info(TF::GREEN . "§d§l====================\n§l§eMua§Cup§6 BY§b CanhPhung \n§d§l====================");
	}
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
		switch($cmd->getName() == "muacup"){
			case "muacup":
			if (!isset($args[0])){
			
		$sender->sendMessage($this->tag. "§aSử dụng /muacup list để xem danh sách các loại cúp");
		return true;
		}
		if(isset($args[0])){
				if(isset($args[0])){
				switch(strtolower($args[0])){
      case "list":
      $sender->sendMessage("§d-=-=|§a §lPickaxe List§d |=-=-");
      $sender->sendMessage("§d[1] §a•Cúp Sắt Cường hóa - 10.000k•");
      $sender->sendMessage("§d[2] §a•Cúp Kim Cương Cường Hóa - 20.000k•");
      $sender->sendMessage("§d[3] §a•Cúp Hắc Diện Thạch - 25.000k•");
      $sender->sendMessage("§d[4] §a•Cúp Bedrock - 50.000k•");
      $sender->sendMessage("§d[5] §a•Cúp KuroMCPE - 500.000k•");
      $sender->sendMessage("§d/muacup [id] §ađể mua");
      $sender->sendMessage("§d•==================================•");
      }
    }
  }
      if(isset($args[0])){
				if(isset($args[0])){
				switch(strtolower($args[0])){
				case "1":
				 $item = Item::get(257, 0, 1);
						 $name = $item->setCustomName("§r§b•=[§aCúp §cSắt Cường Hóa§b]=•");
 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 10000){
							  $sender->sendMessage($this->tag. "§cKhông đủ tiền");
						  }
						  else{
						   $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(2));
						    $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(2));
							  $sender->getInventory()->addItem($item);
						  $sender->sendMessage($this->tag. "§aBạn đã mua thành công §r§b•=[§aCúp §cSắt Cường Hóa§b]=•");
						  
						  
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 10000);
							  }
 return true;
					  break;
					  case "2":
					   $item = Item::get(278, 0, 1);
						 $name = $item->setCustomName("§r§b•=[§aCúp §cKim Cương Cường Hóa§b]=•");
 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 20000){
							  $sender->sendMessage($this->tag. "§cKhông đủ tiền");
						  }
						  else{
						   $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(5));
						    $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(5));
							  $sender->getInventory()->addItem($item);
						  $sender->sendMessage($this->tag. "§aBạn đã mua thành công §r§b•=[§aCúp §cKim Cương Cường Hóa§b]=•");
						  
						  
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 10000);
							  }
						 return true;
					  break;
					  case "3":
					   $item = Item::get(278, 0, 1);
						 $name = $item->setCustomName("§l§b•=[§aCúp §cHắc Diện Thạch§b]=•");
 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 25000){
							  $sender->sendMessage($this->tag. "§cKhông đủ tiền");
						  }
						  else{
						   $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(10));
						    $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
							   $sender->getInventory()->addItem($item);
						  $sender->sendMessage($this->tag. "§aBạn đã mua thành công §l§b•=[§aCúp §cHắc Diện Thạch§b]=•");
						  
						  
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 25000);
							  }
							  return true;
							break;
							case "4":
								 $item = Item::get(278, 0, 1);
						 $name = $item->setCustomName("§l§b•=[§aCúp §cBedrock§b]=•");
 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 50000){
							  $sender->sendMessage($this->tag. "§cKhông đủ tiền");
						  }
						  else{
						   $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(20));
						    $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(20));
							   $sender->getInventory()->addItem($item);
						  $sender->sendMessage($this->tag. "§aBạn đã mua thành công §l§b•=[§aCúp §cBedrock§b]=•");
						  
						  
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 50000);
							}
							
							 return true;
							break;
							case "5":
							  				 $item = Item::get(278, 0, 1);
						 $name = $item->setCustomName("§l§b§o•=[§aCúp §cKuro§aM§1C§3P§4E§b]=•");
 $money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
						  if ($money < 500000){
							  $sender->sendMessage($this->tag. "§cKhông đủ tiền");
						  }
						  else{
						   $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(100));
						    $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
							   $sender->getInventory()->addItem($item);
						  $sender->sendMessage($this->tag. "§aBạn đã mua thành công §l§b§o•=[§aCúp §cKuro§aM§1C§3P§4E§b]=•");
						  
						  
							  $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 500000);
							}
							  
						} 
				}
		}
}
}
}