<?php
$db = mysql_connect("127.0.0.1","root","");
mysql_select_db("exercise-test",$db);
$result = mysql_query("SELECT * from t_card_usage_record",$db);
printf("first name: %s<>;\n",mysql_result($result,0,"card_no"));
?>; 
