<?php

namespace HyperEnte\Perks;

use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\utils\Config;

class EventListener implements Listener{
	public function onJoin(PlayerJoinEvent $event){
		$player = $event->getPlayer();
		if($player->hasPlayedBefore()){
			if(Perks::getMain()->getConfig()->get("joinmessage") === "true") {
				$player->sendMessage(Perks::getMain()->getConfig()->get("join"));
				$config = new Config(Perks::getMain()->getDataFolder() . "perks.json", Config::JSON);
				$name = $player->getName();
				$perk = $config->get("$name");
				if ($perk["fly"] === "active") {
					$player->sendMessage("§7- Fly [§aActive§7]");
					$player->setAllowFlight(TRUE);
					$player->setFlying(TRUE);
				}
				if ($perk["fly"] === "owned") {
					$player->sendMessage("§7- Fly [§eOwned§7]");
				}
				if ($perk["fly"] === "not-owned") {
					$player->sendMessage("§7- Fly [§cNot Owned§7]");
				}
				if ($perk["hunger"] === "active") {
					$player->sendMessage("§7- No Hunger [§aActive§7]");
				}
				if ($perk["hunger"] === "owned") {
					$player->sendMessage("§7- No Hunger [§eOwned§7]");
				}
				if ($perk["hunger"] === "not-owned") {
					$player->sendMessage("§7- No Hunger [§cNot Owned§7]");
				}
				if ($perk["smelt"] === "active") {
					$player->sendMessage("§7- Autosmelt [§aActive§7]");
				}
				if ($perk["smelt"] === "owned") {
					$player->sendMessage("§7- Autosmelt [§eOwned§7]");
				}
				if ($perk["smelt"] === "not-owned") {
					$player->sendMessage("§7- Autosmelt [§cNot Owned§7]");
				}
				if ($perk["doublehealth"] === "active") {
					$player->sendMessage("§7- Doublehealth [§aActive§7]");
				}
				if ($perk["doublehealth"] === "owned") {
					$player->sendMessage("§7- Doublehealth [§eOwned§7]");
				}
				if ($perk["doublehealth"] === "not-owned") {
					$player->sendMessage("§7- Doublehealth [§cNot Owned§7]");
				}
			}
			$config = new Config(Perks::getMain()->getDataFolder() . "perks.json", Config::JSON);
			$name = $player->getName();
			$perk = $config->get("$name");
			if($perk["doublehealth"] === "active"){
				$player->setMaxHealth(40);
				$player->setHealth(40);
			}
		}
		if(!$player->hasPlayedBefore()){
			$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
			if($config->get($player->getName()) == false) {
				$config->set($player->getName(), ["fly" => "not-owned", "hunger" => "not-owned", "smelt" => "not-owned", "doublehealth" => "not-owned"]);
				$config->save();
			}
		}
	}
	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		$config = new Config(Perks::getMain()->getDataFolder()."perks.json", Config::JSON);
		$name = $player->getName();
		$perk = $config->get("$name");
		if($perk["hunger"] === "active"){
			$player->setFood(20);
			$player->setSaturation(20);
		}
	}
	public function onBreak(BlockBreakEvent $event){
		$block = $event->getBlock();
		$player = $event->getPlayer();
		$config = new Config(Perks::getMain()->getDataFolder() . "perks.json", Config::JSON);
		$name = $player->getName();
		$perk = $config->get("$name");
		if ($perk["smelt"] === "active") {
			if ($block->getId() == Block::COBBLESTONE) {
				$event->setDrops([Item::get(Item::STONE)]);
			}
			if ($block->getId() == Block::IRON_ORE) {
				$event->setDrops([Item::get(Item::IRON_INGOT)]);
			}
			if ($block->getId() == Block::GOLD_ORE) {
				$event->setDrops([Item::get(Item::GOLD_INGOT)]);
			}
			if ($block->getId() == Block::CACTUS) {
				$event->setDrops([Item::get(Item::DYE, 2, 1)]);
			}
			if ($block->getId() == Block::NETHERRACK) {
				$event->setDrops([Item::get(Item::NETHER_BRICK)]);
			}
			if ($block->getId() == Block::SAND) {
				$event->setDrops([Item::get(Item::GLASS)]);
			}
			if ($block->getId() == Block::WOOD || $block->getId() == Block::WOOD2) {
				$event->setDrops([Item::get(Item::COAL, 1, 1)]);
			}
		}
	}
}