<?php

require_once ("../../src/DB.php");
require_once ("../../src/Sensor.php");
require_once ("../../src/functions.php");

if(isset($_GET["sensor_type"]) && isset($_GET["room_type"]) && isset($_GET["from"]) && isset($_GET["to"])){
	$db = new DB();
	$sensor = new Sensor($_GET["from"], $_GET["to"]);
	$where = "room_type_id=" . $_GET["room_type"] . " and sensor_type_id=" . $_GET["sensor_type"] . " ORDER BY id DESC LIMIT 1";
	
	$values = iterator_to_array($db->getData("value", "sensors_values", $where), true);
	$last_values = array();
	foreach($values as $item){
		$last_values[] = $item["value"];
	}
	$where = "room_type_id=" . $_GET["room_type"] . " and sensor_type_id=" . $_GET["sensor_type"] . " and week_day=" . get_week_day_now()
	. " and TIME_FORMAT(time_start, '%H %i %s') <= TIME_FORMAT('" . get_time_now()
	. "', '%H %i %s') and TIME_FORMAT(time_end, '%H %i %s') >= TIME_FORMAT('" . get_time_now() . "', '%H %i %s')";
	$setting = iterator_to_array($db->getData("from_value, to_value", "rooms_settings", $where), true);
	if(count($setting) == 0)
		$setting[0] = NULL;
	$sensor->set_settings($setting[0]);
	$sensor->set_last_values($last_values);
	$value = $sensor->get_new_value();
	while(!($value >= $_GET["from"] && $value <= $_GET["to"])){
		$value = $sensor->get_new_value();
	}
	echo $value;
}