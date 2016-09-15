<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("http://dsnet.tu-plovdiv.bg/3TierJSP/getdata.jsp");
$servername="localhost";
$username="root";
$password="1234567";
$dbname="measurements";

$bd=mysql_connect($servername,$username,$password) or die("No connect");
mysql_select_db($dbname,$bd) or die(mysql_error());

$xmlObject=$xmlDoc->getElementsByTagName('measurement');
$itemCount=$xmlObject->length;

 for ($i=0; $i<$itemCount; $i++) {
	 $location=$xmlObject->item($i)->getElementsByTagName('location')->item(0)->childNodes->item(0)->nodeValue;
	 $temperature=$xmlObject->item($i)->getElementsByTagName('temperature')->item(0)->childNodes->item(0)->nodeValue;
	 $humidity=$xmlObject->item($i)->getElementsByTagName('humidity')->item(0)->childNodes->item(0)->nodeValue;
	 
 }
 
 $sql="INSERT INTO meas(location,temperature, humidity)".
      "VALUES ('$location','$temperature','$humidity' )";
 $results=mysql_query($sql)or die(mysql_error());
 echo "Data inserted successifully!!!<br>";
 $query="SELECT * FROM meas";
 $results=mysql_query($query)or die(mysql_error());
 
 while ($row=mysql_fetch_array($results)) {
	 extract($row);
	 echo "Location: ",$location;
	 echo "<br>";
	 echo "Temperature: ",$temperature;
	 echo "<br>";
	 echo "Humidity: ",$humidity;
	 echo "<br>";

 }
 
 ?>