<?php
/*
 * Retrieve the first five characters of each line in an ABBYY XML to see what we need to process
 * @author  Dauvit King
 * @package ABLE_project
 * @since   January 2010
 * @ver     1.0
 */

echo "Hello from find first five\n";
//$fname = 'C:\ABLE\BoB\source\bulletinofbritis27zoollond_abbyy';
$fname = 'C:\ABLE\BoB\source\bulletinofbritis51entolond_abbyy';
$fn_in = $fname.'.xml';
$fn_out = $fname.'_find_first_five.txt';
$fin = fopen($fn_in, 'r') or exit("Failed to open input xml file: {$fn_in} \n");

$t = array();
$buffer = "Output from find_first_five.php\nLooking for the first five characters of each line in {$fn_in}\n\n";
while ($buffer = fgets($fin)) {
    $t[] = substr($buffer, 0, 5);
}
print_r(array_count_values($t));

fclose($fin) or exit("Failed to close input xml file: {$fn_in} \n");
echo "Goodbye from find first five\n";
?>