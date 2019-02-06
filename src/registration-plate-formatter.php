<?php

/**
* De diverse nummberbord formaten in Nederland
* https://nl.wikipedia.org/wiki/Nederlands_kenteken#Sidecodes
*/ 
$sidecodes = [
	'XX-99-99',
	'99-99-XX',  
	'99-XX-99',
	'XX-99-XX',
	'XX-XX-99',
	'99-XX-XX',
	'99-XXX-9',
	'9-XXX-99',
	'XX-999-X',
	'X-999-XX',
	'XXX-99-X'
];

$formattedRegistrationPlate = false;

$sideCodeTemplates = [];
$filterChars = ["-", "X", "9"];
$replaceChars = ["", "[a-zA-z]{1}", "\d{1}"];

foreach($sidecodes as $key=>$value){
  $sideCodeTemplates[$key] = str_replace($filterChars, $replaceChars, $value);
}

define('SIDECODES', $sidecodes);
define('SIDE_CODE_TEMPLATES', $sideCodeTemplates);

function getTemplate($plate){
	foreach (SIDE_CODE_TEMPLATES as $key => $value) {
		if(preg_match('/' . $value . '/', $plate)){
			return SIDECODES[$key];
		}	
	}
}


function checkRegistrationPlate($plate){
	// First check for wel formatted input
	if(!preg_match("/[a-zA-Z0-9]{6}/", $plate)){
		return;
	}

	// Find the sidecode if available
	if($template = getTemplate($plate)) {
		// insert dashes on position of template
		$offset = 0;
		$dashPositions = [];
		while(($position = strpos($template, '-', $offset)) !== false){
			$offset = $position + 1; // add 1 for right offset
			$dashPositions[] = $position;

		}
	
		foreach ($dashPositions as $value) {
			$plate = substr_replace($plate, '-', $value, 0);
		}
	
		return $plate;
		
	} else {
		return;
	}


}

function sanitize($value){
	return filter_var($value, FILTER_SANITIZE_STRING);
}


if(isset($_POST['submit'])){	
	$cleanRegistrationPlate = sanitize($_POST['registrationPlate']);
	$formattedRegistrationPlate = checkRegistrationPlate($cleanRegistrationPlate);
}


