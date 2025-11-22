<?php
date_default_timezone_set("UTC");

$time = date("Y-m-d H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

$log_message = "[$time] Payment confirmed by IP: $ip\n";

file_put_contents("/var/www/html/logs/actions.txt", $log_message, FILE_APPEND);

echo "OK";
?>
