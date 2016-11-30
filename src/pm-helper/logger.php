<?php

namespace pm-helper;
class logger{
	

	public function getDefaultLang(){
		return $this->defaultLang;
	}
	private function showLicense(){
		echo "Welcome to the PocketMine Console Helper!\n";
		echo "Choice 1: Install PocketMine";
		echo "Choice 2: Update the PocketMine phar";
		echo "Choice 3: Install a plugin";
		echo "Choice 4: Download a Minecraft PC Edition world, and convert it for use on your server";
		echo "Choice 5: Start your server normally";
		echo "Choice 6: Start your server in a loop, so that it is online 24/7";
		echo "Choice 7: Stop your server";
		
		echo "\n[?] " . $this->lang->accept_license . " (y/N): ";
		if(strtolower($this->getInput("n")) != "y"){
			echo "[!] " . $this->lang->you_have_to_accept_the_license . "\n";
			sleep(5);
			return false;
		}
		return true;
	}
}
