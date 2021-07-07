<?php

$f = fopen($argv[1],"r");
$name="";
$device="";
while (!feof($f)) {

	$line = trim(fgets($f));
	if (preg_match("/proprietary 2390/",$line)===1) {
		$name = preg_replace('/^[^"]*"([^"]*)".*$/','\\1',$line);
	}
	if (preg_match("/description:/",$line)===1) {
		$desc = preg_replace('/^[^"]*"([^"]*)".*$/','\\1',$line);
	}
	if (preg_match("/object-identifier:/",$line)===1) {
		$obj_info = preg_replace('/^.*\(([^)]*)\).*$/','\\1',$line);
		$obj_array = explode(", ",$obj_info);
		if ($obj_array[0]==="device") {
			$device=$obj_array[1];
		} elseif ($name != "") {
			echo $device.",". $obj_array[1].",\"".$obj_array[0]."\",\"".$name."\",\"$desc\"\n";
		}
			
	}
}

fclose($f);
