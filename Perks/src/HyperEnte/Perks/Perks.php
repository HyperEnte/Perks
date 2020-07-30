<?php

namespace HyperEnte\Perks;

use HyperEnte\Perks\commands\BuyPerkCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use HyperEnte\Perks\commands\PerksCommand;

class Perks extends PluginBase{
	public const PREFIX = "§5HyperPerks §8» §r";
	private static $main;
	public function onEnable(){
		self::$main = $this;
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
		$config = new Config($this->getDataFolder()."perks.json", Config::JSON);
		$config->save();
		$this->getServer()->getCommandMap()->registerAll("Perks",
		[
			new PerksCommand(),
			new BuyPerkCommand()
		]);
		$this->getScheduler()->scheduleRepeatingTask(new PerkTask(), 20);
	}
	public static function getMain(): self{
		return self::$main;
	}
	public function exist(string $name){
		$config = new Config($this->getDataFolder()."perks.json", Config::JSON);
		$config->get($name);
	}
}