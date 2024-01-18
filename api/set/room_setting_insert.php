<?php

require_once ("../../src/DB.php");
require_once ("../../src/functions.php");

if (   isset($_GET["sensor_type"])
	&& isset($_GET["room_type"])
	&& isset($_POST["from_value"])
	&& isset($_POST["to_value"])
	&& isset($_POST["week_day"])
	&& isset($_POST["time_start"])
	&& isset($_POST["time_end"])
	){
		$sensor_type = $_GET["sensor_type"];
		$room_type = $_GET["room_type"];
		$from_value = $_POST["from_value"];
		$to_value = $_POST["to_value"];
		$week_day = $_POST["week_day"];
		$time_start = $_POST["time_start"];
		$time_end = $_POST["time_end"];
		if(    is_numeric($sensor_type)
			&& is_numeric($room_type)
			&& is_numeric($from_value)
			&& is_numeric($to_value)
			&& is_numeric($week_day)
			&& is_time($time_start)
			&& is_time($time_end)
		){
				$db = new DB();
				$data = array(
					(int) $sensor_type,
					(int) $room_type,
					(float) $from_value,
					(float) $to_value,
					(int) $week_day,
					$time_start,
					$time_end
				);
				echo $db->insertData("rooms_settings", "sensor_type_id, room_type_id, from_value, to_value, week_day, time_start, time_end", $data)[0]? 'true' : 'false';
	}
}