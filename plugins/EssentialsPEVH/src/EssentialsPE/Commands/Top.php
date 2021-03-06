<?php
namespace EssentialsPE\Commands;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\math\Vector3;

class Top extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "top", "Teleport to the highest block above you", null, false);
        $this->setPermission("essentials.top");
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
        if(!$sender instanceof Player || count($args) !== 0){
            $this->sendUsage($sender, $alias);
            return false;
        }
        $sender->sendMessage(TextFormat::YELLOW . "Dịch chuyển...");
        $sender->teleport(new Vector3($sender->getX(), $sender->getLevel()->getHighestBlockAt($sender->getX(), $sender->getZ()) + 1, $sender->getZ())); 
        return true;
    }
}
