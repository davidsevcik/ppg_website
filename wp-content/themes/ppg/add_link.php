<?php
/*
Template Name: Add Link
*/

if ($_POST['action'] == 'submit_link') {
	$link = array_map('safe', $_POST['link']);
	$errors = array();
	
	if (empty($link['title'])) $errors['title'] = 'Site title cannot be empty';
	if (empty($link['url']) || $link['url'] == 'http://') $errors['url'] = 'Site URL cannot be empty';
	if (empty($link['reciprocal_url']) || $link['reciprocal_url'] == 'http://') $errors['reciprocal_url'] = 'Reciprocal URL cannot be empty';
	if (!ereg('^([A-Za-z0-9\.|-|_-]{1,60})([@])([A-Za-z0-9\.|-|_-]{1,60})(\.)([A-Za-z]{2,3})$', $link['email'])) 
		$errors['email'] = 'Contact e-mail has to be in correct format';

	if (empty($errors)) {
		ob_start();
		require('add_link_mail.php');
		$confirmation = ob_get_contents();
		ob_end_clean();
		require('class-phpmailer.php');
	
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->AddAddress('adela@private-prague-guide.com');
		$mail->AddAddress('david.sevcik@gmail.com');
		$mail->IsHTML(true);
		$mail->Body = $confirmation;
		$mail->From = $link['email'];
		$mail->FromName = 'Private-Prague-Guide.com';
		$mail->Subject = 'Submited link for exchange';
		$mail->Send();
		$submited = true;
	}
}
?>

<?php get_header(); ?>
<div class="post" id="add-link">
	<h1 id="generictitle"><?php the_title(); ?></h1>
	<div class="entry">
		<?php if ($submited): ?>
			<p>Thank you for submiting your link, we will check submited information and add link on our site soon.</p>
		<?php else: ?>
			<h2>1. Put our banner or link on your site</h2>
			<img src="http://www.private-prague-guide.com/private-prague-guide.gif" width="120" height="60" alt="Private Prague Guide" />
			<small>(animated)</small>
			<p class="copy-code">Copy code:</p>
			<form method="post" action="">
				<textarea name="test" rows="4" cols="50"><a href="http://www.private-prague-guide.com/"><img src="http://www.private-prague-guide.com/private-prague-guide.gif" width="120" height="60" alt="Private Prague Guide" /></a></textarea>
			</form>
			
			<h3>or</h3>
			
			<img src="http://www.private-prague-guide.com/private-prague-guide2.gif" width="120" height="60" alt="Private Prague Guide" />
			<small>(static)</small>
			<p class="copy-code">Copy code:</p>
			<form method="post" action="">
				<textarea name="test" rows="4" cols="50"><a href="http://www.private-prague-guide.com/"><img src="http://www.private-prague-guide.com/private-prague-guide2.gif" width="120" height="60" alt="Private Prague Guide" /></a></textarea>
			</form>

			<h3>or</h3>
			
			<p>
				<a href="http://www.private-prague-guide.com/">Private Prague Guide</a><br />
				Private guided tours in Prague and the Czech Republic. Recommended by Fodor´s.
			</p>
			<p class="copy-code">Copy code:</p>
			<form method="post" action="">
				<textarea name="test" rows="4" cols="50"><p><a href="http://www.private-prague-guide.com/">Private Prague Guide</a><br />Private guided tours in Prague and the Czech Republic. Recommended by Fodor´s.</p></textarea>
			</form>
		
			
			
			<h2>2. Submit information about your site</h2>
			<form method="post" id="add-link-form" action="#add-link-form">
				<?php if (!empty($errors)): ?>
					<div class="errors">
						<p>Form cannot be submited because:</p>
						<ul>
							<?php foreach ($errors as $error) echo "<li>$error</li>\n" ?>
						</ul>
					</div>
				<?php endif ?>
				<input type="hidden" name="action" value="submit_link" />
				<table>
					<tr>
						<th width="180"><label for="link-title">Site title <sup class="required">*</sup></label></th> 
						<td><input type="text" id="link-title" name="link[title]" value="<?php echo $link['title'] ?>" size="40" /></td>
					</tr>
					<tr>
						<th><label for="link-url">Site URL <sup class="required">*</sup></label></th> 
						<td><input type="text" id="link-url" name="link[url]" value="<?php echo $link['url'] ? $link['url'] : 'http://' ?>"  size="40" /></td>
					</tr>
					<tr>
						<th><label for="link-description">Site description</label>
							<br /><small>Optional</small></th> 
						<td><textarea id="link-description" name="link[description]" cols="50" rows="5"><?php echo $link['description'] ?></textarea></td>
					</tr>
					<tr>
						<th><label for="link-bannerurl">Your banner URL</label>
							<br /><small>If you have it and you also use our banner</small></th> 
						<td><input type="text" id="link-bannerurl" name="link[banner_url]" value="<?php echo $link['banner_url'] ? $link['banner_url'] : 'http://' ?>"  size="40" /></td>
					</tr>
					<tr>
						<th><label for="link-reciprocalurl">Reciprocal URL <sup class="required">*</sup></label>
							<br /><small>Where you put our link</small></th> 
						<td><input type="text" id="link-reciprocalurl" name="link[reciprocal_url]" value="<?php echo $link['reciprocal_url'] ? $link['reciprocal_url'] : 'http://' ?>"  size="40" /></td>
					</tr>
					<tr>
						<th><label for="link-email">Contact e-mail <sup class="required">*</sup></label></th> 
						<td><input type="text" id="link-email" name="link[email]" value="<?php echo $link['email'] ?>"  size="40" /></td>
					</tr>
					<tr>
						<th><label for="message">Message for us</label>
							<br /><small>Optional</small></th> 
						<td><textarea id="message" name="link[message]" cols="50" rows="5"><?php echo $link['message'] ?></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Submit" /></td>
					</tr>
				</table>
			</form>
			<p><small class="required"><sup>*</sup> Required</small></p>
		<?php endif ?>
	</div>
</div>

<?php get_footer(); ?>
