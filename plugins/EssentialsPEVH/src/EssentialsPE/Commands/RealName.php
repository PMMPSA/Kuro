<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class RealName extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "realname", "Check the real name of a player", "<player>");
        $this->setPermission("essentials.realname");
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
        if(count($args) != 1){
            $this->sendUsage($sender, $alias);
            return false;
        }
        if(!($player = $this->getAPI()->getPlayer($args[0]))){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Không tìm thấy người chơi này");
            return false;
        }
        $sender->sendMessage(TextFormat::YELLOW .  $player->getDisplayName() . (substr($player->getName(), -1, 1) === "s" ? "'" : "'s") . " Tên thật là: " . TextFormat::RED . $player->getName());
        return true;
    }
}
