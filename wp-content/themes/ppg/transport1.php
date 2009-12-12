<?php
/*
Template Name: Transport Airport-Hotel
*/
get_header();
if (have_posts()) : while (have_posts()) : the_post();


$STATION_OPTIONS = array(1 => 'Prague Airport – Ruzyne', 'Main Train Station - Wilson', 'Train Station - Holesovice');

$prices_meta = get_post_meta(get_the_id(), 'prices', true);

$PRICES = eval('return '.$prices_meta); /*array(
  'airport' => array(
    'one_way' => array(
      '1-4' => array('CZK' => 700, 'EUR' => 28, 'USD' => 39),
      '5-8' => array('CZK' => 1100, 'EUR' => 43, 'USD' => 62)),
    'round_trip' => array(
      '1-4' => array('CZK' => 1300, 'EUR' => 51, 'USD' => 73),
      '5-8' => array('CZK' => 2100, 'EUR' => 84, 'USD' => 117))),
  'railway' => array(
    'one_way' => array(
      '1-4' => array('CZK' => 600, 'EUR' => 24, 'USD' => 34),
      '5-8' => array('CZK' => 800, 'EUR' => 32, 'USD' => 45)),
    'round_trip' => array(
      '1-4' => array('CZK' => 1100, 'EUR' => 44, 'USD' => 62),
      '5-8' => array('CZK' => 1500, 'EUR' => 59, 'USD' => 84))));*/


if($_POST['action'] == 'order') {
    $transport = array();
	$transport['name'] = safe($_POST['tname']);
	$transport['email'] = safe($_POST['email']);
	$transport['phone'] = safe($_POST['phone']);
	$transport['number_of_passengers'] = intval($_POST['number_of_passengers']);
	$transport['type'] = safe($_POST['type']);
	$transport['type_name'] = ($transport['type'] == 1 ? 'Arrival Transfer' : ($transport['type'] == 2 ? 'Departure Transfer' : 'Both – Round Trip'));
	$transport['arrival_to'] = safe($_POST['arrival_to']);
	$transport['arrival_date'] = safe($_POST['arrival_date']);
	$transport['arrival_time'] = safe($_POST['arrival_time']);
	$transport['arrival_flight_number'] = safe($_POST['arrival_flight_number']);
	$transport['arrival_accomodation'] = safe($_POST['arrival_accomodation']);
	$transport['arrival_request'] = safe($_POST['arrival_request']);
    $transport['departure_from'] = safe($_POST['departure_from']);
	$transport['departure_date'] = safe($_POST['departure_date']);
	$transport['departure_time'] = safe($_POST['departure_time']);
	$transport['departure_pick_up_time'] = safe($_POST['departure_pick_up_time']);
	$transport['departure_accomodation'] = safe($_POST['departure_accomodation']);
	$transport['departure_request'] = safe($_POST['departure_request']);

    ob_start();
    require('transport1_complete.php');
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
    $mail->Subject = 'Airport Transfer Booking';
    $mail->Send();

}

?>

<div id="transport">

      <?php ob_start() ?>
      <div class="transportcontent">
        <h2>Prices</h2>
        <h3>Airport Transfer</h3>
        <table class="stylish">
            <tr><td class="empty"></td><th colspan="2">Arrival or Departure Transfer</th>	<th colspan="2">Round Trip</th></tr>
            <tr><td class="empty"></td><th>1-4 people</th>	<th>5-8 people</th>	<th>1-4 people</th>	<th>5-8 people</th></tr>
            <tr>
              <td class="em">CZK</td>    
              <td><?php echo $PRICES['airport']['one_way']['1-4']['CZK'] ?></td>	
              <td><?php echo $PRICES['airport']['one_way']['5-8']['CZK'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['1-4']['CZK'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['5-8']['CZK'] ?></td>
            </tr>
            <tr>
              <td class="em">EUR<sup>*</sup></td> 	
              <td><?php echo $PRICES['airport']['one_way']['1-4']['EUR'] ?></td>
              <td><?php echo $PRICES['airport']['one_way']['5-8']['EUR'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['1-4']['EUR'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['5-8']['EUR'] ?></td>
            </tr>
            <tr>
              <td class="em">USD<sup>*</sup></td> 	
              <td><?php echo $PRICES['airport']['one_way']['1-4']['USD'] ?></td>	
              <td><?php echo $PRICES['airport']['one_way']['5-8']['USD'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['1-4']['USD'] ?></td>	
              <td><?php echo $PRICES['airport']['round_trip']['5-8']['USD'] ?></td>
            </tr>
        </table>
        <p><sup>*</sup> Prices in EUR and USD are to be calculated according to current rates.</p>

        <h3>Railway Station Transfer</h3>
        <table class="stylish">
            <tr><td class="empty"></td><th colspan="2">Arrival or Departure Transfer</th>	<th colspan="2">Round Trip</th></tr>
            <tr><td class="empty"></td><th>1-4 people</th>	<th>5-8 people</th>	<th>1-4 people</th>	<th>5-8 people</th></tr>
            <tr>
              <td class="em">CZK</td>    
              <td><?php echo $PRICES['railway']['one_way']['1-4']['CZK'] ?></td>	
              <td><?php echo $PRICES['railway']['one_way']['5-8']['CZK'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['1-4']['CZK'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['5-8']['CZK'] ?></td>
            </tr>
            <tr>
              <td class="em">EUR<sup>*</sup></td> 	
              <td><?php echo $PRICES['railway']['one_way']['1-4']['EUR'] ?></td>
              <td><?php echo $PRICES['railway']['one_way']['5-8']['EUR'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['1-4']['EUR'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['5-8']['EUR'] ?></td>
            </tr>
            <tr>
              <td class="em">USD<sup>*</sup></td> 	
              <td><?php echo $PRICES['railway']['one_way']['1-4']['USD'] ?></td>	
              <td><?php echo $PRICES['railway']['one_way']['5-8']['USD'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['1-4']['USD'] ?></td>	
              <td><?php echo $PRICES['railway']['round_trip']['5-8']['USD'] ?></td>
            </tr>
        </table>
        <p><sup>*</sup> Prices in EUR and USD are to be calculated according to current rates.</p>

        <p><strong>Payment method:</strong> directly to your driver in CZK, EUR, USD (cash only).</p>
    </div>

    <div class="infobox-top"></div>
    <div class="infobox" id="orderbox">
        <h2>Book Your Airport / Railway Station Transfer</h2>
        <? if ($confirmation) { echo $confirmation; } else { ?>
            <form id="transportform" method="post" action="#orderbox">
                <input type="hidden" name="action" value="order" />
                <table class="form">
                    <tr><td><label for="name">Name<sup>*</sup></label></td> <td><input type="text" name="tname" size="40" /></td></tr>
                    <tr>
                        <td><label for="email">Email<sup>*</sup></label></td> 
                        <td>
                            <input type="text" name="email" size="40" /><br />
                            <small>If you haven't received a reply you probably typed in a wrong email address.<br />
                            Please double-check your email.</small>
                        </td>
                    </tr>
                    <tr><td><label for="phone">Contact Phone</label></td> <td><input type="text" name="phone" size="40" /></td></tr>
                    <tr><td><label for="number_of_passengers">No. of Passengers<sup>*</sup></label></td> <td><input type="text" name="number_of_passengers" id= "number_of_passengers" size="10" /></td></tr>
                    <tr>
                        <td><label for="type">I want to book:</label></td>
                        <td>
                            <input type="radio" name="type" id="type-arrival" value="1" checked="checked" /> <strong>Arrival Transfer</strong> (Airport => Your Hotel)<br />
                            <input type="radio" name="type" id="type-departure" value="2" /> <strong>Departure Transfer</strong> (Your Hotel => Airport)<br />
                            <input type="radio" name="type" id="type-both" value="3" /> <strong>Both – Round Trip</strong> (Airport => Your Hotel => Airport)
                        </td>
                    </tr>
                </table>

                <div id="arrival">
                    <h3>Arrival Transfer</h3>
                    <table class="form">
                        <tr><td><label for="arrival_to">Arrival to Prague<sup>*</sup></label></td>
                            <td><select name="arrival_to" id="arrival_to">
                              <?php foreach ($STATION_OPTIONS as $key => $name): ?>
                                <option value="<?php echo $key ?>"><?php echo $name ?></option>
                              <?php endforeach ?>
                            </select></td>
                        </tr>
                        <tr><td><label for="arrival_date">Date of Arrival<sup>*</sup></label></td>
                        <td><input type="text" name="arrival_date" id="arrival-date" /></td></tr>
                        <tr><td><label for="arrival_time">Time of Arrival<sup>*</sup></label></td> <td><input type="text" name="arrival_time" /></td></tr>
                        <tr><td><label for="arrival_flight_number">Flight Number/Train Name<sup>*</sup></label></td> <td><input type="text" name="arrival_flight_number" /></td></tr>
                        <tr><td><label for="arrival_accomodation">Accommodation Address<sup>*</sup></label></td>
                        <td><textarea cols="50" rows="4" name="arrival_accomodation"></textarea></td></tr>
                        <tr><td><label for="arrival_request">Special Request <br /><small>(extra large luggage, a wheelchair, baby on board, etc.)</small></label></td>
                        <td><textarea cols="50" rows="4" name="arrival_request"></textarea></td></tr>
                    </table>
                </div>

                <div id="departure" style="display:none">
                    <h3>Departure Transfer</h3>
                    <table class="form">
                        <tr><td><label for="departure_from">Departure from Prague<sup>*</sup></label></td>
                            <td><select name="departure_from" id="departure_from">
                              <?php foreach ($STATION_OPTIONS as $key => $name): ?>
                                <option value="<?php echo $key ?>"><?php echo $name ?></option>
                              <?php endforeach ?>
                            </select></td>
                        </tr>
                        <tr><td><label for="departure_date">Date of Departure<sup>*</sup></label></td>
                        <td><input type="text" name="departure_date" id="departure-date" /></td></tr>
                        <tr><td><label for="departure_time">Time of Departure<sup>*</sup></label></td> <td><input type="text" name="departure_time" /></td></tr>
                        <tr><td><label for="departure_accomodation">Pick Up From<sup>*</sup> <br /><small>(if your arrival accommodation address changed)</small></label></td>
                        <td><textarea cols="50" rows="4" name="departure_accomodation"></textarea></td></tr>
                        <tr><td><label for="departure_pick_up_time">Pick Up Time<sup>*</sup> <br /><small>(we recommend 2.5 hours before departure)</small></label></td> <td><input type="text" name="departure_pick_up_time" /></td></tr>
                        <tr><td><label for="departure_request">Special Request <br /><small>(extra large luggage, a wheelchair, baby on board, etc.)</small></label></td>
                        <td><textarea cols="50" rows="4" name="departure_request"></textarea></td></tr>
                    </table>
                </div>
                
                <div id="cost-wrap">
                  <p><strong>Total Price (no hidden costs):</strong> <span id="cost"><br /><small>(will be calculated after you type number of passangers)</small></span></p>
                </div>

                <div class="footnotes">
                    <p><sup>*</sup> Indicates required items. Submitted personal information will not be disclosed to any third party.</p>
                </div>

                <p class="center"><input type="submit" value="Send Request" class="submit-btn" /></p>
                
                <script  type="text/javascript">
                    var transport_type = 1;
                    function calculatePrice(numPassangers) {
                        var PRICES = <?php echo json_encode($PRICES) ?>;
                        var is_airport = (transport_type == 1 && $F('arrival_to') == 1) || (transport_type == 2 && $F('departure_from') == 1) || (transport_type == 3 && ($F('arrival_to') == 1 || $F('departure_from') == 1));
                        var passangers = parseInt($F('number_of_passengers'));
                        if (isNaN(passangers) || (passangers < 0) || (passangers > 8)) {
                            $('cost').replace('<span id="cost">N/A <small>(Number of passangers is out of range)</small></span>');
                            if (passangers > 8) { alert('There are more people in your group than stated on the price list. Please contact my office and I will send you the correct price.'); }
                        } else {
                            var cost = PRICES[is_airport ? 'airport' : 'railway'][transport_type == 3 ? 'round_trip' : 'one_way'][passangers < 5 ? '1-4' : '5-8'];
                            $('cost').replace('<span id="cost">' + cost.CZK + ' CZK / ' + cost.EUR + ' EUR / ' + cost.USD + ' USD</span>');
                        }
                    }
    
                    $('type-arrival').observe('click', function() { $('arrival').show(); $('departure').hide(); transport_type = 1; calculatePrice(); });
                    $('type-departure').observe('click', function() { $('arrival').hide(); $('departure').show(); transport_type = 2; calculatePrice(); });
                    $('type-both').observe('click', function() { $('arrival').show(); $('departure').show(); transport_type = 3; calculatePrice(); });
                    $('number_of_passengers').observe('change', function(event) { calculatePrice(); });
                    $('arrival_to').observe('change', function() { calculatePrice() });
                    $('departure_from').observe('change', function() { calculatePrice() });
                </script>
            </form>
        <? } ?>
    </div>
    <div class="infobox-bottom"></div>
<?php 
  $form = ob_get_contents(); 
  ob_end_clean(); 
    
  function print_form($content) {
    global $form;
    return str_replace('[[prices_and_form]]', $form, $content);
  }

  add_filter('the_content', 'print_form');
?>

<h2 id="generictitle">Transportation Services</h2>
<h1><?php the_title(); ?></h1>
<div class="entry">
  <?php the_content(); ?>
  <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>


</div>

<?php endwhile; endif; ?>
<?php get_footer(); ?>