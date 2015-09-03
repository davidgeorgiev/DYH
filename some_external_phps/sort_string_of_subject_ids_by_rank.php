<?php
	//include "config.php";
	//$string_of_ids = "1,2,3,4,5,6,7,8,";
	$myArray_ofIds = explode(',', $string_of_ids);
	print_r($myArray_ofIds);
	
	$SortedArray = array();
	for ($i = 0;$i < sizeof($myArray_ofIds) - 1; $i++) {
		$SQL = "SELECT subjects.Rank FROM subjects WHERE subjects.UID = ".$myArray_ofIds[$i];
		echo $SQL;
		$result = mysql_query($SQL);
		$row = mysql_fetch_array($result);
		$SortedArray[$myArray_ofIds[$i]] = $row[0];
	}
	arsort($SortedArray);
	print_r($SortedArray);
	$Final_sorted_array = array_keys($SortedArray);
	print_r($Final_sorted_array);
	
	$string_of_ids = "";
	foreach ($Final_sorted_array as $value) {
		$string_of_ids = $string_of_ids.$value.",";
	}
	unset($value);
?>