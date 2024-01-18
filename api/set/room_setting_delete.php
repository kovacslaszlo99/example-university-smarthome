<?php

require_once ("../../src/DB.php");

if(isset($_GET["id"])){
	$id = $_GET["id"];
	if(is_numeric($id)){
		$db = new DB();
		echo $db->deleteData("rooms_settings", $id)[0]? 'true' : 'false';
	}
}