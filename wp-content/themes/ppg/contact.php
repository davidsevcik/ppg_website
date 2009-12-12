<?php
/*
Template Name: Contact
*/ 
get_header();

if ($_POST['submit'] && empty($_POST['surname'])) {
	$errors = array();
	$body = array();

	$email = safe($_POST['email']);

	if (!ereg('^([A-Za-z0-9\.|-|_-]{1,60})([@])([A-Za-z0-9\.|-|_-]{1,60})(\.)([A-Za-z]{2,3})$', $email)) 
		$errors['email'] = 'E-mail has to be in correct format';

	if (empty($errors)) {
		$body[] = "Name: " . safe($_POST['fullname']);
		$body[] = "E-mail: " . $email;
		$body[] = "Message:<br /> " . str_replace("\n", "<br />", safe($_POST['message']));

		$sendemail = get_option('toursemail');
		require('class-phpmailer.php');

		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->AddAddress($sendemail);
		$mail->AddAddress($email);
		$mail->IsHTML(true);
		$mail->Body = implode("<br />", $body);
		$mail->From = $email;
		$mail->FromName = 'Private-Prague-Guide.com';
		$mail->Subject = 'Your Private Guided Tours in Prague / Czech Republic';
		$mail->Send();
		$sended = true;
	}
} 
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h1 id="generictitle"><?php the_title(); ?></h1>
	<div class="entry" id="contact-page">
		<?php if($sended): ?>
			<p>Dear <?= $_POST['fullname'] ?>,</p>

			<p>Thank you for contacting me.<br />
			I will get back to you within 48 hours and answer all your questions.</p>

			<p>Sincerely yours,</p>

			<p><strong>Jay Pesta</strong><br />
			President &amp; Private Prague Guide<br />
			PRIVATE-PRAGUE-GUIDE.COM<br />
			Travel Agency Custom Travel Services s.r.o.<br />
			Blanicka st. 25 | Prague 2 | Czech Republic<br />
			Tel (24/7): +420 773 103 102</p>
		<?php else: ?>

			<div class="infobox-top"></div>
			<div class="infobox">
				<h3>Send me your message</h3>
				<?php if (!empty($errors)): ?>
					<div class="errors">
						<p>Form cannot be submited because:</p>
						<ul>
							<?php foreach ($errors as $error) echo "<li>$error</li>\n" ?>
						</ul>
					</div>
				<?php endif ?>
				<form method="post" action=".">
					<input type="text" name="surname" style="display:none" />
					<table>
						<tr>
							<th width="80"><label for="name">Name:</label></th>
							<td><input type="text" name="fullname" size="30" /></td>
						</tr>
						<tr>
							<th><label for="name">E-mail: </label></th>
							<td><input type="text" name="email" value="@" size="30" /> <small>(required)<br />
							If you haven't received a reply you probably typed in a wrong email address.
							Please double-check your email.</small></td>
						</tr>
						<tr>
							<th><label for="message">Message:</label></th>
							<td><textarea rows="8" cols="60" name="message"></textarea></td>
						</tr>
						<tr>
							<td></td> <td><input type="submit" class="submit" name="submit" value="Submit" /></td>
						</tr>
					</table>					
				</form>
			</div>
			<div class="infobox-bottom"></div>

			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
		<?php endif ?>
	</div>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>