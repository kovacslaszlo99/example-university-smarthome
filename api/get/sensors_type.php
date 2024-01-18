<?php

require_once ("../../src/DB.php");

$db = new DB();
$re = iterator_to_array($db->getData("*", "sensor_type"), true);
$out = json_encode($re, JSON_UNESCAPED_UNICODE);
echo $out;