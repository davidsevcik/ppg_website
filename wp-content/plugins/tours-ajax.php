<?php 
require_once('../../wp-config.php');
require_once('../../wp-admin/includes/admin.php');

define('DOING_AJAX', true);

if ( !is_user_logged_in() )
	die('-1');

switch ( $_REQUEST['action'] ) :
case 'newplace':
	$name = mysql_real_escape_string($_REQUEST['name']);
	$wpdb->query("INSERT INTO tours_places (id, name) VALUES (NULL, '$name')");
	echo '{ id: '.$wpdb->insert_id.' }';
	break;
case 'editplace':
	$name = mysql_real_escape_string($_REQUEST['name']);
	$placeid = intval($_REQUEST['placeid']);
	$wpdb->query("UPDATE tours_places SET name='$name' WHERE id=$placeid");
	echo '{ id: '.$placeid.' }';
	break;
case 'deleteplace':
	$placeid = intval($_REQUEST['placeid']);
	$wpdb->query("DELETE FROM tours_places WHERE id=$placeid");
	$wpdb->query("DELETE FROM tours_tour_place WHERE placeid=$placeid");
	break;
case 'setplacesorder':
	$sortable = $_POST['sortable'];
	$tourid = intval($_REQUEST['tourid']);
	
	for($i = 0; $i < count($sortable); $i++) {  
		$wpdb->query("UPDATE tours_tour_place SET placeorder=$i WHERE tourid=$tourid AND placeid={$sortable[$i]}");
	}
	break;
case 'newinterior':
	$name = mysql_real_escape_string($_REQUEST['name']);
	$hours = mysql_real_escape_string($_REQUEST['hours']);
	$fee = mysql_real_escape_string($_REQUEST['fee']);
	$wpdb->query("INSERT INTO tours_interiors (id, name, openninghours, entrancefee) VALUES (NULL, '$name', '$hours', '$fee')");
	echo '{ id: '.$wpdb->insert_id.' }';
	break;
case 'getinterior':
	$id = intval($_REQUEST['id']);
	$interior = $wpdb->get_row("SELECT * FROM tours_interiors WHERE id=$id", ARRAY_A);
	echo '{ hours: "'.str_replace("\n", '\n', $interior['openninghours']).'", fees: "'.str_replace("\n", '\n', $interior['entrancefee']).'" }';
	break;
case 'editinterior':
	$name = mysql_real_escape_string($_REQUEST['newinterior']);
	$hours = mysql_real_escape_string($_POST['openninghours']);
	$fee = mysql_real_escape_string($_REQUEST['entrancefee']);
	$id = intval($_REQUEST['intid']);
	$wpdb->query("UPDATE tours_interiors SET name='$name', openninghours='$hours', entrancefee='$fee' WHERE id=$id");
	echo '{ id: '.$id.' }';
	break;
case 'deleteinterior':
	$id = intval($_REQUEST['intid']);
	$wpdb->query("DELETE FROM tours_interiors WHERE id=$id");
	$wpdb->query("DELETE FROM tours_tour_interior WHERE interiorid=$id");
	break;
case 'setinteriorsorder':
	$sortable = $_POST['sortable'];
	$tourid = intval($_REQUEST['tourid']);

	for($i = 0; $i < count($sortable); $i++) {  
		$wpdb->query("UPDATE tours_tour_interior SET displayorder=$i WHERE tourid=$tourid AND interiorid={$sortable[$i]}");
	}
	break;
case 'settoursorder':
	$sortable = $_POST['sortable'];

	for($i = 0; $i < count($sortable); $i++) {  
		$wpdb->query("UPDATE tours_tours SET displayorder=$i WHERE id={$sortable[$i]}");
	}
	break;
endswitch;
?>