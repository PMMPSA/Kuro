<?php

/* 
 * The MIT License
 *
 * Copyright 2015 Jack Noordhuis (CrazedMiner) CrazedMiner.weebly.com.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace jacknoordhuis\morecommands;

use jacknoordhuis\morecommands\commands\Spawn;
use jacknoordhuis\morecommands\commands\Hub;
use jacknoordhuis\morecommands\commands\Lobby;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class Main extends PluginBase {
    
  public function onLoad() {
        $this->getLogger()->info(TextFormat::YELLOW . "Loading MoreCommands v1.0 By CrazedMiner....");
    }
    
    public function onEnable() {
        if(!file_exists($this->getDataFolder() . "config.yml")) {
            @mkdir($this->getDataFolder());
             file_put_contents($this->getDataFolder() . "config.yml",$this->getResource("config.yml"));
        }
        $this->getCommand("spawn")->setExecutor(new Spawn($this));
        $this->getCommand("hub")->setExecutor(new Hub($this));
        $this->getCommand("lobby")->setExecutor(new Lobby($this));
        $this->getLogger()->info(TextFormat::GREEN . "MoreCommands v1.0 By CrazedMiner Enabled!");
    }
    
    public function onDisable() {
        $this->getLogger()->info(TextFormat::LIGHT_PURPLE . "MoreCommands v1.0 By CrazedMiner Disabled!");
    }
}
