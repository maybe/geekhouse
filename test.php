<?php
//$db = mysql_connect("127.0.0.1","root","");
//mysql_select_db("exercise-test",$db);
//$result = mysql_query("SELECT * from cities",$db);
////printf("first name: %s",mysql_result($result,0,"id"));
//for ($i=0; $i<=count($result); $i++) {
//printf ("name: %s\r", mysql_result($result,$i,"id"));
//}
echo substr(md5(RAND()),0, 20);
echo '\r';
echo md5(RAND());
?>
