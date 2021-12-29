<?php 

namespace KhoaGamingPro\FrameKeeper;

use pocketmine\plugin\PluginBase as CuHuu_KuT;
use pocketmine\Server as XYETA_TBOU_SERVER;
class main extends CuHuu_KuT{public function onEnable(){XYETA_TBOU_SERVER::getInstance()->getPluginManager()->registerEvents(new events($this), $this);XYETA_TBOU_SERVER::getInstance()->getLogger()->info("§b[§eFrameKeeper §dv1.1§b]§a Đã kích hoạt thành công!");}}