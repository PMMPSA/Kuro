<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class KickAll extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "kickall", "Kick all the players", "<reason>");
        $this->setPermission("essentials.kickall");
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
        if(($count = count($this->getAPI()->getServer()->getOnlinePlayers())) < 1 || ($sender instanceof Player && $count < 2)){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Không có thêm người chơi nào trong máy chủ");
            return false;
        }
        if(count($args) < 1){
            $reason = "Unknown";
        }else{
            $reason = implode(" ", $args);
        }
        foreach($this->getAPI()->getServer()->getOnlinePlayers() as $p){
            if($p != $sender){
                $p->kick($reason, false);
            }
        }
        $sender->sendMessage(TextFormat::AQUA . "Đuổi tất cả người chơi ra khỏi máy chủ!");
        return true;
    }
}
