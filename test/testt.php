<?php
$inputString = fgets(STDIN);

$string = trim($inputString);
$delimeters = explode("|", $string);

$serchedWord = $delimeters[0];
echo substr_count($delimeters[1],$serchedWord);