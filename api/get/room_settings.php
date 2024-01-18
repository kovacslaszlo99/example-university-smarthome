<?php

require_once ("../../src/DB.php");

$db = new DB();
$where = "";
$where_array = array();

if(isset($_GET["room_type"])){
	$where_array["room_type_id"] = $_GET["room_type"];
}
if(isset($_GET["sensor_type"])){
	$where_array["sensor_type_id"] = $_GET["sensor_type"];
}
if(isset($_GET["time_start"])){
	$where_array["time_start"] = $_GET["time_start"];
}
if(isset($_GET["time_end"])){
	$where_array["time_end"] = $_GET["time_end"];
}
if(isset($_GET["day"])){
	$where_array["week_day"] = $_GET["day"];
}

$index = 0;
foreach($where_array as $key => $val){
	$where .= $key . "=" . ((!is_numeric($val))? "'" . $val . "'" : $val);
	if ($index+1 != count($where_array)){
		$where .= " and ";
	}
	$index++;
}

$re = iterator_to_array($db->getData("*", "rooms_settings", $where), true);
$out = json_encode($re, JSON_UNESCAPED_UNICODE);
echo $out;