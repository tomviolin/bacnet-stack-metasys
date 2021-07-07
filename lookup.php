<!doctype html>
<head>
<body>
<?php

$conn = mysql_connect("waterdata.glwi.uwm.edu","tomh","wd34faer");
mysql_select_db("metasys");
$result = mysql_query("select d.recid as disp_recid, d.heading,d.functional_name as dis_functional_name, d.description as dis_description, a.*, i.ip_address, object_types.object_id as object_type_id from display_points d LEFT JOIN allpoints a ON d.functional_name = a.functional_name LEFT JOIN devices i ON a.device_id = i.device_id LEFT JOIN object_types ON a.object_type = object_types.object_name order by heading, d.recid");

$heading = "";

echo "<table>\n";

while ($row = mysql_fetch_array($result)) {
	$newheading = $row['heading'];
	if ($newheading != $heading) {
		$heading = $newheading;
		echo "<tr><th colspan=5>$heading</th></tr>\n";
	}
	echo "<tr><td>".$row['dis_description']."</td>";
	echo "<td>".$row['dis_functional_name']."</td>";
	if ($row['ip_address'] == "") {
		echo "<td>** object ".$row['dis_functional_name']." not found ***</td>";
	} else {
		$command = 'BACNET_BBMD_ADDRESS='.$row['ip_address'].' ./bin/bacrp '.$row['device_id'].' '.$row['object_type_id'].' '.$row['object_id'].' 85';
		$output = trim(`$command 2>/dev/null`);
		echo "<td>".$output."</td>";
	}
	echo "</tr>\n";
}
echo "</table>\n";
?>
</body>
</html>
