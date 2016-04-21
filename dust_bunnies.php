<?php
//trim preg replaces are used to strip any funny characters that might break stuff

$dust_collected = array();
$dust_locations = array();

//grab input file from same directory - assuming formatting is constant
$inputs = file_get_contents('input.txt');

//split input file into array by lines
$inputs_array = explode("\n",$inputs);

//first line - room x by y - in array
$room_xy = explode(" ",trim(preg_replace('/\s\s+/', '', $inputs_array[0])));

//second line - current x y - in array
$loc_xy = explode(" ",trim(preg_replace('/\s\s+/', '', $inputs_array[1])));

//last line for movement pattern - in array
$movement = str_split($inputs_array[count($inputs_array)-1]);

//start loop past known lines and subtract final (accomodates any number of dust locations)
for($i = 2; $i<count($inputs_array) - 1; $i++){
	array_push($dust_locations, trim(preg_replace('/\s\s+/', '', $inputs_array[$i])));
}

//start applying movement to bot via loop
for($i = 0; $i<count($movement); $i++){

	if($movement[$i] == "N" && $loc_xy[1] < $room_xy[1]){ //y + 1 and wall check
		$loc_xy[1]+=1;
	}
	elseif($movement[$i] == "E" && $loc_xy[0] < $room_xy[0]){ //x + 1 and wall check
		$loc_xy[0]+=1;
	}
	elseif($movement[$i] == "S" && $loc_xy[1] > 0){ //y - 1 and wall check
		$loc_xy[1]-=1;
	}
	elseif($movement[$i] == "W" && $loc_xy[0] > 0){ //x - 1 and wall check
		$loc_xy[0]-=1;
	}

	//check if current location string is in dust location array - if so - push location to collected
	if(in_array("$loc_xy[0] $loc_xy[1]",$dust_locations)){
		array_push($dust_collected,"$loc_xy[0] $loc_xy[1]");
	}
}

//clean collected array for duplicated data and count
$dust_collected = count(array_unique($dust_collected));

//clean output variable for location
$end_location = $loc_xy[0]." ".$loc_xy[1];

//dump to console via script injection
echo "<script>console.log('".$end_location."');</script>";
echo "<script>console.log(".$dust_collected.");</script>";
?>