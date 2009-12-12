<?php
/*
Template Name: Transport Door-To-Door
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();

$prices_meta = get_post_meta(get_the_id(), 'prices', true);

$PRICES = eval('return '.$prices_meta); /*array(
  'Vienna - Prague' => array('CZK' => 6900, 'EUR' => 265, 'USD' => 363, 'duration' => 4),
  'Salzburg - Prague' => array('CZK' => 7900, 'EUR' => 304, 'USD' => 416, 'duration' => 5),
  'Linz - Prague' => array('CZK' => 6900, 'EUR' => 265, 'USD' => 363, 'duration' => 3.5),
  'Budapest - Prague' => array('note' => true, 'CZK' => 11900, 'EUR' => 458, 'USD' => 626, 'duration' => 6.5),
  'Bratislava - Prague' => array('CZK' => 6900, 'EUR' => 265, 'USD' => 363, 'duration' => 4),
  'Cracow - Prague' => array('CZK' => 11900, 'EUR' => 458, 'USD' => 626, 'duration' => 6.5),
  'Worsaw - Prague' => array('note' => true, 'CZK' => 12900, 'EUR' => 496, 'USD' => 679, 'duration' => 8.5),
  'Dresden - Prague' => array('CZK' => 5600, 'EUR' => 215, 'USD' => 295, 'duration' => 2.5),
  'Berlin - Prague' => array('CZK' => 7900, 'EUR' => 304, 'USD' => 416, 'duration' => 4.5),
  'Munich - Prague' => array('CZK' => 7900, 'EUR' => 304, 'USD' => 416, 'duration' => 4.5),
  'Frankfurt - Prague' => array('note' => true, 'CZK' => 11900, 'EUR' => 458, 'USD' => 626, 'duration' => 6.5),
  'Nuremberg - Prague' => array('CZK' => 6900, 'EUR' => 265, 'USD' => 363, 'duration' => 4)
);*/
      

if($_POST['action'] == 'order') {
    $transport = array();
	$transport['name'] = safe($_POST['tname']);
	$transport['email'] = safe($_POST['email']);
	$transport['phone'] = safe($_POST['phone']);
	$transport['date'] = safe($_POST['date']);
	$transport['time'] = safe($_POST['time']);
	$transport['number_of_passengers'] = safe($_POST['number_of_passengers']);
	$transport['from_to'] = safe($_POST['from_to']);
	$transport['custom_from_to'] = safe($_POST['custom_from_to']);
	$transport['departure_address'] = safe($_POST['departure_address']);
	$transport['arrival_address'] = safe($_POST['arrival_address']);
	$transport['special_request'] = safe($_POST['special_request']);

    ob_start();
    require('transport3_complete.php');
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
    $mail->Subject = 'Door-To-Door Transportation Request';
    $mail->Send();

}

get_header();
?>

<div id="transport">
<?php ob_start() ?>
    <table class="stylish">
        <tr>
            <th rowspan="2">Transportation<br /> From - To</th>
            <th colspan="3">Price</th>
            <th rowspan="2">Duration - Hours<br /> <span>(one way)</span></th>
        </tr>
        <tr>
            <th>CZK</th>
            <th>EUR<sup>*</sup></th>
            <th>USD<sup>*</sup></th>
        </tr>
        <?php foreach ($PRICES as $name => $data) : ?>
          <tr>
            <td class="em"><?php echo $name.($data['note'] ? ' <sup>**</sup>' : '') ?></td>
            <td><?php echo $data['CZK'] ?></td>
            <td><?php echo $data['EUR'] ?></td>
            <td><?php echo $data['USD'] ?></td>
            <td><?php echo $data['duration'] ?></td>
          </tr>
        <?php endforeach ?>
    </table>
<?php 
  $form = ob_get_contents(); 
  ob_end_clean(); 

  function print_prices($content) {
    global $form;
    return str_replace('[[prices]]', $form, $content);
  }

  add_filter('the_content', 'print_prices');
?>

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
                    <tr><td><label for="name">Name<sup>*</sup></label></td> <td><input type="text" name="tname" size="40" /></td></tr>
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
                        <td><label for="from_to">From – To<sup>*</sup></label></td>
                        <td><select name="from_to" id="from-to">
                          <?php foreach ($PRICES as $name => $data) : ?>
                            <option><?php echo $name ?></option>
                          <?php endforeach ?>
                          <option value="custom">Other (specify)</option>
                        </select>
                        </td>
                    </tr>
                    <tr style="display:none" id="custom-from-to"><td><label for="custom_from_to">Custom From - To<sup>*</sup></label></td> <td><input type="text" name="custom_from_to" size="40" /></td></tr>
                    <tr><td><label for="departure_address">Departure Address<sup>*</sup></label></td>
                    <td><textarea cols="50" rows="4" name="departure_address"></textarea></td></tr>
                    <tr><td><label for="arrival_address">Arrival Address<sup>*</sup></label></td>
                    <td><textarea cols="50" rows="4" name="arrival_address"></textarea></td></tr>
                    <tr><td><label for="special_request">Special Request <small>(extra large luggage, a wheelchair, baby on board, etc.)</small></label></td>
                    <td><textarea cols="50" rows="4" name="special_request"></textarea></td></tr>
                </table>
                
                <div id="cost-wrap">
                  <p><strong>Total Price (no hidden costs):</strong> 
                  <span id="cost">
                    <?php $first_cost = $PRICES['Vienna - Prague']; echo $first_cost['CZK']; ?> CZK /
                    <?php echo $first_cost['EUR'] ?> EUR /
                    <?php echo $first_cost['USD'] ?> USD
                  </span>
                  </p>
                </div>

                <div class="footnotes">
                    <p><sup>*</sup> Indicates required items. Submitted personal information will not be disclosed to any third party.</p>
                </div>

                <p class="center"><input type="submit" value="Send Request" class="submit-btn" /></p>
            </form>
            <script  type="text/javascript">
                $('from-to').observe('change', function(event) {
                    var value = Event.element(event).getValue();
                    if (value == 'custom') { 
                      $('custom-from-to').show(); 
                      $('cost').replace('<span id="cost">N/A <br /><small>(You have chosen transport from/to custom location. We will send you current price)</small></span>');
                    } else { 
                      $('custom-from-to').hide(); 
                      var PRICES = <?php echo json_encode($PRICES) ?>;
                      var cost = PRICES[value];
                      $('cost').replace('<span id="cost">' + cost.CZK + ' CZK / ' + cost.EUR + ' EUR / ' + cost.USD + ' USD</span>');
                    }
                });
            </script>
        <? } ?>
    </div>
    <div class="infobox-bottom"></div>
</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>