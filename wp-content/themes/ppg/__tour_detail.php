<?php
/*
Template Name: Tour Detail
*/

$tourtransportations = array(
	1 => array("id" => 1, "title" => "Walking"),
	array("id" => 2, "title" => "Driving - Car, Van, Minibus, Bus"),
	array("id" => 3, "title" => "Driving - Limo"),
	array("id" => 4, "title" => "Driving - Antique Car"),
	array("id" => 5, "title" => "Driving - Horse Carriage"),
	array("id" => 6, "title" => "Walking/Driving"),
	array("id" => 7, "title" => "Walking / Public Transportation (upon request)"),
	array("id" => 8, "title" => "Sailing"),
	array("id" => 9, "title" => "Railing"),
	array("id" => 10, "title" => "Flying")
);
$tourwalkingabilities = array(
	1 => array("id" => 1, "title" => "High"),
	array("id" => 2, "title" => "Medium"),
	array("id" => 3, "title" => "Low"),
	array("id" => 4, "title" => "Part-Time Wheelchair User"),
	array("id" => 5, "title" => "Full-Time  Wheelchair User")
);

$parts = explode('/', $_SERVER["REQUEST_URI"]);
$tourid = $parts[count($parts) - 1];
if(empty($tourid))
	$tourid = $parts[count($parts) - 2];
if(!is_numeric($tourid))
	$tourid = $parts[count($parts) - 3];
$tourid = intval($tourid);

$tour = $wpdb->get_row("SELECT * FROM tours_tours WHERE id=$tourid");
$sights = $wpdb->get_results("SELECT name FROM tours_tour_place TTP LEFT JOIN tours_places TP ON TP.id=TTP.placeid WHERE tourid=$tourid ORDER BY placeorder");
$sgs = array(); foreach($sights as $sight) $sgs[] = $sight->name; $sights = implode(', ', $sgs);
$interiors = $wpdb->get_results("SELECT name FROM tours_tour_interior TTI LEFT JOIN tours_interiors TI ON TI.id=TTI.interiorid WHERE tourid=$tourid ORDER BY displayorder");
$ints = array(); foreach($interiors as $interior) $ints[] = $interior->name; $interiors = implode(', ', $ints);
if(empty($interiors)) {
	if($tour->interiors == 3) {
		$interiors = 'Upon Request';
	} else {
		$interiors = 'None';
	}
}
if($tour->availability == 1) $availability = "All year round"; else { $availability = $tour->availability1.(empty($tour->availability2) ? '' : ", $tour->availability2").(empty($tour->availability3) ? '' : ", $tour->availability3"); }
switch($tour->destination) {
	case 1: $destination = "In Prague"; break;
	case 2: 
	case 3: $destination = $tour->distancefromprague." km / {$tour->transpduration} hour drive ".p_destination($tour->direction); break;
}
$transportations = explode(',', $tour->transportation);
$transps = array();
foreach($transportations as $transp)
	$transps[] = $tourtransportations[$transp]['title'];
$transportations = implode(' and/or ', $transps);

$walkingabilities = explode(',', $tour->walkingability);
$ablts = array();
foreach($walkingabilities as $ability)
	$ablts[] = $tourwalkingabilities[$ability]['title'];
$abilities = implode(' and/or ', $ablts);

if(empty($tour->pickup))
	$tour->pickup = 'Your guide will pick you up at agreed place and time; most likely at the reception of your hotel.';

$custom_title = $tour->title;
get_header(); ?>
<script type="text/javascript">
function addtobasket()
{
	document.getElementById('actionvalue').value = 'addtobasket';
	document.getElementById('order').submit();
}
function booknow()
{
	document.getElementById('actionvalue').value = 'booknow';
	document.getElementById('order').submit();
}
function showDiscounts()
{
	Modalbox.show('<?php bloginfo('siteurl') ?>/discount-program', {title: 'Our discount program'});
}
function hideDiscounts()
{
	document.getElementById('discounts').style.display = 'none';
	new Effect.Appear('dlgoverlay', { duration: 0.2, from: 0.6, to: 0.0 });
	setTimeout("document.getElementById('dlgoverlay').style.height = 0;", 200);
}
</script>
<div id="tourdetails">
	<?php the_post() ?>
	<h2 id="generictitle"><?php the_title() ?></h2>
	
	<h1><?php echo $tour->title; ?></h1>

	<table cellspacing="0">
		<tr><td class="title">Tour Description</td><td><?php echo nl2br($tour->description); ?></td></tr>
		<tr><td class="title">Sights to See</td><td><?php echo $sights; ?></td></tr>
		<tr><td class="title">Interiors</td><td><?php echo $interiors; ?></td></tr>
		<tr><td class="title">Availability From-To</td><td><?php echo $availability; ?></td></tr>
		<tr><td class="title">Duration</td><td><?php echo $tour->duration; ?> hours</td></tr>
		<tr><td class="title">Location</td><td><?php echo $destination; ?></td></tr>
		<tr><td class="title">Means of Transportation</td><td><?php echo $transportations; ?></td></tr>
		<tr><td class="title">Required Walking Ability</td><td><?php echo $abilities; ?></td></tr>
		<tr><td class="title">Pick Up Time & Place</td><td><?php echo $tour->pickup; ?></td></tr>
		<tr><td class="title">Additional Info</td><td><?php echo $tour->info; ?></td></tr>
	</table>
	<div id="photos">
		<?php if(!empty($tour->image1)) echo '<a rel="lightbox" href="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image1.'-f.jpg"><img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image1.'-t.jpg" /></a>'; ?>
		<?php if(!empty($tour->image2)) echo '<a rel="lightbox" href="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image2.'-f.jpg"><img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image2.'-t.jpg" /></a>'; ?>
		<?php if(!empty($tour->image3)) echo '<a rel="lightbox" href="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image3.'-f.jpg"><img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour->image3.'-t.jpg" /></a>'; ?>
	</div>
	<table cellspacing="0">
		<tr>
			<td class="title">Price Info</td>
			<td class="thead"><span class="title"><?php echo $tour->sloupec1; ?></span><span><?php echo $tour->lidi1; ?></span></td>
			<td class="thead"><span class="title"><?php echo $tour->sloupec2; ?></span><span><?php echo $tour->lidi2; ?></span></td>
			<td class="thead"><span class="title"><?php echo $tour->sloupec3; ?></span><span><?php echo $tour->lidi3; ?><up>**</up></span></td>
			<td class="thead"><span class="title">Entrance Fees<up>***</up></span>(per person)</td>
		</tr>
		<tr>
			<td class="title">CZK / EUR / USD<up>*</up></td>
			<td class="price"><?php echo $tour->cena11.'&nbsp;/&nbsp;'.$tour->cena12.'&nbsp;/&nbsp;'.$tour->cena13; ?></td>
			<td class="price"><?php echo $tour->cena21.'&nbsp;/&nbsp;'.$tour->cena22.'&nbsp;/&nbsp;'.$tour->cena23; ?></td>
			<td class="price"><?php echo $tour->cena31.'&nbsp;/&nbsp;'.$tour->cena32.'&nbsp;/&nbsp;'.$tour->cena33; ?></td>
			<td class="price" rowspan="2" class="fees"><?php echo $tour->entrancefees.'&nbsp;/&nbsp;'.$tour->entrancefees1.'&nbsp;/&nbsp;'.$tour->entrancefees2; ?></td>
		</tr>
		<tr>
			<td class="title">Every Additional Hour<br /><span class="normal">CZK / EUR / USD<up>*</up><span></td>
			<td class="fees price"><?php echo $tour->hodina11.'&nbsp;/&nbsp;'.$tour->hodina12.'&nbsp;/&nbsp;'.$tour->hodina13; ?></td>
			<td class="fees price"><?php echo $tour->hodina21.'&nbsp;/&nbsp;'.$tour->hodina22.'&nbsp;/&nbsp;'.$tour->hodina23; ?></td>
			<td class="fees price"><?php echo $tour->hodina31.'&nbsp;/&nbsp;'.$tour->hodina32.'&nbsp;/&nbsp;'.$tour->hodina33; ?></td>
		</tr>
		<tr>
			<td class="title">Discount</td>
			<td colspan="4"><a href="javascript:showDiscounts();">See our Discount Program &raquo;</a></td>
		</tr>
		<tr>
			<td class="title">Payment Details</td>
			<td colspan="4">Payment is possible only in cash: CZK, EUR or USD.<br />Payment shall be made to your guide before the tour, if not agreed otherwise.</td>
		</tr>
		<tr>
			<td colspan="5" id="notes">
				<span class="note">*</span>Prices in EUR and USD are to be calculated according to current rates.<br />
				<span class="note">**</span>We can arrange a tour including transportation for a group of any size; <a href="<?php bloginfo('siteurl'); ?>/contacts/">contact us for details</a>.<br />
				<span class="note">***</span>Entrance fees are not included in the price and may slightly vary (subject to change).<br />
			</td>
		</tr>
		<?php if(!empty($tour->inprice)) { ?>
			<tr><td class="title">Comments</td><td colspan="4"><?php echo $tour->inprice; ?></td></tr>
		<?php } ?>
		<?php if(!empty($tour->tourreferences)) { ?>
			<tr><td class="title">References</td><td colspan="4"><?php echo $tour->tourreferences; ?></td></tr>
		<?php } ?>
	</table>
	
	<div id="orderbuttons">
		<form id="order" method="post" action="<?php bloginfo('siteurl'); ?>/order/">
			<input type="hidden" name="tourid" value="<?php echo $tourid; ?>" />
			<input type="hidden" id="actionvalue" name="action" value="addtobasket" />
			<a class="centered" href="javascript:void(0)" onClick="addtobasket()">ADD TO BASKET</a>
			<a href="javascript:void(0)" onClick="booknow()">BOOK THIS TOUR<br /><small>(NON-BINDING)</small></a>
		</form>
	</div>
	
	<div id="backlink">
		<a href="javascript:self.history.back();">&laquo; Back To Tour List</a>
	</div>
</div>


<?php get_footer(); ?>