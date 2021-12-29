<?php
namespace Minuha\Trade;
 use pocketmine\command\Command;
 use pocketmine\command\CommandSender;
 use pocketmine\event\Listener;
 use pocketmine\plugin\PluginBase;
 use pocketmine\Server;
 use pocketmine\item\enchantment\Enchantment;
 use pocketmine\item\Item;
 use pocketmine\Player;
 use pocketmine\utils\TextFormat as TF;
 class Main extends PluginBase implements Listener {
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->getLogger()->info(TF::GREEN . "Trade đã được bật");
 	}
 	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		if ($cmd->getName() == "trade") {
			$sender->sendMessage(TF::BLUE . "§9[§bTrade§9]§b» §eSử dụng:/trade list để xem danh sách vật phẩm");
 			if(isset($args[0])) {
				switch(strtolower($args[0])) {
					case "list":
						$sender->sendMessage(TF::BLUE . "§9[§bTrade§9]§b» §bDanh sách các gói vật phẩm đặc biệt. Ghi /trade doi (tên vật phẩm) để đổi");
 						$sender->sendMessage(TF::GREEN . "1.Cúp Sắt Cường Hóa - 10 Sắt (cú pháp:cup1)");
 						$sender->sendMessage(TF::GREEN . "2.Cúp Kim Cương Cường Hóa - 25  Kim Cương (cú pháp:cup2");
 						$sender->sendMessage(TF::GREEN . "3.Cúp Hắc Diện Thạch - 15 Ngọc Lục Bảo (cú pháp:cup3)");
 						$sender->sendMessage(TF::GREEN . "4.Cúp Ánh Sáng - 25 Ngọc Lục Bảo (cú pháp:cup4)");
 						$sender->sendMessage(TF::GREEN . "5.Kiếm Titanium - 35  Kim Cương (Ngừng Bán)");
 						$sender->sendMessage(TF::GREEN . "6.Set Giáp+Kiếm Khởi Đầu - 64 Kim Cương (cú pháp:set1)");
 						$sender->sendMessage(TF::GREEN . "7.Set Giáp+Kiếm Quý Tộc - 999999999999 xu (cú pháp:set2)");
 						$sender->sendMessage(TF::GREEN . "8.Gậy Thông Trĩ Siêu Cấp - 400000 xu (cú pháp:gaythongtri)");
 						$sender->sendMessage(TF::BLUE . "§9[§bTrade§9]§b» §bGhi /trade list 2 để xem trang tiếp theo ---->");
 																										if(isset($args[1])) {
																											switch (strtolower($args[1])) {
																												case "2":
																													$sender->sendMessage(TF::BLUE . "§9[§bTrade§9]§b» §bDanh sách các gói vật phẩm đặc biệt (/trade doi (cú pháp) để đổi)");
 																													$sender->sendMessage(TF::GREEN . "9.16 Quả Táo Vàng - 64 Khối Vàng (cú pháp:taovang)");
 																													$sender->sendMessage(TF::GREEN . "10.Cúp Gỗ Phù Phép - 64 Khối Ngọc Lục Bảo (cú pháp:cupgo)");
 																													$sender->sendMessage(TF::GREEN . "11.Cúp Bí Ẩn - 64 Khối Sắt (cú pháp:bian)");
 																													$sender->sendMessage(TF::GREEN . "12.Cúp Boss - 128 Khối Vàng (cú pháp:cupboss");
 																													$sender->sendMessage(TF::GREEN . "13.Nether Reactor Core - 200 Cục Đất (cú pháp:nether");
 																													$sender->sendMessage(TF::GREEN . "14.Bedrock - 10 Hắc Diện Thạch (cú pháp:bedrock)");
 																																											return true;
 																																											break;
 																																										}
 																																								}
 																																								return true;
 																																								case "doi":
																																									if(isset($args[1])) {
																																										switch (strtolower($args[1])) {
																																											case "cup1":
																																												$p = $this->getServer()->getPlayer($sender->getName());
 																																												$item = Item::get(257, 0, 1);
 																																														$item->setCustomName("§r§6Cúp Sắt Phù Phép");
 																																														if($sender->getInventory()->contains(Item::get(265,0,10))) {														
 																																															$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(5));
 																																															$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(5));
 																																															$sender->getInventory()->addItem($item);
 																																															$sender->getInventory()->removeItem(Item::get(265,0,10));
 																																															$sender->sendMessage("§9[§bTrade§9]§b» ".TF::YELLOW . "Bạn Thành Công Cúp Sắt Phù Phép Với 10 Sắt ");
 																																														} else {
																																															$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn không có vật phẩm để đổi");
 																																														}
 																																														return true;
 																																														break;
 																																														case "cup2":
																																															$p = $this->getServer()->getPlayer($sender->getName());
 																																															$item = Item::get(278, 0, 1);
 																																																	$item->setCustomName("§r§6Cúp Kim Cương Phù Phép");
 																																																	if ($sender->getInventory()->contains(Item::get(264,0,25))) {
 																																																		$sender->getInventory()->removeItem(Item::get(264,0,25));
 																																																		$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(10));
 																																																		$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
 																																																		$sender->getInventory()->addItem($item);
 																																																		$sender->sendMessage("§9[§bTrade§9]§b» ".TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Kim Cương Phù Phép Với 25 Kim Cương");
 																																																	} else {
																																																		$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																	}
 																																																	return true;
 																																																	break;
 																																																	case "cup3":
																																																		$p = $this->getServer()->getPlayer($sender->getName());
 																																																		$item = Item::get(278, 0, 1);
 																																																				$item->setCustomName("§r§6Cúp Hắc Diện Thạch");
 																																																				if ($sender->getInventory()->contains(Item::get(388,0,15))) {
 																																																					$sender->getInventory()->removeItem(Item::get(388,0,15));
 																																																					$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(8));
 																																																					$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
 																																																					$item->addEnchantment(Enchantment::getEnchantment(18)->setLevel(1));
 																																																					$sender->getInventory()->addItem($item);
 																																																					$sender->sendMessage("§9[§bTrade§9]§b» ".TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Hắc Diện Thạch Với 15 Ngọc Lục Bảo");
 																																																				} else {
																																																					$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																				}
 																																																				return true;
 																																																				break;
 																																																				case "cup4":
																																																					$p = $this->getServer()->getPlayer($sender->getName());
 																																																					$item = Item::get(278, 0, 1);
 																																																							$item->setCustomName("§r§6Cúp Ánh Sáng");
 																																																							if ($sender->getInventory()->contains(Item::get(388,0,25))) {
 																																																								$sender->getInventory()->removeItem(Item::get(388,0,25));
 																																																								$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(9));
 																																																								$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
 																																																								$item->addEnchantment(Enchantment::getEnchantment(18)->setLevel(2));
 																																																								$sender->getInventory()->addItem($item);
 																																																								$sender->sendMessage("§9[§bTrade§9]§b» ".TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Ánh Sáng Với 25 Ngọc Lục Bảo");
 																																																							} else {
																																																								$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																							}
 																																																							return true;
 																																																							break;
 																																																							case "set1":
																																																								$p = $this->getServer()->getPlayer($sender->getName());
 																																																								$item1 = Item::get(306, 0, 1);
 																																																								$item2 = Item::get(307, 0, 1);
 																																																								$item3 = Item::get(308, 0, 1);
 																																																								$item4 = Item::get(309, 0, 1);
 																																																								$item5 = Item::get(267, 0, 1);
 																																																						  	$item6 = Item::get(257, 0, 1);
 																																																								$item7 = Item::get(258, 0, 1);
 																																																								$item8 = Item::get(256, 0, 1);
 																																																																								$item1->setCustomName("§r§6Mũ Khởi Đầu");
 																																																																								$item2->setCustomName("§r§6Áo Khởi Đầu");
 																																																																								$item3->setCustomName("§r§6Quần Khởi Đầu");
 																																																																								$item4->setCustomName("§r§6Giày Khởi Đầu");
 																																																																								$item5->setCustomName("§r§6Kiếm Khởi Đầu");
 																																																																								$item6->setCustomName("§r§6Cúp Khởi Đầu");
 																																																																								$item7->setCustomName("§r§6Rìu Khởi Đầu");
 																																																																								$item8->setCustomName("§r§6Xẻng Khởi Đầu");
 																																																																								if ($sender->getInventory()->contains(Item::get(264,0,64))) {		
 																																																																									$item1->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
 																																																																									$item1->addEnchantment(Enchantment::getEnchantment(5)->setLevel(1));
 																																																																									$item1->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
 																																																																									$item2->addEnchantment(Enchantment::getEnchantment(5)->setLevel(1));
 																																																																									$item2->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item3->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
 																																																																									$item3->addEnchantment(Enchantment::getEnchantment(5)->setLevel(1));
 																																																																									$item3->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item4->addEnchantment(Enchantment::getEnchantment(0)->setLevel(1));
 																																																																									$item4->addEnchantment(Enchantment::getEnchantment(5)->setLevel(1));
 																																																																									$item4->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item5->addEnchantment(Enchantment::getEnchantment(9)->setLevel(1));
 																																																																									$item5->addEnchantment(Enchantment::getEnchantment(12)->setLevel(3));
 																																																																									$item5->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item6->addEnchantment(Enchantment::getEnchantment(15)->setLevel(3));
 																																																																									$item6->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item7->addEnchantment(Enchantment::getEnchantment(15)->setLevel(3));
 																																																																									$item7->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$item8->addEnchantment(Enchantment::getEnchantment(15)->setLevel(3));
 																																																																									$item8->addEnchantment(Enchantment::getEnchantment(17)->setLevel(3));
 																																																																									$sender->getInventory()->addItem($item1);
 																																																																									$sender->getInventory()->addItem($item2);
 																																																																									$sender->getInventory()->addItem($item3);
 																																																																									$sender->getInventory()->addItem($item4);
 																																																																									$sender->getInventory()->addItem($item5);
 																																																																									$sender->getInventory()->addItem($item6);
 																																																																									$sender->getInventory()->addItem($item7);
 																																																																									$sender->getInventory()->addItem($item8);
 																																																																									$sender->sendMessage("§9[§bTrade§9]§b» ".TF::YELLOW . "Bạn Đã Đổi Thành Công Set Khởi Đầu Với 100 Kim Cương");
 																																																																								} else {
																																																																									$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																								}
 																																																																								return true;
 																																																																								break;
 																																																																								case "set2":
																																																																									$p = $this->getServer()->getPlayer($sender->getName());
 																																																																									$item1 = Item::get(310, 0, 1);
 																																																																									$item2 = Item::get(311, 0, 1);
 																																																																									$item3 = Item::get(312, 0, 1);
 																																																																								  $item4 = Item::get(313, 0, 1);
 																																																																								  $item5 = Item::get(276, 0, 1);
 																																																																								  $item6 = Item::get(277, 0, 1);
 																																																																								  $item7 = Item::get(278, 0, 1);
 																																																																								  $item8 = Item::get(279, 0, 1);
 																																																																																									$name1 = $item1->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Mũ Của Boss§b<•");
 																																																																																									$name2 = $item2->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Áo Của Boss§b<•");
 																																																																																									$name3 = $item3->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Quần Của Boss§b<•");
 																																																																																									$name4 = $item4->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Giày Của Boss§b<•");
 																																																																																									$name5 = $item5->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Kiếm Của Boss§b<•");
 																																																																																									$name6 = $item6->setCustomName("§r§b•>§1Đ§2ồ§3 Đ§4ặ§5c§6 B§7i§8ệ§9t§0:§a Cúp Của Boss§b<•");
 																																																																																									$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
 																																																																																									if ($money < 99999999999999999) {
																																																																																										$sender->sendMessage(TF::RED . "Không đủ tiền");
 																																																																																									} else {
																																																																																										$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 99999999999999999);
 																																																																																										$item1->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
 																																																																																										$item1->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
 																																																																																										$item1->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$item2->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
 																																																																																										$item2->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
 																																																																																										$item2->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$item3->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
 																																																																																										$item3->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
 																																																																																										$item3->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$item4->addEnchantment(Enchantment::getEnchantment(0)->setLevel(5));
 																																																																																										$item4->addEnchantment(Enchantment::getEnchantment(5)->setLevel(2));
 																																																																																										$item4->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$item5->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
 																																																																																										$item5->addEnchantment(Enchantment::getEnchantment(12)->setLevel(2));
 																																																																																										$item5->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$item6->addEnchantment(Enchantment::getEnchantment(15)->setLevel(9));
 																																																																																										$item6->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
 																																																																																										$sender->getInventory()->addItem($item1);
 																																																																																										$sender->getInventory()->addItem($item2);
 																																																																																										$sender->getInventory()->addItem($item3);
 																																																																																										$sender->getInventory()->addItem($item4);
 																																																																																										$sender->getInventory()->addItem($item5);
 																																																																																										$sender->getInventory()->addItem($item6);																																																																																						
 																																																																																										$sender->sendMessage(TF::YELLOW . "Bạn đã chính thức trở thành Boss Trong Server với $name1 trị giá 99999999999999999 xu");
 																																																																																									}
 																																																																																									return true;
 																																																																																									break;
 																																																																																									case "gaythongtri":
																																																																																										$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																										$item = Item::get(280, 0, 1);
 																																																																																												$name = $item->setCustomName("§aGậy Thông Trĩ Siêu Cấp");
 																																																																																												$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
 																																																																																												if ($money < 400000) {
																																																																																													$sender->sendMessage(TF::RED . "Không đủ tiền");
 																																																																																												} else {
																																																																																													$this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->reduceMoney($sender->getName(), 400000);
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(9)->setLevel(5));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(10));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(10)->setLevel(5));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(11)->setLevel(5));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(12)->setLevel(5));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(13)->setLevel(5));
 																																																																																													$item->addEnchantment(Enchantment::getEnchantment(14)->setLevel(5));
 																																																																																													$sender->getInventory()->addItem($item);																																																																																												
 																																																																																													$sender->sendMessage(TF::YELLOW . "Bạn Đã Mua Gậy Thông Trĩ với giá 400000 xu");
 																																																																																												}
 																																																																																												return true;
 																																																																																												break;
 																																																																																												case "taovang":
																																																																																													$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																													$item = Item::get(322, 0, 16);
																																																																																																if ($sender->getInventory()->contains(Item::get(41,0,64))) {
 																																																				                                                                                      	$sender->getInventory()->removeItem(Item::get(41,0,64));			 																																																																																													
 																																																																																																$sender->getInventory()->addItem($item);
 																																																																																																$sender->sendMessage(TF::YELLOW . "Bạn Đã Đổi Thành Công Táo Vàng Với 64 Khối Vàng");
																																																																																																} else {
																																																																																																$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																															}
 																																																																																															return true;
 																																																																																															break;
 																																																																																															case "cupgo":
																																																																																																$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																																$item = Item::get(270, 0, 1);
																																																																																																$name = $item->setCustomName("§aCúp Gỗ Huyền Thoại");
 																																																																																																	if ($sender->getInventory()->contains(Item::get(133,0,64))) {
 																																																					                                                                                             $sender->getInventory()->removeItem(Item::get(133,0,64));				
 																																																																																																			$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(200));
																																																																																																			$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(200));
 																																																																																																			$sender->getInventory()->addItem($item);																																																																																																
 																																																																																																			$sender->sendMessage(TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Gỗ Phù Phép Với 64 Khối Ngọc Lục Bảo ");
																																																																																																			} else {
																																																																																																		  $sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																																		}
 																																																																																																		return true;
 																																																																																																		break;
 																																																																																																		case "bian":
																																																																																																			$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																																			$item = Item::get(278, 0, 1);
 																																																																																																					$name = $item->setCustomName("§c§lCúp Bí Ẩn");
 																																																																																																			     	if ($sender->getInventory()->contains(Item::get(41,0,64))) {
 																																																					                                                                                                  $sender->getInventory()->removeItem(Item::get(41,0,64));
																																																					                                                                                                  $item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(50));
																																																					                                                                                                  $item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(50)); 																																																																																																																																																																																																								
 																																																																																																						$sender->getInventory()->addItem($item); 																																																																																																	
 																																																																																																						$sender->sendMessage(TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Bí Ẩn Với 64 Khối Vàng");
																																																																																																				 } else {
																																																																																																					  $sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																																					}
 																																																																																																					return true;
 																																																																																																					break;
 																																																																																																					case "cupboss":
																																																																																																						$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																																						$item = Item::get(278, 0, 1);
 																																																																																																								$name = $item->setCustomName("§c§lCúp Boss"); 				
																																																																																																									if ($sender->getInventory()->contains(Item::get(41,0,128))) {
 																																																				                                                                                                        	$sender->getInventory()->removeItem(Item::get(41,0,128));																																																																																																																																																																																																																																																																																																																																																																																																																								
 																																																																																																									$item->addEnchantment(Enchantment::getEnchantment(15)->setLevel(100));
																																																																																																									$item->addEnchantment(Enchantment::getEnchantment(17)->setLevel(100));
																																																																																																									$item->addEnchantment(Enchantment::getEnchantment(18)->setLevel(100));
 																																																																																																									$sender->getInventory()->addItem($item); 																																																																																																				
 																																																																																																									$sender->sendMessage(TF::YELLOW . "Bạn Đã Đổi Thành Công Cúp Boss Với 128 Khối Vàng");
																																																																																																									} else {
																																																																																																							   	$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																																								}
 																																																																																																								return true;
 																																																																																																								break;
 																																																																																																								case "nether":
																																																																																																									$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																																									$item = Item::get(247, 0, 1);
 																																																																																																										if ($sender->getInventory()->contains(Item::get(3,0,100))) {
 																																																				                     	                                                                                          $sender->getInventory()->removeItem(Item::get(3,0,100));																																																																																																																																																																																																																																																																																																																																																																																																																																								
 																																																																																																												$sender->getInventory()->addItem($item); 																																																																																																												
 																																																																																																												$sender->sendMessage(TF::YELLOW . "Bạn Đổi Thành Công Nethet Reactor Core Với 100 Cục Đất");
																																																																																																												} else {
																																																																																																												$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																																											}
 																																																																																																											return true;
 																																																																																																											break;
 																																																																																																											case "bedrock":
																																																																																																												$p = $this->getServer()->getPlayer($sender->getName());
 																																																																																																												$item = Item::get(7, 0, 1);					
																																																																																																													if ($sender->getInventory()->contains(Item::get(49,0,10))) {
 																																																					                                                                                                                    $sender->getInventory()->removeItem(Item::get(49,0,10));																																																																																																																																																																																																																																																																																																																																																																																																																																						 																																																																																																														
 																																																																																																															$sender->getInventory()->addItem($item);																																																																																																												
 																																																																																																															$sender->sendMessage(TF::YELLOW . "Bạn Đã Đổi Thành Công Bedrock Với 10 Hắc Diện Thạch");
																																																																																																														} else {
																																																																																																															$sender->sendMessage("§9[§bTrade§9]§b» ".TF::RED . "Bạn Không Có Đủ Vật Phẩm Để Đổi");
 																																																																																																														}
 																																																																																																														return true;
																																																																																																														break;																																																																																										
 																																																																																																																												}
 																																																																																																																												return true;
 																																																																																																																											}
 																																																																																																																										}
 																																																																																																																									}
 																																																																																																																								}
 																																																																																																																							}
 																																																																																																																						}