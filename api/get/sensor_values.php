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
if(isset($_GET["date"])){
	$where_array["DATE_FORMAT(date_time, '%Y-%m-%d')"] = $_GET["date"];
}

$index = 0;
foreach($where_array as $key => $val){
	$where .= $key . "=" . ((!is_numeric($val))? "'" . $val . "'" : $val);
	if ($index+1 != count($where_array)){
		$where .= " and ";
	}
	$index++;
}

$where .= " ORDER BY id DESC ";

if(isset($_GET["limit_form"])){
	$where .= " LIMIT " . (int)$_GET["limit_form"] . ", " . (int)$_GET["limit"];
}elseif(isset($_GET["limit"])){
	$where .= " LIMIT " . (int)$_GET["limit"];
}



$re = iterator_to_array($db->getData("*", "sensors_values", $where), true);
$out = json_encode($re, JSON_UNESCAPED_UNICODE);
echo $out;