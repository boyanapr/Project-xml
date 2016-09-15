<!DOCTYPE html>
<html>
<head>
<style>
 table, th, td {
	 border: 1px solid black;
	  }
 th, td {
	 padding: 15px;
 }
</style>
</head>
<body>
<?php
$xml = simplexml_load_file("http://dsnet.tu-plovdiv.bg/3TierJSP/getdata.jsp")or die("Error:Cannot create object");
echo ("<table border='1'><tr><th>Results</th></tr><tr><td>");
echo $xml->measurement[0]->location;
echo("</td></tr><tr><td>");
echo $xml->measurement[0]->temperature;
echo("</td></tr><tr><td>");
echo $xml->measurement[0]->humidity;
echo("</td></tr><tr><td>");
echo $xml->measurement[1]->location;
echo("</td></tr><tr><td>");
echo $xml->measurement[1]->temperature;
echo("</td></tr><tr><td>");
echo $xml->measurement[1]->humidity;
echo("</td></tr><tr><td>");
echo $xml->measurement[2]->location;
echo("</td></tr><tr><td>");
echo $xml->measurement[2]->temperature;
echo("</td></tr><tr><td>");
echo $xml->measurement[2]->humidity;
echo ("</td></tr></table>");
?>
</body>
</html>