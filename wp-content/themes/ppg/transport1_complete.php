<p>Dear <?= $transport['name'] ?>,</p>

<p>Thank you for booking your airport / train station transfer through my website.</p>
<p>I confirm your booking.</p>

<?php if ($transport['type'] != 2): ?>
	<h3>Transfer instructions</h3>
	<?php if ($transport['arrival_to'] == 1): ?>
		<p>Your driver will wait for you 20 minutes after your arrival at the airport hall (as you exit customs) holding a sign with your name on it.</p>
	<?php else: ?>
		<p>Your driver will wait for you directly on the platform, by the 3rd coach from the locomotive just upon your arrival time, holding a sign with your name on it.</p>
	<?php endif ?>
<?php endif ?>

<h3>Order Details</h3>

<strong>Name:</strong> <?= $transport['name'] ?><br />
<strong>E-mail:</strong> <?= $transport['email'] ?><br />
<strong>Contact Phone:</strong> <?= $transport['phone'] ?><br />
<strong>No. of Passengers:</strong> <?= $transport['number_of_passengers'] ?><br />
<strong>I want to book:</strong> <?= $transport['type_name'] ?><br />

<? if ($transport['type'] == 1 || $transport['type'] == 3): ?>
	<h4>Arrival Transfer</h4>
	<p>
	<strong>Arrival to Prague:</strong> <?= $STATION_OPTIONS[$transport['arrival_to']] ?><br />
	<strong>Date of Arrival:</strong> <?= $transport['arrival_date'] ?><br />
	<strong>Time of Arrival:</strong> <?= $transport['arrival_time'] ?><br />
	<strong>Flight Number/Train Name:</strong> <?= $transport['arrival_flight_number'] ?><br />
	<strong>Accommodation Address:</strong> <?= $transport['arrival_accomodation'] ?><br />
	<strong>Special Request:</strong> <?= $transport['arrival_request'] ?>
	</p>
<? endif; if ($transport['type'] == 2 || $transport['type'] == 3): ?>
	<h4>Departure Transfer</h4>
	<p>
	<strong>Departure from Prague:</strong> <?= $STATION_OPTIONS[$transport['departure_from']] ?><br />
	<strong>Date of Departure:</strong> <?= $transport['departure_date'] ?><br />
	<strong>Time of Departure:</strong> <?= $transport['departure_time'] ?><br />
	<strong>Pick Up From:</strong> <?= $transport['departure_accomodation'] ?><br />
	<strong>Pick Up Time:</strong> <?= $transport['departure_pick_up_time'] ?><br />
	<strong>Special Request:</strong> <?= $transport['departure_request'] ?>
	</p>
<? endif ?>

<?php
	if ($transport['number_of_passengers'] < 1 || $transport['number_of_passengers'] > 8) {
		$price = 'N/A (Number of passangers is out of range)';
	} else {
		$is_arport = ($transport['type'] == 1 && $transport['arrival_to'] == 1) || ($transport['type'] == 2 && $transport['departure_from'] == 1) || ($transport['type'] == 3 && ($transport['arrival_to'] == 1 || $transport['departure_from'] == 1));
		$cost = $PRICES[$is_arport ? 'airport' : 'railway'][$transport['type'] == 3 ? 'round_trip' : 'one_way'][$transport['number_of_passengers'] < 5 ? '1-4' : '5-8'];
		$price = $cost['CZK'].' CZK / '.$cost['EUR'].' EUR / '.$cost['USD'].' USD';
	}
?>

<strong>Total Price (no hidden costs):</strong> <?php echo $price ?>

<h3>Payment</h3>
<p>The payment shall be made directly to your driver in cash.</p>

<h3>Emergency number (My partner - The Prague Transfer Team)</h3>
<p>If you are not able to locate our driver, please call this emergency number <strong>+420 774 192 214</strong>  immediately. We will locate our driver for you. If your plane or train is for any reason cancelled please contact us by calling our emergency number and we will re-schedule your transfer to your best satisfaction. We are keeping eye on any delays. However, we can not control cancelled flights.</p>

<br />
<p>Have a wonderful journey. I am looking forward to seeing you in Prague.</p>
<p>Sincerely yours,</p>

<p><strong>Jay Pesta</strong><br />
President & Private Prague Guide<br />
PRIVATE-PRAGUE-GUIDE.COM<br />
Travel Agency Custom Travel Services s.r.o.<br />
Blanická st. 25 | Prague 2 | Czech Republic<br />
Tel (24/7): +420 773 103 102</p>