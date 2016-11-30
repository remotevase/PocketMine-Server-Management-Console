<?php

namespace pm-helper;
class logger{
	
	if(version_compare("7.0", PHP_VERSION) > 0){
		echo "[CRITICAL] You must use PHP >= 7.0" . PHP_EOL;
		echo "[CRITICAL] Please use the installer provided on the homepage." . PHP_EOL;
		exit(1);
	}
	if(!extension_loaded("pthreads")){
		echo "[CRITICAL] Unable to find the pthreads extension." . PHP_EOL;
		echo "[CRITICAL] Please use the installer provided on the homepage." . PHP_EOL;
		exit(1);
	}
	if(!class_exists("ClassLoader", false)){
		require_once(\pocketmine\PATH . "src/spl/ClassLoader.php");
		require_once(\pocketmine\PATH . "src/spl/BaseClassLoader.php");
		require_once(\pocketmine\PATH . "src/pocketmine/CompatibleClassLoader.php");
	}
	$autoloader = new CompatibleClassLoader();
	$autoloader->addPath(\pocketmine\PATH . "src");
	$autoloader->addPath(\pocketmine\PATH . "src" . DIRECTORY_SEPARATOR . "spl");
	$autoloader->register(true);
	set_time_limit(0); //Who set it to 30 seconds?!?!
	gc_enable();
	error_reporting(-1);
	ini_set("allow_url_fopen", 1);
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	ini_set("default_charset", "utf-8");
	ini_set("memory_limit", -1);
	define('pocketmine\START_TIME', microtime(true));
	$opts = getopt("", ["data:", "plugins:", "no-wizard", "enable-profiler"]);
	define('pocketmine\DATA', isset($opts["data"]) ? $opts["data"] . DIRECTORY_SEPARATOR : \getcwd() . DIRECTORY_SEPARATOR);
	define('pocketmine\PLUGIN_PATH', isset($opts["plugins"]) ? $opts["plugins"] . DIRECTORY_SEPARATOR : \getcwd() . DIRECTORY_SEPARATOR . "plugins" . DIRECTORY_SEPARATOR);
	Terminal::init();
	define('pocketmine\ANSI', Terminal::hasFormattingCodes());
	if(!file_exists(\pocketmine\DATA)){
		mkdir(\pocketmine\DATA, 0777, true);
	}
	//Logger has a dependency on timezone, so we'll set it to UTC until we can get the actual timezone.
	date_default_timezone_set("UTC");
	$logger = new MainLogger(\pocketmine\DATA . "server.log", \pocketmine\ANSI);
	if(!ini_get("date.timezone")){
		if(($timezone = detect_system_timezone()) and date_default_timezone_set($timezone)){
			//Success! Timezone has already been set and validated in the if statement.
			//This here is just for redundancy just in case some program wants to read timezone data from the ini.
			ini_set("date.timezone", $timezone);
		}else{
			//If system timezone detection fails or timezone is an invalid value.
			if($response = Utils::getURL("http://ip-api.com/json")
				and $ip_geolocation_data = json_decode($response, true)
				and $ip_geolocation_data['status'] !== 'fail'
				and date_default_timezone_set($ip_geolocation_data['timezone'])
			){
				//Again, for redundancy.
				ini_set("date.timezone", $ip_geolocation_data['timezone']);
			}else{
				ini_set("date.timezone", "UTC");
				date_default_timezone_set("UTC");
				$logger->warning("Timezone could not be automatically determined. An incorrect timezone will result in incorrect timestamps on console logs. It has been set to \"UTC\" by default. You can change it on the php.ini file.");
			}
		}
	}else{
		/*
		 * This is here so that people don't come to us complaining and fill up the issue tracker when they put
		 * an incorrect timezone abbreviation in php.ini apparently.
		 */
		$timezone = ini_get("date.timezone");
		if(strpos($timezone, "/") === false){
			$default_timezone = timezone_name_from_abbr($timezone);
			ini_set("date.timezone", $default_timezone);
			date_default_timezone_set($default_timezone);
		} else {
			date_default_timezone_set($timezone);
		}
	}
	function detect_system_timezone(){
		switch(Utils::getOS()){
			case 'win':
				$regex = '/(UTC)(\+*\-*\d*\d*\:*\d*\d*)/';
				/*
				 * wmic timezone get Caption
				 * Get the timezone offset
				 *
				 * Sample Output var_dump
				 * array(3) {
				 *	  [0] =>
				 *	  string(7) "Caption"
				 *	  [1] =>
				 *	  string(20) "(UTC+09:30) Adelaide"
				 *	  [2] =>
				 *	  string(0) ""
				 *	}
				 */
				exec("wmic timezone get Caption", $output);
				$string = trim(implode("\n", $output));
				//Detect the Time Zone string
				preg_match($regex, $string, $matches);
				if(!isset($matches[2])){
					return false;
				}
				$offset = $matches[2];
				if($offset == ""){
					return "UTC";
				}
				return parse_offset($offset);
				break;
			case 'linux':
				// Ubuntu / Debian.
				if(file_exists('/etc/timezone')){
					$data = file_get_contents('/etc/timezone');
					if($data){
						return trim($data);
					}
				}
				// RHEL / CentOS
				if(file_exists('/etc/sysconfig/clock')){
					$data = parse_ini_file('/etc/sysconfig/clock');
					if(!empty($data['ZONE'])){
						return trim($data['ZONE']);
					}
				}
				//Portable method for incompatible linux distributions.
				$offset = trim(exec('date +%:z'));
				if($offset == "+00:00"){
					return "UTC";
				}
				return parse_offset($offset);
				break;
			case 'mac':
				if(is_link('/etc/localtime')){
					$filename = readlink('/etc/localtime');
					if(strpos($filename, '/usr/share/zoneinfo/') === 0){
						$timezone = substr($filename, 20);
						return trim($timezone);
					}
				}
				return false;
				break;
			default:
				return false;
				break;
		}
	}


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
