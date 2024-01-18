<?php

require_once ("../../src/DB.php");
require_once ("../../src/functions.php");

if (   isset($_GET["sensor_type"])
	&& isset($_GET["room_type"])
	&& isset($_GET["id"])
	&& isset($_POST["from_value"])
	&& isset($_POST["to_value"])
	&& isset($_POST["week_day"])
	&& isset($_POST["time_start"])
	&& isset($_POST["time_end"])
	){
		$sensor_type = $_GET["sensor_type"];
		$room_type = $_GET["room_type"];
		$id = $_GET["id"];
		$from_value = $_POST["from_value"];
		$to_value = $_POST["to_value"];
		$week_day = $_POST["week_day"];
		$time_start = $_POST["time_start"];
		$time_end = $_POST["time_end"];
		if(    is_numeric($sensor_type)
			&& is_numeric($room_type)
			&& is_numeric($id)
			&& is_numeric($from_value)
			&& is_numeric($to_value)
			&& is_numeric($week_day)
			&& is_time($time_start)
			&& is_time($time_end)
		){
				$db = new DB();
				$data = array(
					"sensor_type_id" => (int) $sensor_type,
					"room_type_id" => (int) $room_type,
					"from_value" => (float) $from_value,
					"to_value" => (float) $to_value,
					"week_day" => (int) $week_day,
					"time_start" => $time_start,
					"time_end" => $time_end
				);
				echo $db->updateData("rooms_settings", $data, $id)[0]? 'true' : 'false';
	}
}