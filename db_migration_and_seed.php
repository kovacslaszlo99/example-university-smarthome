<?php
/*import config*/
require_once ("./src/Config.php");
require_once ("./src/DB.php");

$host = Config::get("db.hostname");
$username = Config::get("db.username");
$password = Config::get("db.password");
$db_name =  Config::get("db.datebase_name");

try {
	$dbh = new PDO("mysql:host=$host", $username, $password);

	$dbh->exec("CREATE DATABASE IF NOT EXISTS `" . $db_name . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;")
	or die(print_r($dbh->errorInfo(), true));

}
catch (PDOException $e) {
	die("DB ERROR: " . $e->getMessage());
}

try{
	$myfile = fopen("smarthome.sql", "r") or die("Unable to open file!");
	$sql_command = fread($myfile,filesize("smarthome.sql"));
	fclose($myfile);
	$db = new DB();
	$res = $db->sql($sql_command);
	var_dump($res);
}catch (Exception $e) {
	fclose($myfile);
	echo 'Caught exception: ',  $e->getMessage(), "\n";
}