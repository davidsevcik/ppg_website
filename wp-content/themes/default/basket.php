<?php
$orderid = mysql_real_escape_string($_COOKIE['orderid']);

if(empty($orderid)) {
	$orderid = md5(rand() + time());
	$inmonth = time()+60*60*24*30;
	setcookie('orderid', $orderid, $inmonth*12, '/');
	$now = time();
	$max = $wpdb->get_row("SELECT MAX(ordernumber) AS maxordernumber FROM tours_orders");
	$ordernumber = $max->maxordernumber + 1;
	$wpdb->query("INSERT INTO tours_orders (id, lastupdate, ordernumber) VALUES ('$orderid', $now, $ordernumber)");
}

if($_POST['action'] == 'save') {
	foreach($_POST['ids'] as $id) {
		$id = intval($id);
		$month = intval($_POST['month'][$id]);
		$day = intval($_POST['day'][$id]);
		$year = intval($_POST['year'][$id]);
		$time = mysql_real_escape_string($_POST['time'][$id]);

		$date = mktime(0, 0, 0, $month, $day, $year);
		$wpdb->query("UPDATE tours_order_tour SET tourdate=$date, tourtime='$time' WHERE orderid='$orderid' AND tourid=$id");
	}

	if($_POST['order'] == 1) {
		$name = mysql_real_escape_string($_POST['yourname']);
		$email = mysql_real_escape_string($_POST['youremail']);
		$people = mysql_real_escape_string($_POST['people']);
		$place = mysql_real_escape_string($_POST['meetingplace']);
		$info = mysql_real_escape_string($_POST['info']);
		$requirements = mysql_real_escape_string($_POST['requirements']);
		
		$now = time();
		$wpdb->query("UPDATE tours_orders SET lastupdate=$now, name='$name', email='$email', people='$people', place='$place', info='$info', requirements='$requirements' WHERE id='$orderid'");
	}
}
if($_POST['target'] == 'search') {
	header('Location: '.get_bloginfo('siteurl').'/index.php/list/');
	exit;
}
if($_POST['target'] == 'order') {
	$order = 1;
} else { 
	$order = empty($_REQUEST['order']) ? 0 : 1;	
}
if(intval($_POST['tourid']) > 0) {
	$wpdb->query("DELETE FROM tours_order_tour WHERE orderid='$orderid' AND tourid=".intval($_POST['tourid']));
}

$tourorder = $wpdb->get_row("SELECT * FROM tours_orders WHERE id='$orderid'");
$tours = $wpdb->get_results("
	SELECT TT.id, TT.title, TT.shortdescription, TOT.tourdate, TOT.tourtime
	FROM tours_order_tour TOT
	JOIN tours_tours TT ON TT.id=TOT.tourid
	WHERE TOT.orderid='$orderid'
	ORDER BY tourdate
");

if($_POST['target'] == 'sendorder') {
	$sendemail = get_option('toursemail');
	include('/home/www/private-walks.com/www/private-walks.com/wp-includes/class-phpmailer.php');
	
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->AddAddress($sendemail);
	$mail->AddAddress($email);
	$mail->IsHTML(true);
	$mail->Body = createEmail();
	$mail->From = "$sendemail";
	$mail->FromName = 'Private-Walks.Com';
	if($_POST['lang'] == 'de')
		$mail->Subject = 'Private Stadtführungen in Prag/Tschechien';
	else
		$mail->Subject = 'Private Tour/s in Prague/Czech Republic (Order No. '.$tourorder->ordernumber.')';
	$mail->Send();
	
	setcookie('orderid', "", time() - 3600, '/');
	
	if($_POST['lang'] == 'de')
		header('Location: '.get_bloginfo('siteurl').'/index.php/de/anfrage-beendet/');
	else
		header('Location: '.get_bloginfo('siteurl').'/index.php/order-completed/');
	exit;
}

function printNumbers($from, $to, $sel)
{
	for($i = $from; $i <= $to; $i++) {
		$selected = $sel == $i ? 'selected="selected"' : '';
		echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';
	}
}

function createEmail()
{
	global $tourorder, $tours, $name, $email, $people, $place, $info, $requirements;
	
	if($_POST['lang'] == 'de') {
		$semail = "Lieber Kunde,<br /><br />";
		$semail .= "wir werden innerhalb von 48 Stunden zurückschreiben und Ihre Anfrage beantworten.<br /><br />";
		$semail .= "Anfragedetails:<br /><br />";
		$semail .= "<strong>Name:</strong> $name<br />";
		$semail .= "<strong>E-mail Adresse:</strong> $email<br />";
		$semail .= "<strong>Wieviele Leute:</strong> $people<br />";
		$semail .= "<strong>Treffpunkt:</strong> $place<br />";
		if(!empty($requirements))
			$semail .= "<strong>Ihre Wünsche:</strong> $requirements<br />";
		if(!empty($info))
			$semail .= "<strong>Andere Info:</strong> $info<br />";
		$semail .= "<br /><br />Mit freundlichen Grüssen,<br />Jaroslav Pesta<br />-- <br />";
		$semail .= "Private-Walks.com<br />Custom Travel Services s.r.o. (Ltd.)<br />Prague | Czech Republic<br />Tel (24/7): +420 773 103 102";
	} else {
		$semail = "Dear $name,<br /><br />";
		$semail .= "thank you for booking your private tour/s  with Private-Walks.com.<br /><br />";
		$semail .= "We will contact you within 48 hours, answer your questions and finalize your itinerary.<br /><br />";
		$semail .= "Order Details:<br />";
		$semail .= "<strong>Name:</strong> $name<br />";
		$semail .= "<strong>Your Email:</strong> $email<br />";
		$semail .= "<strong>Number of People:</strong> $people<br />";
		$semail .= "<strong>Meeting Place:</strong> $place<br />";
		if(!empty($requirements))
			$semail .= "<strong>Your Requirements:</strong> $requirements<br />";
		if(!empty($info))
			$semail .= "<strong>Additional Info:</strong> $info<br />";
		if(!empty($tours)) {
			$semail .= "<br /><strong>Ordered Tours</strong>:<br />";
			$semail .= "<table><tr><td><strong>TOUR NAME</strong></td><td><strong>ITINERARY <small>(MONTH/DAY/YEAR)</small></strong></td><td><strong>PICK UP TIME</strong></td></tr>";
			foreach($tours as $tour) {
				$day = intval(date('d', $tour->tourdate));
				$month = intval(date('m', $tour->tourdate));
				$year = intval(date('Y', $tour->tourdate));
			
				$semail .= "<tr><td>{$tour->title}</td><td>$month/$day/$year</td><td>{$tour->tourtime}</td></tr>";
			}
			$semail .= "</table>";
		}
		$semail .= "<br /><br />Sincerely yours,<br />Jay Pesta<br />-- <br />";
		$semail .= "Private-Walks.com<br />Custom Travel Services s.r.o. (Ltd.)<br />Prague | Czech Republic<br />Tel (24/7): +420 773 103 102";
	}
	
	return $semail;
}

?>

<?php get_header(); ?>

<script type="text/javascript">
function deleteTour(id)
{
	document.getElementById('touridvalue').value = id;
	document.getElementById('schedule').submit();	
}
function orderform()
{
	document.getElementById('targetvalue').value = 'order';
	document.getElementById('schedule').submit();	
}
function searchlist()
{
	document.getElementById('targetvalue').value = 'search';
	document.getElementById('schedule').submit();	
}
function sendorder()
{
	document.getElementById('targetvalue').value = 'sendorder';
	document.getElementById('schedule').submit();	
}
</script>

<div id="basket">
	<h2><?php if($order == 0) { ?>Basket<? } else { ?>Order Form<?php } ?></h2>
	
	<div id="unscheduled">
		<form id="schedule" method="post" action="<?php bloginfo('siteurl'); ?>/index.php/basket/">
			<input type="hidden" name="action" value="save" />
			<input id="touridvalue" type="hidden" name="tourid" value="" />
			<input id="targetvalue" type="hidden" name="target" value="" />
			
			<?php if($order == 1) { ?>
				<input type="hidden" name="order" value="1" />
				<div id="nameinfo">
					<label>Your Name<up>*</up></label><input class="block" name="yourname" value="<?php echo $tourorder->name; ?>" size="40" />
					<label>Your Email Address<up>*</up></label><input class="block" name="youremail" value="<?php echo $tourorder->email; ?>" size="40" />
					<label>How Many People<up>*</up></label><input class="block" name="people" value="<?php echo $tourorder->people; ?>" size="5" />
				</div>
			<?php } ?>
			
			<?php if(!empty($tours)) { ?>
				<table>
					<tr class="header">
						<th>BASKET CONTENT</th>
						<th class="date">ITINERARY <small>(MONTH/DAY/YEAR)</small></th>
						<th class="time">PICK UP TIME</th>
						<th></th>
					</tr>
					<?php $i = 1; foreach($tours as $tour) {
						$day = intval(date('d', $tour->tourdate));
						$month = intval(date('m', $tour->tourdate));
						$year = intval(date('Y', $tour->tourdate));
					?>
						<input type="hidden" name="ids[]" value="<?php echo $tour->id; ?>" />
						<tr>
							<td><?php echo $tour->title; ?></td>
							<td>
								<select name="month[<?php echo $tour->id; ?>]">
									<?php printNumbers(1, 12, $month); ?>
								</select>/
								<select name="day[<?php echo $tour->id; ?>]">
									<?php printNumbers(1, 31, $day); ?>
								</select>/
								<select name="year[<?php echo $tour->id; ?>]">
									<?php printNumbers(2008, 2010, $year); ?>
								</select>
							</td>
							<td>
								<input name="time[<?php echo $tour->id; ?>]" size="7" value="<?php echo $tour->tourtime; ?>" />
							</td>
							<td align="right">
								<a href="javascript:deleteTour(<?php echo $tour->id; ?>);">delete</a>
							</td>
						</tr>
					<?php $i++; } ?>
				</table>
			<?php } else { ?>
				<?php if($order == 1) { ?>
					<div id="requirements">
						<label>Your Requirements<up>*</up></label><textarea name="requirements"><?php echo $tourorder->requirements; ?></textarea>
					</div>
				<?php } else { ?>
					Your basket is empty.
				<?php } ?>
			<?php } ?>

			<?php if($order == 1) { ?>
				<div id="infoblock">
					<label>Meeting Place<up>*</up></label><textarea name="meetingplace"><?php echo $tourorder->place; ?></textarea>
					<label>Additional Info</label><textarea name="info"><?php echo $tourorder->info; ?></textarea>
				</div>

				<div id="required">
					<small><up>*</up>&nbsp;Required Items</small><br />
					<div class="note">Sending us the order form is NOT binding.</div>
				</div>
			<?php } ?>
				
			<?php if($order == 0) { ?>
			<div id="orderbuttons">
				<a href="javascript:orderform();">PROCEED TO ORDER FORM<br /><small>(non binding)</small></a>
				<a class="centered" href="javascript:searchlist()">BACK TO TOURS LIST</a>
			</div>
			<?php } else { ?>
				<div id="orderbuttons">
					<a href="javascript:sendorder();">SEND ORDER<br /><small>(non binding)</small></a>
					<a class="centered" href="javascript:searchlist()">BACK TO TOURS LIST</a>
				</div>
			<?php } ?>
		</form>
	</div>
	
</div>

<?php get_footer(); ?>