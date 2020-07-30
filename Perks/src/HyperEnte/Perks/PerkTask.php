<?php

namespace HyperEnte\Perks;

use HyperEnte\Perks\Perks;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as f;
use pocketmine\utils\Config;

class PerkTask extends Task {

	public $pl;

	public function onRun(int $currentTick)
	{
		foreach(Perks::getMain()->getServer()->getOnlinePlayers() as $player) {
			$name = $player->getName();
			$config = new Config(Perks::getMain()->getDataFolder() . "perks.json", Config::JSON);
			$info = $config->get("$name");
			$fly = $info["fly"];
			$hunger = $info["hunger"];
			$smelt = $info["smelt"];
			$doublehealth = $info["doublehealth"];
		}
	}

}