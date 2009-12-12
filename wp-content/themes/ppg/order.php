<?php
/*
Template Name: Order
*/

$orderid = mysql_real_escape_string($_COOKIE['orderid']);
$tourid = intval($_REQUEST['tourid']);

if(empty($orderid)) {
	$orderid = md5(rand() + time());
	$inmonth = time()+60*60*24*30;
	setcookie('orderid', $orderid, $inmonth*12, '/');
	$now = time();
	$max = $wpdb->get_row("SELECT MAX(ordernumber) AS maxordernumber FROM tours_orders");
	$ordernumber = $max->maxordernumber + 1;
	$wpdb->query("INSERT INTO tours_orders (id, lastupdate, ordernumber) VALUES ('$orderid', $now, $ordernumber)");
	//echo "INSERT INTO tours_orders (id, lastupdate, ordernumber) VALUES ('$orderid', $now, $ordernumber)";
}

if($_REQUEST['action'] == 'addtobasket' || $_REQUEST['action'] == 'booknow') {
	$tour = $wpdb->get_row("SELECT tourid FROM tours_order_tour WHERE tourid=$tourid AND orderid='$orderid'");
	
	if(!$tour) {
		$wpdb->query("INSERT INTO tours_order_tour (orderid, tourid) VALUES ('$orderid', $tourid)");
		$now = time();
		$wpdb->query("UPDATE tours_orders SET lastupdate=$now WHERE id='$orderid'");
	}
	//echo $_REQUEST['action'];

	header("Location: ".get_bloginfo('siteurl').'/basket/'.($_REQUEST['action'] == 'booknow' ? '?order=1' : ''));
	//header("Location: ".get_bloginfo('siteurl').'/basket/?order=1');
}