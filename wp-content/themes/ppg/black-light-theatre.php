<?php
/*
Template Name: Black Light Theatre
*/


if($_POST['action'] == 'order' && empty($_POST['surname'])) {
    $ticket = array();
	$ticket['name'] = $_POST['tname'];
	$ticket['email'] = $_POST['temail'];
	$ticket['date'] = $_POST['tdate'];
	$ticket['time'] = $_POST['ttime'];
	$ticket['seats'] = $_POST['tseats'];
	
	if(!(empty($ticket['name']) || empty($ticket['email']) || empty($ticket['date']) || empty($ticket['seats']))) {
		$sendemail = get_option('toursemail');
		require('class-phpmailer.php');

		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->AddAddress($sendemail);
		$mail->AddAddress($ticket['email']);
		$mail->IsHTML(true);
		$mail->Body = createEmail($ticket);
		$mail->From = "$sendemail";
		$mail->FromName = 'Private-Prague-Guide.com';
		$mail->Subject = 'Your Private-Prague-Guide.com Theatre Tickets Order';
		$mail->Send();

		header('Location: '.get_bloginfo('siteurl').'/tickets-order-completed/');
		exit;
	}
}

function createEmail($ticket)
{
	global $tourorder, $tours, $name, $email, $people, $place, $info, $requirements;
	
	$semail = "Dear {$ticket['name']},<br />";
    $semail .= "Thank you for making reservation of your tickets to the Ta Fantastika Black Light Theatre through my website.<br />I will contact you within 48 hours and send you all the necessary details - seat number/s, address, directions, etc.<br /><br />";
	$semail .= "Order Details:<br />";
	$semail .= "<strong>Name:</strong> {$ticket['name']}<br />";
	$semail .= "<strong>Email:</strong> {$ticket['email']}<br />";
	$semail .= "<strong>Date:</strong> {$ticket['date']}<br />";
	$semail .= "<strong>Number of Seats:</strong> {$ticket['seats']}<br />";
	$semail .= "<strong>Showing Time:</strong> {$ticket['time']}<br /><br />";
    $semail .= "Sincerely yours,<br /><br />Jay Pesta<br />President & Private Pague Guide<br />-- <br />";
    $semail .= "<a href=\"http://www.private-prague-guide.com\">PRIVATE-PRAGUE-GUIDE.COM</a><br />Travel Agency Custom Travel Services s.r.o. (Ltd.)<br />Blanicka st. 25 | Prague 2 | Czech Republic<br />Tel (24/7): +420 773 103 102";
	
	return $semail;
}


function print_form($content) {
	global $ticket;

	$_7pm_selected = $ticket['time'] == '7pm' ?  'selected="selected"' : '';
	$_9pm_selected = $ticket['time'] == '9:30pm' ?  'selected="selected"' : '';
	
	$form = <<<EOD
		<div class="infobox-top"></div>
		<div class="infobox">
		<form id="ticketform" method="post" action=".">
			<h3>Reservation Form</h3>
			<input type="hidden" name="action" value="order" style="display:none" />
			<input type="text" name="surname" style="display:none" />
			<label>Name<sup>*</sup></label><input class="block" name="tname" value="{$ticket[name]}" size="40" />
			<label>Email<sup>*</sup></label><input class="block" name="temail" value="{$ticket[email]}" size="40" />
			<small style="display:block; margin-bottom:1em;">If you haven't received a reply you probably typed in a wrong email address. Please double-check your email.</small>
			<label>Date<sup>*</sup></label><input class="block" name="tdate" value="{$ticket[date]}" size="15" />
			<label>Showing Times<sup>*</sup></label>
			<select name="ttime">
				<option value="7pm" {$_7pm_selected}>7pm</option>
				<option value="9:30pm" {$_9pm_selected}>9:30pm</option>
			</select>
			<label>Number of Seats<sup>*</sup></label><input class="block" name="tseats" value="{$ticket[seats]}" size="4" />
	
			<p style="margin-top:1.5em"><sup>*</sup> Obligatory form fields. Submitted personal information will not be disclosed to any third party.</p>
	
			<div id="orderbuttons">
				<a class="centered" href="javascript:void()" onClick="document.getElementById('ticketform').submit()">SUBMIT</a>
			</div>
		</form>
		</div>
		<div class="infobox-bottom"></div>
		
EOD;

	return str_replace('[[form]]', $form, $content);
}

add_filter('the_content', 'print_form');
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


<div id="tickets">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1 id="generictitle"><?php the_title() ?></h1>

	<div id="ticketscontent">
		<?php the_content() ?>
		
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>
<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>