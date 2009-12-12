<p>Dear <?= $transport['name'] ?>,</p>

<p>Thank you for booking transportation services through my website. I will contact you within 48 hours, answer your questions and send you all the necessary details.</p>

<h3>Order Details:</h3>

<p>
<strong>Name:</strong> <?= $transport['name'] ?><br />
<strong>E-mail:</strong> <?= $transport['email'] ?><br />
<strong>Contact Phone:</strong> <?= $transport['phone'] ?><br />
<strong>Transport Date:</strong> <?= $transport['date'] ?><br />
<strong>Time of Departure:</strong> <?= $transport['time'] ?><br />
<strong>No. of Passengers:</strong> <?= $transport['number_of_passengers'] ?><br />
<? if ($transport['from_to'] == 'custom'): ?>
<strong>Custom From - To:</strong> <?= $transport['custom_from_to'] ?><br />
<? else: ?>
<strong>From - To:</strong> <?= $transport['from_to'] ?><br />
<? endif ?>
<strong>Departure Address:</strong> <?= $transport['departure_address'] ?><br />
<strong>Arrival Address:</strong> <?= $transport['arrival_address'] ?><br />
<strong>Special Request:</strong> <?= $transport['special_request'] ?><br />
<?php if ($transport['from_to'] != 'custom'): $price = $PRICES[$transport['from_to']] ?>
	<strong>Total Price:</strong> <?= $price['CZK'].' CZK / '.$price['EUR'].' EUR / '.$price['USD'].' USD' ?>
<?php endif ?>
</p>

<br />
<p>Sincerely yours,</p>

<p><strong>Jay Pesta</strong><br />
President & Private Prague Guide<br />
PRIVATE-PRAGUE-GUIDE.COM<br />
Travel Agency Custom Travel Services s.r.o.<br />
Blanická st. 25 | Prague 2 | Czech Republic<br />
Tel (24/7): +420 773 103 102</p>