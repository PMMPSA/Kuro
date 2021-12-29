<?php

namespace MyPlot;

use pocketmine\math\Vector3;
use pocketmine\level\ChunkManager;
use pocketmine\level\SimpleChunkManager;
use pocketmine\block\Block;
use pocketmine\level\generator\populator\Populator;
use pocketmine\utils\Random;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\tile\Tile;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\NBT;
use pocketmine\level\generator\Generator;
use pocketmine\level\format\Chunk;
use pocketmine\tile\Chest;
use pocketmine\item\Item;

class SkyBlockStructure extends Populator{
	public $generator = null;

	public function __construct(Generator $gen){
		$this->generator = $gen;
	}

	/**
	 *
	 * @param ChunkManager $level 
	 * @param Chunk $chunk 
	 * @param  $Xofchunk 
	 * @param  $Zofchunk 
	 */
	public static function placeObject(ChunkManager $level, $chunk, $Xofchunk, $Zofchunk){
		$vec = new Vector3($chunk->getX() * 16 + $Xofchunk, 0, $chunk->getZ() * 16 + $Zofchunk);
		$vec = $vec->subtract(7, 0, 7); // fix offset
		for($x = 4; $x < 11; $x++){
			for($z = 4; $z < 11; $z++){
				$level->setBlockIdAt($vec->x + $x, 64, $vec->z + $z, Block::GRASS);
			}
		}
		for($x = 4; $x < 11; $x++){
			for($z = 4; $z < 11; $z++){
				$level->setBlockIdAt($vec->x + $x, 63, $vec->z + $z, Block::STONE);
			}
		}
       for($x = 4; $x < 11; $x++){
          for($z = 4; $z < 11; $z ++){
             $level->setBlockIdAt($vec->x + $x, 62, $vec->z + $z, Block::STONE);
         }
      }
             $level->setBlockIdAt($vec->x + 10, 68, $vec->z + 4, Block::AIR); // 1
             $level->setBlockIdAt($vec->x + 10, 67, $vec->z + 4, Block::AIR); // 2
             $level->setBlockIdAt($vec->x + 10, 66, $vec->z + 4, Block::AIR); // 3
             $level->setBlockIdAt($vec->x + 4, 68, $vec->z + 4, Block::AIR); // 4
             $level->setBlockIdAt($vec->x + 4, 67, $vec->z + 4, Block::AIR); // 5
             $level->setBlockIdAt($vec->x + 4, 66, $vec->z + 4, Block::AIR); // 6
             $level->setBlockIdAt($vec->x + 4, 68, $vec->z + 10, Block::AIR);  // 7
             $level->setBlockIdAt($vec->x + 4, 67, $vec->z + 10, Block::AIR);  // 8
             $level->setBlockIdAt($vec->x + 4, 66, $vec->z + 10, Block::AIR); // 9
             $level->setBlockIdAt($vec->x + 10, 67, $vec->z + 10, Block::AIR); // 10
             $level->setBlockIdAt($vec->x + 10, 66, $vec->z + 10, Block::AIR);  // 11
             $level->setBlockIdAt($vec->x + 10, 66, $vec->z + 10, Block::AIR); // 12
             $level->setBlockIdAt($vec->x + 5, 65, $vec->z + 3, Block:: AIR); // 65
             $level->setBlockIdAt($vec->x + 3, 65, $vec->z + 9, Block::AIR); // 65 
             $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 9, Block::AIR); // 65
             $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 5, Block::AIR); // 65 
             $level->setBlockIdAt($vec->x + 7, 73, $vec->z + 5, Block::AIR); // 73
             $level->setBlockIdAt($vec->x + 7, 73, $vec->z + 9, Block::AIR); // 73 
             $level->setBlockIdAt($vec->x + 11, 73, $vec->z + 9, Block::AIR ); // 73 
             $level->setBlockIdAt($vec->x + 11, 73, $vec->z + 5, Block::AIR); // 73
             $level->setBlockIdAt($vec->x + 4, 66, $vec->z + 9, Block::AIR);  
             $level->setBlockIdAt($vec->x + 4, 66, $vec->z + 5, Block::AIR); 
             $level->setBlockIdAt($vec->x + 5, 66, $vec->z + 4, Block::AIR); 
             $level->setBlockIdAt($vec->x + 10, 66, $vec->z + 5, Block::AIR);
             $level->setBlockIdAt($vec->x + 10, 66, $vec->z + 9, Block::AIR); 
             $level->setBlockIdAt($vec->x + 9, 66, $vec->z + 4, Block::AIR); 
             $level->setBlockIdAt($vec->x + 9, 66, $vec->z + 10, Block::AIR);
             $level->setBlockIdAt($vec->x + 5, 66, $vec->z + 10, Block::AIR); 
             $level->setBlockIdAt($vec->x + 10, 68, $vec->z + 10, Block::AIR);
             $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 7, Block::LOG);
             $level->setBlockIdAt($vec->x + 9, 66, $vec->z + 7, Block::LOG); 
             $level->setBlockIdAt($vec->x + 9, 67, $vec->z + 7, Block::LOG); 
             $level->setBlockIdAt($vec->x + 9, 68, $vec->z + 7, Block::LOG); 
             $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 7, Block::LOG); 
             $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 7, Block::LOG);
             $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 9, 70, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 9, 67, $vec->z + 7, Block::LEAVES);
             $level->setBlockIdAt($vec->x + 9, 67, $vec->z + 8, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 8, 67, $vec->z + 7, Block::LEAVES);
             $level->setBlockIdAt($vec->x + 9, 67, $vec->z + 6, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 10, 69, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 8, 69, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 8, 70, $vec->z + 7, Block::LEAVES);
             $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 8, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 9, 70, $vec->z + 8, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 10, 69, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 10, 70, $vec->z + 7, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 9, 69, $vec->z + 6, Block::LEAVES);  
             $level->setBlockIdAt($vec->x + 9, 70, $vec->z + 6, Block::LEAVES); 
             $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 8, Block::LOG);
              $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 8, Block::LOG);
              $level->setBlockIdAt($vec->x + 10, 65, $vec->z + 7, Block::LOG);
              $level->setBlockIdAt($vec->x + 9, 65, $vec->z + 6, Block::LOG);
              $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 7, Block::WATER); 
              $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 8, Block::WATER);
              $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 8, Block::WATER);
              $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 9, Block::WATER);
              $level->setBlockIdAt($vec->x + 9, 64, $vec->z + 9, Block::WATER);
              $level->setBlockIdAt($vec->x + 7, 64, $vec->z + 5, Block::WATER);
              $level->setBlockIdAt($vec->x + 8, 64, $vec->z + 8, Block::LILY_PAD);
              $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 9, Block::SUGARCANE_BLOCK);
              $level->setBlockIdAt($vec->x + 7, 66, $vec->z + 9, Block::SUGARCANE_BLOCK);
              $level->setBlockIdAt($vec->x + 7, 67, $vec->z + 9, Block::SUGARCANE_BLOCK);    
              $level->setBlockIdAt($vec->x + 5, 64, $vec->z + 5, Block::FENCE);
              $level->setBlockIdAt($vec->x + 6, 64, $vec->z + 5, Block::STONE);
              $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 4, Block::FENCE);
              $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 4, Block::FENCE); 
              $level->setBlockIdAt($vec->x + 5, 65, $vec->z + 4, Block::FENCE);
              $level->setBlockIdAt($vec->x + 7, 65, $vec->z + 6, Block::HAY_BALE);
              $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 6, Block::HAY_BALE);
              $level->setBlockIdAt($vec->x + 8, 66, $vec->z + 6, Block::HAY_BALE);
               $level->setBlockIdAt($vec->x + 8, 65, $vec->z + 5, Block::HAY_BALE);
              $level->setBlockIdAt($vec->x + 5, 63, $vec->z + 7, Block::DIAMOND_ORE);
              $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 7, Block::CRAFTING_TABLE);
              $level->setBlockIdAt($vec->x + 6, 65, $vec->z + 8, Block::FURNACE);
	}

	public function populate(ChunkManager $level, $chunkX, $chunkZ, Random $random){
		$chunk = $level->getChunk($chunkX, $chunkZ);
		$shape = $this->generator->getShape($chunkX << 4, $chunkZ << 4);
		for($Z = 0; $Z < 16; ++$Z){
			for($X = 0; $X < 16; ++$X){
				$type = $shape[($Z << 4) | $X];
				if($type === MyPlotGenerator::ISLAND){
					self::placeObject($level, $chunk, $X, $Z);
				}
			}
		}
	}
}