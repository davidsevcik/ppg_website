<?php
$action = empty($_GET['action']) ? 'list' : $_GET['action'];

$hotels = array(
	1 => 'http://www.booking.com/hotel/cz/ariahotelprague.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	2 => 'http://www.booking.com/hotel/cz/reshotelalchymistprague.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	3 => 'http://www.booking.com/hotel/cz/irongate.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	4 => 'http://www.booking.com/hotel/cz/alchymist-residence-nosticova.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	5 => 'http://www.booking.com/hotel/cz/ventanahotelprague.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	6 => 'http://www.booking.com/hotel/cz/u-zlate-studne.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	7 => 'http://www.booking.com/hotel/cz/santini-residence.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	8 => 'http://www.booking.com/hotel/cz/hilton-prague-old-town.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	9 => 'http://www.booking.com/hotel/cz/hotelmetamorphis.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	10 => 'http://www.booking.com/hotel/cz/u-prince.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	11 => 'http://www.booking.com/hotel/cz/floor.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	12 => 'http://www.booking.com/hotel/cz/u-jezulatka.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	13 => 'http://www.booking.com/hotel/cz/the-icon-boutique.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	15 => 'http://www.booking.com/hotel/cz/archibald-u-karlova-mostu.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	16 => 'http://www.booking.com/hotel/cz/rezidencelundborg.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	17 => 'http://www.booking.com/hotel/cz/savic.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	18 => 'http://www.booking.com/hotel/cz/cloister-inn.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	19 => 'http://www.booking.com/hotel/cz/u-medvidku.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	20 => 'http://www.booking.com/hotel/cz/salvator.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	21 => 'http://www.booking.com/hotel/cz/oldtownapartmentsprag.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205',
	22 => 'http://www.booking.com/hotel/cz/pav.html?aid=317616&sid=b8d032b9b1195b9a47c969bf76f3a205'
);
?>

<?php get_header(); ?>

<script type="text/javascript">
</script>

<div id="hotels">
	<h2>Accommodation</h2>
	<?php if($action == 'list') { ?>
		<p><strong>Why To Book Accommodation Through Our Website:</strong></p>
		<p>
		<ul>
			<li>We are using what is probably the most common and safe on-line hotel
		reservation tool of today: Booking.com (over 19 million rooms booked
		in 2007)</li>
			<li>Out of 319 hotels in Prague available at Booking.com we have chosen
		the most charming ones located in the very historical city center.</li>
			<li>No reservation fees, payment on checkout.</li>
			<li>You don't pay any commission to us.</li>
			<li>Credit card is only used as a guarantee of your reservation (in case of late cancellation or should you not arrive).</li>
		</ul>
		</p>
		<p><strong>After the 4 steps of the booking process</strong> you need to click on "make the reservation". You will then see a confirmation page with your book number and PIN code, 
			your booking is now confirmed. For future reference, please write or print your book.</p>
		<br />
		<div id="list">
			<table>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Aria.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=1">Aria Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Luxury boutique music themed hotel located in the historical district of Mala Strana. Magnificently designed in 
							Italian Renaissance style and with direct access to the Baroque Vrtbovska Gardens ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=1">more</a></p>
						<p class="address">Trziste 9, Prague</p>
					</td>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Alchymist.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=2">Alchymist Grand Hotel and Spa</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Just 5 minutes' walk away from Charles Bridge, located in the most prestigious part of the historical centre, 
							this hotel is housed in a landmark building ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=2">more</a></p>
						<p class="address">Trziste 19, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/IronGate.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=3">The Iron Gate Hotel & Suites</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Centrally situated in the Old Town, down a picturesque cobbled side street mere minutes from the famous square, 
							this hotel is the perfect choice for enjoying the wonders of Prague ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=3">more</a></p>
						<p class="address">Michalska 19, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/AlchymistResidence.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=4">Alchymist Residence Nosticova</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Housed in a historic 17th-century building on a small quiet street in Lesser Town, just 2 minutes from famous 
							Charles Bridge, this hotel is a great base for exploring Prague ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=4">more</a></p>
						<p class="address">Nosticova 1, Praha 1</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Ventana.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=5">Ventana Hotel Prague</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">The "Ventana" is located in the immediate vicinity of the world famous Old Town Square in the heart of Prague, 
							providing luxurious rooms including marble bathrooms ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=5">more</a></p>
						<p class="address">Celetna 7 / 600, Entrance Stupartska 2, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/GoldenWell.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=6">Golden Well</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">This Renaissance style building belonged to the Emperor Rudolf II (1552-1612) and once served as the residence 
							of the legendary Astronomer Tycho de Brahe (1546-1601) ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=6">more</a></p>
						<p class="address">U Zlate Studne 166/4, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Santini.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=7">Santini Residence</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">A unique piece of luxury consisting of 9 spacious suites is situated in famous Nerudova Street, in the historical 
							centre, in the quarter known for its unparalleled magic ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=7">more</a></p>
						<p class="address">Nerudova 211/14, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Hilton.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=8">Hilton Prague Old Town</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Located within walking distance of Prague attractions and only 30 minutes from the airport, the refurbished 
							Hilton Prague Old Town hotel sits at the gates of the Old Town ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=8">more</a></p>
						<p class="address">V Celnici 7, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Metamorphis.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=9">Hotel Metamorphis</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">This hotel is situated in one of the oldest parts of Prague, on the site of the former Ungelt court in the 
							very heart of the city. The place is listed as a UNESCO world heritage ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=9">more</a></p>
						<p class="address">Mala Stupartska 5/636, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/UPrince.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=10">U Prince</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_5.png" /></h3>
						<p class="description">Situated right on Old Town Square opposite the Astronomical Clock, the uniquely styled hotel U Prince is 
							housed in a completely renovated 12th-century building ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=10">more</a></p>
						<p class="address">Staromestske Namesti 29, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Floor.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=11">Floor Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">This is a boutique hotel in the centre of Prague 1, very close to the major historical sights. Reach the 
							Old Town and the Charles Bridge in a short walk! ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=11">more</a></p>
						<p class="address">Na prikope 13, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Jezulatko.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=12">Hotel U Jezulatka</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">This non-smoking hotel is conveniently located near a church in a beautifully renovated Baroque building on 
							Kampa Island on Vltava River, in the heart of historic Prague ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=12">more</a></p>
						<p class="address">Na Kampe 10, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Icon.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=13">The Icon Boutique Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">Welcome to the most personal boutique hotel in Prague and in the middle of the city centre ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=13">more</a></p>
						<p class="address">V Jámě 6, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Archibald.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=15">Archibald at the Charles Bridge</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">A few steps from the famous Charles Bridge, this hotel is situated in Kampa, the historic part of the Mala Strana ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=15">more</a></p>
						<p class="address">Na Kampe 15, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Lundborg.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=16">Rezidence Lundborg</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">Right in the historical and culture heart of Prague, only a few steps from the Charles Bridge you will find a 
							700 years old house as a luxury hotel with all kind of suites and apartments ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=16">more</a></p>
						<p class="address">U Luzickeho Seminare 3, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Savic.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=17">Savic Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_4.png" /></h3>
						<p class="description">This hotel, set in a Gothic and Renaissance building which has retained parts of its original from 1319, 
							is offering special opening discounts ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=17">more</a></p>
						<p class="address">Jilska 7, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Cloister.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=18">Cloister Inn Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_3.png" /></h3>
						<p class="description">Located in the oldest part of the historical city centre, just steps from the monumental Charles Bridge, in the 
							vicinity of the picturesque Old Town Square, in a cobblestoned lane free of traffic ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=18">more</a></p>
						<p class="address">Konviktska 14, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Medvidek.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=19">U Medvidku-Brewery Hotel</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_3.png" /></h3>
						<p class="description">The brewery hotel is exceptional thanks to its preserved Gothic rafters and painted ceilings in renaissance style ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=19">more</a></p>
						<p class="address">Na Perstyne 7, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Salvator.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=20">Hotel Salvator</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_3.png" /></h3>
						<p class="description">In the historic centre of beautiful Prague, all that the city has to offer is just a short walk from the hotel ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=20">more</a></p>
						<p class="address">Truhlarska 10, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/OldTown.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=21">Old Town Apartments</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_3.png" /></h3>
						<p class="description">Old Town Apartments offers spacious and appealingly furnished accommodation at reasonable prices in the 
							centre of Prague. Enjoy the freedom of apartment living together with all hotel amenities ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=21">more</a></p>
						<p class="address">Zubateho 11, Prague</p>
					</tr>
				</tr>
				<tr>
					<td>
						<div class="image"><img src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/hotely/Pav.jpg" /></div>
						<h3><a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=22">Hotel Pav</a><img class="stars" src="<?php bloginfo('siteurl'); ?>/wp-content/themes/default/images/stars_3.png" /></h3>
						<p class="description">The Hotel Páv dates back to the year 1806, when it was called “U tri kosu” - “The house of the three 
							Blackbirds” according to the sign above the main entry ... <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=hotel&hotel=22">more</a></p>
						<p class="address">Křemencova 13, Prague</p>
					</tr>
				</tr>
			</table>
			<div class="links">
				<div>&raquo; <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=searchprague">Search all 319 available hotels in Prague</a></div>
				<div>&raquo; <a href="<?php bloginfo('siteurl'); ?>/index.php/hotels/?action=searchall">Search all available hotels in the Czech Republic</a></div>
			</div>
		</div>
	<?php } else if($action == 'hotel') { 
		$src = $hotels[intval($_GET['hotel'])];
		?>
		<div id="hotel">
			<div class="links">
				<a href="javascript:self.history.back();">&laquo; back</a>
			</div>
			<iframe src="<?php echo $src; ?>" id="hotelform" height="500" scrolling="auto" width="683" marginwidth="0" frameborder="0"></iframe>
		</div>
	<?php } else { ?>
		<div id="search">
			<div class="links">
				<a href="javascript:self.history.back();">&laquo; back</a>
			</div>
			<div id="hotel">
				<iframe marginwidth="0" frameborder="0" src="<?php if($action == 'searchprague') { ?>http://www.booking.com/city/cz/prague.html?aid=317616;sid=48091294cde7c059550f0e821abb1ef4<?php } else { ?>http://www.booking.com/country/cz.html?aid=317616;sid=48091294cde7c059550f0e821abb1ef4<?php } ?>" id="hotelform" height="500" scrolling="auto" width="683"></iframe>
			</div>
		</div>
	<?php } ?>
	
</div>

<?php get_footer(); ?>