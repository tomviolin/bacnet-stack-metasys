<?php
echo file_get_contents("address_cache_header");
$f=fopen("devices.csv","r");
$csv = fgetcsv($f);
while (!feof($f)){
	$csv = fgetcsv($f);
	$ip = explode(".",$csv[0]);
	if (count($ip)==4){
		printf(" %7d  %02x:%02x:%02x:%02x:%02x:%02x    %1d     %02x                   %4d\n",$csv[1],$ip[0],$ip[1],$ip[2],$ip[3],0xba,0xc0,0,0,1024);
	}
}

fclose($f);


