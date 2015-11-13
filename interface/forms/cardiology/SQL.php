<?php

include_once("../../../interface/globals.php");
echo "Building Statement<br>";
flush();

$sqlLibPath = "../../../library/sql.inc";
$tablename = "cardiology";
//our first six columns are NEEDED for operation of the suite
$create = "
	create table if not exists `$tablename` (
		`id` bigint(20) NOT NULL auto_increment,
		`date` datetime default NULL,
		`data` text,
		`pid` bigint(20) NOT NULL default '0',
		PRIMARY KEY  (`id`),
		KEY `id` (`id`),
	) ENGINE=MyISAM
	";
	
echo "Connecting To SQL<br>";
flush();
if (!include_once($sqlLibPath))
	die("failed!");

echo "Creating Tables<br>";
flush();
if (!sqlStatement($create))
	die("failed!");

echo "Success!<br>";
flush();
?>
