<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Fly extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "fly", "Bay trong chế độ sinh tồn và chế độ phiêu lưu", "[player]");
        $this->setPermission("essentials.fly.use");
    }

    /**
     * @param CommandSender $sender
     * @param string $alias
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, $alias, array $args): bool{
        if(!$this->testPermission($sender)){
            return false;
        }
        if((!isset($args[0]) && !$sender instanceof Player) || count($args) > 1){
            $this->sendUsage($sender, $alias);
            return false;
        }
        $player = $sender;
        if(isset($args[0])){
            if(!$sender->hasPermission("essentials.fly.other")){
                $sender->sendMessage(TextFormat::RED . $this->getPermissionMessage());
                return false;
            }elseif(!($player = $this->getAPI()->getPlayer($args[0]))){
                $sender->sendMessage(TextFormat::RED . "[Lỗi] Không tìm thấy người chơi này");
                return false;
            }
        }
        $this->getAPI()->switchCanFly($player);
        $player->sendMessage(TextFormat::YELLOW . "Chế độ bay " . ($this->getAPI()->canFly($player) ? "được bật" : "bị vô hiệu hóa") . "!");
        if($player !== $sender){
            $sender->sendMessage(TextFormat::YELLOW . "Chế độ bay " . ($this->getAPI()->canFly($player) ? "được bật" : "bị vô hiệu hóa") . " cho " . $player->getDisplayName());
        }
        return true;
    }
}