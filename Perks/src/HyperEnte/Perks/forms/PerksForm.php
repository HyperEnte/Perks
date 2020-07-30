<?php

namespace HyperEnte\Perks\forms;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\Player;
use HyperEnte\Perks\Perks;
use pocketmine\utils\Config;


class PerksForm extends SimpleForm{
	public function __construct()
	{
		$callable = function (Player $player, $data){
			if($data === 0){
				return;
			}
			if($data === 1){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $player->getName();
				$perk = $config->get("$name");
				if($perk["fly"] === "active"){
					$player->sendMessage(Perks::PREFIX."§cYou deactivated Fly");
					$array = (array)$config->get("$name");
					$array["fly"] = "owned";
					$config->set("$name", $array);
					$config->save();
					$player->setAllowFlight(false);
					$player->setFlying(false);
				}
				if($perk["fly"] === "owned"){
					$player->sendMessage(Perks::PREFIX."§aYou activated Fly");
					$array = (array)$config->get("$name");
					$array["fly"] = "active";
					$config->set("$name", $array);
					$config->save();
					$player->setAllowFlight(true);
					$player->setFlying(true);
					$player->addEffect(new EffectInstance(Effect::getEffect(9), 120, 5));
					$player->addTitle("§aFly enabled");
				}
				if($perk["fly"] === "not-owned"){
					$player->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("noperm"));
				}
			}
			if($data === 2){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $player->getName();
				$perk = $config->get("$name");
				if($perk["hunger"] === "active"){
					$player->sendMessage(Perks::PREFIX."§cYou deactivated no-hunger");
					$array = (array)$config->get("$name");
					$array["hunger"] = "owned";
					$config->set("$name", $array);
					$config->save();
				}
				if($perk["hunger"] === "owned"){
					$player->sendMessage(Perks::PREFIX."§aYou activated no-hunger");
					$array = (array)$config->get("$name");
					$array["hunger"] = "active";
					$config->set("$name", $array);
					$config->save();
					$player->addEffect(new EffectInstance(Effect::getEffect(9), 120, 5));
					$player->addTitle(" §aNo-hunger activated");
				}
				if($perk["hunger"] === "not-owned"){
					$player->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("noperm"));
				}
			}
			if($data === 3){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $player->getName();
				$perk = $config->get("$name");
				if($perk["smelt"] === "active"){
					$player->sendMessage(Perks::PREFIX."§cYou deactivated smelt");
					$array = (array)$config->get("$name");
					$array["smelt"] = "owned";
					$config->set("$name", $array);
					$config->save();
				}
				if($perk["smelt"] === "owned"){
					$player->sendMessage(Perks::PREFIX."§aYou activated smelt");
					$array = (array)$config->get("$name");
					$array["smelt"] = "active";
					$config->set("$name", $array);
					$config->save();
					$player->addEffect(new EffectInstance(Effect::getEffect(9), 120, 5));
					$player->addTitle("§aAutosmelt activated");
				}
				if($perk["smelt"] === "not-owned"){
					$player->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("noperm"));
				}
			}
			if($data === 4){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $player->getName();
				$perk = $config->get("$name");
				if($perk["doublehealth"] === "active"){
					$player->sendMessage(Perks::PREFIX."§cYou deactivated Doublehealth");
					$array = (array)$config->get("$name");
					$array["doublehealth"] = "owned";
					$config->set("$name", $array);
					$config->save();
					$player->setMaxHealth(20);
				}
				if($perk["doublehealth"] === "owned"){
					$player->sendMessage(Perks::PREFIX."§aYou activated Doublehealth");
					$array = (array)$config->get("$name");
					$array["doublehealth"] = "active";
					$config->set("$name", $array);
					$config->save();
					$player->setMaxHealth(40);
					$player->setHealth(40);
					$player->addEffect(new EffectInstance(Effect::getEffect(9), 120, 5));
					$player->addTitle("§aDoublehealth activated");
				}
				if($perk["doublehealth"] === "not-owned"){
					$player->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("noperm"));
				}
			}
		};
		parent::__construct($callable);
		$this->setTitle(Perks::getMain()->getConfig()->get("titel"));
		$this->addButton("Leave", 0, "textures/ui/permissions_visitor_hand");
		$this->addButton("Fly Perk", 0, "textures/".Perks::getMain()->getConfig()->get("fly-perk-image"));
		$this->addButton("No-Hunger Perk", 0, "textures/".Perks::getMain()->getConfig()->get("hunger-perk-image"));
		$this->addButton("Smelt Perk", 0, "textures/".Perks::getMain()->getConfig()->get("smelt-perk-image"));
		$this->addButton("Doublehealth Perk", 0, "textures/".Perks::getMain()->getConfig()->get("doublehealth-perk-image"));
	}
}
