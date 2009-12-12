<?php
/*
Plugin Name: Private Walks
Plugin URI: http://private-walks.com/#
Description: Veci pro stranky
Author: Jaroslav Cmunt
Version: 1.0
*/

//error_reporting(E_ALL);
function chyby($errno, $errmsg, $filename, $linenum, $vars)
{
	if(error_reporting()) {
		echo $filename.' :: '.$linenum.' :: '.$errno.' :: '.$errmsg."\n";
	}
}
//set_error_handler('chyby');

//$intro = &get_post(3);

function private_setup() 
{
	return 1;
}

function p_destination($id) 
{
	switch($id) {
		case 1: $destination = "northwest of Prague (direction Germany - Cologne)"; break;
		case 2: $destination = "north of Prague (direction Germany - Dresden)"; break;
		case 3: $destination = "northeast of Prague (direction Poland - Warsaw)"; break;
		case 4: $destination = "west of Prague (direction Germany - Nuremberg)"; break;
		case 5: $destination = "east of Prague (direction Poland - Cracow)"; break;
		case 6: $destination = "southwest of Prague (direction Germany - Munich)"; break;
		case 7: $destination = "south of Prague (direction Austria - Salzburg)"; break;
		case 8: $destination = "southeast of Prague (direction Slovakia and Austria - Vienna)"; break;
	}

	return $destination;
}

// /wp-includes/query.php, set_404()
function p_resolve404(&$query)
{
	$query->is_page = 1;
	$query->is_singular = 1;
	
	return false;
}

function p_current_page($page)
{
	if($_SERVER['PHP_SELF'] == $page) echo 'class="current"';
}

add_action('wp_head', 'private_setup');


function strip_tour_name_from_request($qv) {
	if (eregi('^(private-tour\/[0-9]+)', $qv['pagename'], $regs)) {
		$qv['pagename'] = 'private-tour';
	}
	return $qv;
}

add_filter('request', 'strip_tour_name_from_request');
?>