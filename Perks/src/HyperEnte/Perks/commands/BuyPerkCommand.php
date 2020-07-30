<?php

namespace HyperEnte\Perks\commands;

use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use HyperEnte\Perks\Perks;
use pocketmine\Player;
use onebone\economyapi\EconomyAPI;
use ben\bedrockcoins\BedrockCoins;
use pocketmine\utils\Config;


class BuyPerkCommand extends PluginCommand{
	public function __construct(){
		parent::__construct("buyperk", Perks::getMain());
		$this->setDescription("Buy a perk");
	}
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player) return true;
			if(count($args) < 1){
				$sender->sendMessage(Perks::PREFIX."§cPlease use /buyperk [fly/nohunger/smelt/doublehealth]");
				return false;
			}
			if(strtolower($args[0]) === "fly"){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $sender->getName();
				$perk = $config->get("$name");
				if($perk["fly"] === "active"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["fly"] === "owned"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["fly"] === "not-owned"){
					if(Perks::getMain()->getConfig()->get("economyapi") === "true"){
						$money = EconomyAPI::getInstance()->getMoney($sender);
						if($money >= Perks::getMain()->getConfig()->get("fly")){
							EconomyAPI::getInstance()->reduceMoney($sender, Perks::getMain()->getConfig()->get("fly"));
							$sender->sendMessage(Perks::PREFIX."You bought the fly perk");
							$array = (array)$config->get("$name");
							$array["fly"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("fly")) {
							$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
					if(Perks::getMain()->getConfig()->get("bedrockcoins") === "true"){
						$money = BedrockCoins::getInstance()->getCoins($sender->getName());
						if($money >= Perks::getMain()->getConfig()->get("fly")){
							BedrockCoins::getInstance()->removeCoins($sender->getName(), Perks::getMain()->getConfig()->get("fly"));
							$sender->sendMessage(Perks::PREFIX."You bought the fly perk");
							$array = (array)$config->get("$name");
							$array["fly"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("fly")) {
							$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
				}
			}
			if(strtolower($args[0]) === "nohunger"){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $sender->getName();
				$perk = $config->get("$name");
				if($perk["hunger"] === "active"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["hunger"] === "owned"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["hunger"] === "not-owned"){
					if(Perks::getMain()->getConfig()->get("economyapi") === "true"){
						$money = EconomyAPI::getInstance()->getMoney($sender);
						if($money >= Perks::getMain()->getConfig()->get("hunger")){
							EconomyAPI::getInstance()->reduceMoney($sender, Perks::getMain()->getConfig()->get("hunger"));
							$sender->sendMessage(Perks::PREFIX."You bought the no-hunger perk");
							$array = (array)$config->get("$name");
							$array["hunger"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("hunger")) {
							$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
					if(Perks::getMain()->getConfig()->get("bedrockcoins") === "true"){
						$money = BedrockCoins::getInstance()->getCoins($sender->getName());
						if($money >= Perks::getMain()->getConfig()->get("hunger")){
							BedrockCoins::getInstance()->removeCoins($sender->getName(), Perks::getMain()->getConfig()->get("hunger"));
							$sender->sendMessage(Perks::PREFIX."You bought the no-hunger perk");
							$array = (array)$config->get("$name");
							$array["hunger"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("hunger")) {
							$sender->sendMessage(Perks::PREFIX.Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
				}
			}
			if(strtolower($args[0]) === "smelt"){
				$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
				$name = $sender->getName();
				$perk = $config->get("$name");
				if($perk["smelt"] === "active"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["smelt"] === "owned"){
					$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
				}
				if($perk["smelt"] === "not-owned"){
					if(Perks::getMain()->getConfig()->get("economyapi") === "true"){
						$money = EconomyAPI::getInstance()->getMoney($sender);
						if($money >= Perks::getMain()->getConfig()->get("smelt")){
							EconomyAPI::getInstance()->reduceMoney($sender, Perks::getMain()->getConfig()->get("smelt"));
							$sender->sendMessage(Perks::PREFIX."You bought the smelt perk");
							$array = (array)$config->get("$name");
							$array["smelt"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("smelt")) {
							$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
					if(Perks::getMain()->getConfig()->get("bedrockcoins") === "true"){
						$money = BedrockCoins::getInstance()->getCoins($sender->getName());
						if($money >= Perks::getMain()->getConfig()->get("smelt")){
							BedrockCoins::getInstance()->removeCoins($sender->getName(), Perks::getMain()->getConfig()->get("smelt"));
							$sender->sendMessage(Perks::PREFIX."You bought the smelt perk");
							$array = (array)$config->get("$name");
							$array["smelt"] = "owned";
							$config->set("$name", $array);
							$config->save();
						}
						if($money < Perks::getMain()->getConfig()->get("smelt")) {
							$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
						}
					}
				}
			}
		if(strtolower($args[0]) === "doublehealth"){
			$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
			$name = $sender->getName();
			$perk = $config->get("$name");
			if($perk["doublehealth"] === "active"){
				$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
			}
			if($perk["doublehealth"] === "owned"){
				$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail1"));
			}
			if($perk["doublehealth"] === "not-owned"){
				if(Perks::getMain()->getConfig()->get("economyapi") === "true"){
					$money = EconomyAPI::getInstance()->getMoney($sender);
					if($money >= Perks::getMain()->getConfig()->get("doublehealth")){
						EconomyAPI::getInstance()->reduceMoney($sender, Perks::getMain()->getConfig()->get("doublehealth"));
						$sender->sendMessage(Perks::PREFIX."You bought the doublehealth perk");
						$array = (array)$config->get("$name");
						$array["doublehealth"] = "owned";
						$config->set("$name", $array);
						$config->save();
					}
					if($money < Perks::getMain()->getConfig()->get("doublehealth")) {
						$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
					}
				}
				if(Perks::getMain()->getConfig()->get("bedrockcoins") === "true"){
					$money = BedrockCoins::getInstance()->getCoins($sender->getName());
					if($money >= Perks::getMain()->getConfig()->get("doublehealth")){
						BedrockCoins::getInstance()->removeCoins($sender->getName(), Perks::getMain()->getConfig()->get("doublehealth"));
						$sender->sendMessage(Perks::PREFIX."You bought the doublehealth perk");
						$array = (array)$config->get("$name");
						$array["doublehealth"] = "owned";
						$config->set("$name", $array);
						$config->save();
					}
					if($money < Perks::getMain()->getConfig()->get("doublehealth")) {
						$sender->sendMessage(Perks::PREFIX.Perks::getMain()->getConfig()->get("buyperk-fail2"));
					}
				}
			}
		}
	}
}