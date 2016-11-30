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
		
		echo "\n[?] " . $this->lang->accept_license . " (y/N): ";
		if(strtolower($this->getInput("n")) != "y"){
			echo "[!] " . $this->lang->you_have_to_accept_the_license . "\n";
			sleep(5);
			return false;
		}
		return true;
	}
}
