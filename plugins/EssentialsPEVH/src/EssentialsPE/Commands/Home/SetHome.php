<?php
namespace EssentialsPE\Commands\Home;

use EssentialsPE\BaseFiles\BaseAPI;
use EssentialsPE\BaseFiles\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class SetHome extends BaseCommand{
    /**
     * @param BaseAPI $api
     */
    public function __construct(BaseAPI $api){
        parent::__construct($api, "sethome", "Create or update a home position", "<name>", false, ["createhome"]);
        $this->setPermission("essentials.sethome");
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
        if(!$sender instanceof Player || count($args) !== 1){
            $this->sendUsage($sender, $alias);
            return false;
        }
        if(strtolower($args[0]) === "bed"){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Bạn chỉ có thể chỉnh \"bed\" nhà khi ngủ ở trên giường");
            return false;
        }elseif(trim($args[0] === "")){
            $sender->sendMessage(TextFormat::RED . "[Lỗi] Vui lòng cung cấp tên nhà");
            return false;
        }
        if(!$this->getAPI()->setHome($sender, strtolower($args[0]), $sender->getLocation(), $sender->getYaw(), $sender->getPitch())){
            $sender->sendMessage(TextFormat::RED . "Tên nhà không hợp lệ! Hãy chắc chắn bạn chỉ sử dụng kí tự chữ, số và dấu gạch ngang");
            return false;
        }
        $sender->sendMessage(TextFormat::GREEN . "Tạo nhà thành công " . ($this->getAPI()->homeExists($sender, $args[0]) ? "updated" : "created"));
        return true;
    }
} 
