<?php

namespace HyperEnte\Perks\commands;

use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use HyperEnte\Perks\Perks;
use HyperEnte\Perks\forms\PerksForm;
use pocketmine\Player;


class PerksCommand extends PluginCommand{
	public function __construct(){
		parent::__construct("perks", Perks::getMain());
		$this->setDescription("Open the perk form");
	}
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$sender instanceof Player) return;
		if($sender instanceof Player){
			$sender->sendForm(new PerksForm());
		}
	}
}