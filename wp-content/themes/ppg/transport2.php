<?
/*
Template Name: Transport by Car
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();


if($_POST['action'] == 'order') {
    $transport = array();
	$transport['name'] = safe($_POST['tname']);
	$transport['email'] = safe($_POST['email']);
	$transport['phone'] = safe($_POST['phone']);
	$transport['date'] = safe($_POST['date']);
	$transport['time'] = safe($_POST['time']);
	$transport['number_of_passengers'] = safe($_POST['number_of_passengers']);
	$transport['vehicle_type'] = safe($_POST['vehicle_type']);
	$transport['departure_address'] = safe($_POST['departure_address']);
	$transport['arrival_address'] = safe($_POST['arrival_address']);
	$transport['special_request'] = safe($_POST['special_request']);

    ob_start();
    require('transport2_complete.php');
    $confirmation = ob_get_contents();
    ob_end_clean();

    $sendemail = get_option('toursemail');
    require('class-phpmailer.php');

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->AddAddress($sendemail);
    $mail->AddAddress($transport['email']);
    $mail->IsHTML(true);
    $mail->Body = $confirmation;
    $mail->From = "$sendemail";
    $mail->FromName = 'Private-Prague-Guide.com';
    $mail->Subject = 'Transportation Request';
    $mail->Send();

}

?>

<div id="transport">
    <h2 id="generictitle">Transportation Services</h2>
	<h1><?php the_title() ?></h1>
    <div class="transportcontent">
        <?php the_content() ?>
        <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
    </div>

    <div class="infobox-top"></div>
    <div class="infobox" id="orderbox">
        <h2>Transportation Request Form (non-binding)</h2>
        <? if ($confirmation) { echo $confirmation; } else { ?>
            <form id="transportform" method="post" action="#orderbox">
                <input type="hidden" name="action" value="order" />
                <table class="form">
                    <tr><td style="width:20em"><label for="name">Name<sup>*</sup></label></td> <td><input type="text" name="tname" size="40" /></td></tr>
                    <tr><td><label for="email">Email<sup>*</sup></label></td> 
                        <td><input type="text" name="email" size="40" /><br />
                            <small>If you haven't received a reply you probably typed in a wrong email address.
                            Please double-check your email.</small>
                    </td></tr>
                    <tr><td><label for="phone">Contact Phone</label></td> <td><input type="text" name="phone" size="40" /></td></tr>
                    <tr><td><label for="date">Transport Date<sup>*</sup></label></td> <td><input type="text" name="date"  /></td></tr>
                    <tr><td><label for="time">Time of Departure<sup>*</sup></label></td> <td><input type="text" name="time" /></td></tr>
                    <tr><td><label for="number_of_passengers">No. of Passengers<sup>*</sup></label></td> <td><input type="text" name="number_of_passengers" size="10" /></td></tr>
                    <tr>
                        <td><label for="vehicle_type">Preferred Vehicle Type<sup>*</sup></label></td>
                        <td><select name="vehicle_type">
                            <option>Car</option>
                            <option>Limousine</option>
                            <option>Van</option>
                            <option>Limousine van</option>
                            <option>Minibus</option>
                            <option>Bus</option> 
                        </select></td>

                    </tr>
                    <tr><td><label for="departure_address">Departure Address<sup>*</sup></label></td>
                    <td><textarea cols="50" rows="4" name="departure_address"></textarea></td></tr>
                    <tr><td><label for="arrival_address">Arrival Address<sup>*</sup></label></td>
                    <td><textarea cols="50" rows="4" name="arrival_address"></textarea></td></tr>
                    <tr><td><label for="special_request">Special Request<br /> <small>(extra large luggage, a&nbsp;wheelchair, baby on board, etc.)</small></label></td>
                    <td><textarea cols="50" rows="4" name="special_request"></textarea></td></tr>
                </table>

                <div class="footnotes">
                    <p><sup>*</sup> Indicates required items. Submitted personal information will not be disclosed to any third party.</p>
                </div>

                <p class="center"><input type="submit" value="Send Request" class="submit-btn" /></p>
            </form>
        <? } ?>
    </div>
    <div class="infobox-bottom"></div>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>