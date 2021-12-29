<?php
namespace EssentialsPE\Commands\Teleport;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class TPAccept extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "tpaccept", "Accept a teleport request", "[player]", false, ["tpyes"]);
        $this->setPermission("essentials.tpaccept");
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
        if(!$sender instanceof Player){
            $this->sendUsage($sender, $alias);
            return false;
        }
        if(!($request = $this->getAPI()->hasARequest($sender))){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Bạn không có yêu cầu dịch chuyển nào");
            return false;
        }
        switch(count($args)){
            case 0:
                if(!($player = $this->getAPI()->getPlayer(($name = $this->getAPI()->getLatestRequest($sender))))){
                    $sender->sendMessage(TextFormat::RED . "[Lỗi] Lời mời không có sẵn");
                    return false;
                }
                break;
            case 1:
                if(!($player = $this->getAPI()->getPlayer($args[0]))){
                    $sender->sendMessage(TextFormat::RED . "[Lỗi] Không tìm thấy người chơi này");
                    return false;
                }
                if(!($request = $this->getAPI()->hasARequestFrom($sender, $player))){
                    $sender->sendMessage(TextFormat::RED . "[Lỗi] Bạn không có yêu cầu từ " . TextFormat::AQUA . $player->getDisplayName());
                    return false;
                }
                break;
            default:
                $this->sendUsage($sender, $alias);
                return false;
                break;
        }
        $player->sendMessage(TextFormat::AQUA . $sender->getDisplayName() . TextFormat::GREEN . " chấp nhận yêu cầu của bạn! Dịch chuyển...");
        $sender->sendMessage(TextFormat::GREEN . "Dịch chuyển...");
        $request = $this->getAPI()->hasARequestFrom($sender, $player);
        if($request === "tphere"){
            $sender->teleport($player);
        }else{
            $player->teleport($sender);
        }
        $this->getAPI()->removeTPRequest($player, $sender);
        return true;
    }
} 
