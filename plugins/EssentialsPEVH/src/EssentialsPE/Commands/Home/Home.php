<?php
namespace EssentialsPE\Commands\Home;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Home extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "home", "Teleport to your home", "<name>", false, ["homes"]);
        $this->setPermission("essentials.home.use");
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
        if(!$sender instanceof Player || count($args) > 1){
            $this->sendUsage($sender, $alias);
            return false;
        }
        if(count($args) === 0){
            if(($list = $this->getAPI()->homesList($sender, false)) === false){
                $sender->sendMessage(TextFormat::AQUA . "Bạn chưa có một căn nhà nào");
                return false;
            }
            $sender->sendMessage(TextFormat::AQUA . "Có nhà tại:\n" . $list);
            return true;
        }
        if(!($home = $this->getAPI()->getHome($sender, $args[0]))){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Bạn chưa có nhà hoặc không khả dụng ở thế giới này");
            return false;
        }
        $sender->teleport($home);
        $sender->sendMessage(TextFormat::GREEN . "Dịch chuyển đến nhà của bạn " . TextFormat::AQUA . $home->getName() . TextFormat::GREEN . "...");
        return true;
    }
} 