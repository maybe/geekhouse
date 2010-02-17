<?php
//$db = mysql_connect("127.0.0.1","root","");
//mysql_select_db("exercise-test",$db);
//$result = mysql_query("SELECT * from cities",$db);
////printf("first name: %s",mysql_result($result,0,"id"));
//for ($i=0; $i<=count($result); $i++) {
//printf ("name: %s\r", mysql_result($result,$i,"id"));
//}


//
//$animal = array (
//
//"type" => "human", 
//
//"name" => "hanguofeng", 
//
//"age" => "20" )
//
//;
//
//$animal_ser = serialize ( $animal );
//
//echo ($animal_ser);
//if (is_string($animal))
//echo "111111111";


//					$doc = new DOMDocument ();
//		  $doc->formatOutput = true;
//			$r = $doc->createElement ( "im" );
//		$doc->appendChild ( $r );
//		
//		$count = 1;
//		for($i = 1; $i <= $count; $i ++) {
//			$b = $doc->createElement ( "imItem" );
//			$type = $doc->createElement ( "imType" );
//			$type->appendChild ( $doc->createTextNode ( "1111111" ) );
//			$account = $doc->createElement ( "imAccount" );
//			$account->appendChild ( $doc->createTextNode ( "22222222222" ) );
//			$b->appendChild ( $type );
//			$b->appendChild ( $account );
//			$r->appendChild ( $b );
//		}
//		echo $doc->saveXML ();
//


//$stack = array (1, 2);
//
//array_push ($stack,3,4,5,6);  
//
//foreach ($stack as $a){
//	
//	echo $a;
//	
//}


$string = '<?xml version="1.0"?><im><imItem><imType>twitter</imType><imAccount>a@aa.com</imAccount></imItem><imItem><imType>qq</imType><imAccount>b@bb.com</imAccount></imItem></im>';
$doc = new DOMDocument ();
$imArray = array ();
$doc->loadXML ( $string );
$ims = $doc->getElementsByTagName ( "imItem" );
echo $ims->length;
foreach ( $ims as $imItem ) {
	$types = $imItem->getElementsByTagName ( "imType" );
	$type = $types->item ( 0 )->nodeValue;
	$accounts = $imItem->getElementsByTagName ( "imAccount" );
	$account = $accounts->item ( 0 )->nodeValue;
	$tmp = array ($type, $account );
	array_push ( $imArray, $tmp );
}
echo count($imArray);
?>