<?php

require_once ("../../src/DB.php");

if (isset($_GET["sensor_type"]) && isset($_GET["room_type"]) && isset($_POST["sensor_value"])){
	$sensor_type = $_GET["sensor_type"];
	$room_type = $_GET["room_type"];
	$sensor_value = $_POST["sensor_value"];
	if(is_numeric($sensor_type) && is_numeric($room_type) && is_numeric($sensor_value)){
		$db = new DB();
		$data = array(
			(float) $sensor_value,
			date('Y-m-d H:i:s'),
			(int) $room_type,
			(int) $sensor_type
		);
		$db->insertData("sensors_values", "value, date_time, room_type_id, sensor_type_id", $data);
	}
	
}