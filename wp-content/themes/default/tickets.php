<?php

if($_POST['action'] == 'order') {
	$ticket['name'] = $_POST['tname'];
	$ticket['email'] = $_POST['temail'];
	$ticket['date'] = $_POST['tdate'];
	$ticket['time'] = $_POST['ttime'];
	$ticket['seats'] = $_POST['tseats'];
	
	if(!(empty($ticket['name']) || empty($ticket['email']) || empty($ticket['date']) || empty($ticket['seats']))) {
		$sendemail = get_option('toursemail');
		include('/home/www/private-walks.com/www/private-walks.com/wp-includes/class-phpmailer.php');

		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->AddAddress($sendemail);
		$mail->AddAddress($tickets['email']);
		$mail->IsHTML(true);
		$mail->Body = createEmail($ticket);
		$mail->From = "$sendemail";
		$mail->FromName = 'Private-Walks.Com';
		$mail->Subject = 'Your Private-Walks.com Theatre Tickets Order';
		$mail->Send();

		header('Location: '.get_bloginfo('siteurl').'/index.php/tickets-order-completed/');
		exit;
	}
}

function createEmail($ticket)
{
	global $tourorder, $tours, $name, $email, $people, $place, $info, $requirements;
	
	$semail = "Thank you for booking the Ta Fantastika Black Light Theatre through our website. We will reserve the best seats available and send you all the necessary details - seat number/s, address, directions, etc. within 48 hours.<br /><br />";
	$semail .= "Your order:<br />";
	$semail .= "<strong>Name:</strong> {$ticket['name']}<br />";
	$semail .= "<strong>Email:</strong> {$ticket['email']}<br />";
	$semail .= "<strong>Date:</strong> {$ticket['date']}<br />";
	$semail .= "<strong>Number of Seats:</strong> {$ticket['seats']}<br />";
	$semail .= "<strong>Showing Time:</strong> {$ticket['time']}<br /><br />";
	
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

<div id="tickets">
	<h2 id="generictitle">Theatre Tickets</h2>

	<div id="ticketscontent">
		<p><strong>Book Your Prague Opera Tickets</strong></p>
		<ul>
			<li>Most updated Prague opera schedule</li>
			<li>You don't pay any reservation fee to us</li>
			<li>Credit card payment possible</li>
			<li><a href="http://www.czechopera.cz/opera.php?dealer=80" target="_blank">Book now</a> (you will be forwarded to our partner's website)</li>
		</ul>
		
		<p><strong>Unique Black Light Theatre Of Prague - Get 100 CZK OFF - Free Reservation</strong></p>
		<p>The black light theatre is unique to Prague; it was invented here in the 1960´s. It is mime and music - a visual show - 
			so everyone can understand. Private Walks has arranged a discount for our clients at the TaFantastika Black Light Theatre, 
			which is, according to our opinion, the best one of its kind. The show is called "Aspects of Alice" and it is an adaptation 
			of Alice in Wonderland (duration 90 min).</a>

		<p><strong>Why To Book The Black Light Theatre With Us</strong></p>
		<ul>
			<li>Private Walks has a pre-reservation in the TaFantastika Black Light Theatre; therefore, we can get you the best seats.</li>
			<li>You will pay 100 CZK less than the normal price (680 CZK).</li>
			<li>Reservations through our website are  free of charge and  will be made in your name.</li>
		</ul>

		<p>Fill out the fields of the reservation form below, and we will send you a confirmation with exact seat numbers and all 
			details by email.</p>
	
		<p><strong>Reservation Form</strong></p>
		<form id="ticketform" method="post" action="<?php bloginfo('siteurl'); ?>/index.php/tickets/">
			<input type="hidden" name="action" value="order" />
			<label>Name<up>*</up></label><input class="block" name="tname" value="<?php echo $ticket['name']; ?>" size="40" />
			<label>Email<up>*</up></label><input class="block" name="temail" value="<?php echo $ticket['email']; ?>" size="40" />
			<label>Date<up>*</up></label><input class="block" name="tdate" value="<?php echo $ticket['date']; ?>" size="15" />
			<label>Showing Times<up>*</up></label>
			<select name="ttime">
				<option value="7pm" <?php if($ticket['time'] == '7pm') echo 'selected'; ?> >7pm</option>
				<option value="9:30pm" <?php if($ticket['time'] == '9:30pm') echo 'selected'; ?> >9:30pm</option>
			</select>
			<label>Number of Seats<up>*</up></label><input class="block" name="tseats" value="<?php echo $ticket['seats']; ?>" size="4" />

			<p><small>*Obligatory form fields. Submitted personal information will not be disclosed to any third party.</small></p>

			<div id="orderbuttons">
				<a class="centered" href="javascript:void()" onClick="document.getElementById('ticketform').submit()">SUBMIT</a>
			</div>
			
			<br />
			<table>
				<tr>
					<td>
						<a href="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/black_light_theatre.jpg" rel="lightbox">
						<img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/black_light_theatre_th.jpg"/>
						</a>
						&nbsp;
					</td>
					<td>
						<a href="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/black_light_theatre3.jpg" rel="lightbox">
						<img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/black_light_theatre3_th.jpg"/>
						</a>
					</td>
				</tr>
			</table>
			<br />
			<p><strong>What is black light theatre and how did it develop?</strong></p>
			<p>The principle of black light theatre is an optical trick known as the black box trick, which takes advantage of the 
				imperfection of the human eye: the eye cannot distinguish between black on black. In the theatre the trick is in fact 
				very simple: the audience cannot see an actor dressed in black against a black background. Props operated by actors dressed 
				in black are able to move independently before our very eyes. Inanimate objects become participants in the drama, 
				attaining equal status with the live actors. However the basic black box trick itself is extremely ancient. It was first 
				used in China, to entertain the emperors, before being adopted by the Japanese in the 18th century, where it was used by 
				Japanese puppet theatres. At the end of the 19th and beginning of the 20th century, George Melies used the black box trick to 
				record his first films. During the 1950s, French avant-garde puppeteers played with props using actors dressed in black and 
				one of these, George Lafaye, is generally referred to as the father of black light theatre. And finally, we should not forget 
				that even giants of the stage, such as STANISLAVSKIJ in his famous "Blue Bird" performance also used this trick. In order 
				to make the black box trick a strong enough base for a theatre performance, it had to become the central theme rather than its end. 
				This means that instead of the effect of the trick being the result of the story, it becomes the starting point of the drama itself. 
				This created a whole new stage language which has become famous worldwide thanks to Czech black light theatre companies. From the 
				beginning of the 1980s, the TA FANTASTIKA theatre was already introducing intensive input into the acting and dramatic situations 
				into black light theatre. Unique and patented technical tricks began to be used, such as actors flying in the air directly in front of 
				the audience, a combination of wide screen projections, live actors on stage and huge puppets, as well as the use of artistic elements 
				as an essential part of the visual performance, music and live singers. The fact of producing a perfect artistic symbiosis between the 
				technical and theatrical elements to its performances sets TA FANTASTIKA apart from the other black light theatres.</p>
		</form>
	</div>
</div>

<?php get_footer(); ?>