<?php 
/*
Template Name: Tour Search
*/

get_header(); ?>

<script type="text/javascript">
function submitsearch()
{
	document.getElementById('toursearchform').submit();
}
</script>

<div id="searchtour">
	<h1 id="generictitle">Customized Tour Database</h1>
	
	<div id="searchtop"></div>
	<div id="search">
		<p style="margin-top:0">Choose the tour of your dreams just by selecting desired criteria, be it history, architecture, medieval castles, crystal glassworks, etc. It has never been so easy to find a tour matching your needs. You can mark one or more categories at a time.</p>
		<form id="toursearchform" method="post" action="<?php bloginfo('siteurl'); ?>/tours/?search=1&actpage=1">
		<table>
			<tr>
				<td valign="top">
					<div class="choices">
						<h4>Location</h4>
						<input type="checkbox" name="location[]" value="1" />In Prague<br />
						<input type="checkbox" name="location[]" value="2" />Out of Prague<br />
						<input type="checkbox" name="location[]" value="3" />Abroad (Central Europe)<br />
					</div>

					<div class="choices">
						<h4>Walking Ability</h4>
						<input type="radio" name="walking" value="1" />High<br />
						<input type="radio" name="walking" value="2" />Medium<br />
						<input type="radio" name="walking" value="3" />Low<br />
						<input type="radio" name="walking" value="4" />Wheelchair User<br />
					</div>

					<div class="choices">
						<h4>Means of Transportation</h4>
						<input type="checkbox" name="transportation[]" value="1" />Walking<up>*</up><br />
						<input type="checkbox" name="transportation[]" value="2" />Driving (car/van/bus)<br />
						<input type="checkbox" name="transportation[]" value="3" />Driving - Limo, Mercedes<br />
						<input type="checkbox" name="transportation[]" value="7" />Public Transportation<br />
						<input type="checkbox" name="transportation[]" value="5" />Horse-Drawn Carriage<br />
						<input type="checkbox" name="transportation[]" value="4" />Vintage Car<br />
						<input type="checkbox" name="transportation[]" value="8" />Sailing<br />
						<input type="checkbox" name="transportation[]" value="9" />By Train<br />
						<input type="checkbox" name="transportation[]" value="10" />Flying (hot air baloon, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;helicopter)<br />
					</div>
				</td>
				<td valign="top">
					<div class="choices">
						<h4>Thematic Tours (A-Z)</h4>
						<input type="checkbox" name="theme[]" value="3">Antiques<br />
						<input type="checkbox" name="theme[]" value="4">Archeological Sites<br />
						<input type="checkbox" name="theme[]" value="5">Architecture<br />
						<input type="checkbox" name="theme[]" value="25">Art<br />
						<input type="checkbox" name="theme[]" value="6">Catacombs & City's &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Underground<br />
						<input type="checkbox" name="theme[]" value="8">Crystal Glassworks<br />
						<input type="checkbox" name="theme[]" value="9">Czech Souvenirs<br />
						<input type="checkbox" name="theme[]" value="10">Ecclesiastical Monuments<br />
						<input type="checkbox" name="theme[]" value="7">Folk Architecture<br />
						<input type="checkbox" name="theme[]" value="11">Folk Handicrafts<br />
						<input type="checkbox" name="theme[]" value="26">History<br />
						<input type="checkbox" name="theme[]" value="27">Jewish Heritage<br />
						<input type="checkbox" name="theme[]" value="12">Medieval Castles & Châteaux<br />
						<input type="checkbox" name="theme[]" value="13">Museums & Galleries<br />
						<input type="checkbox" name="theme[]" value="14">Musicians & Famous People<br />
						<input type="checkbox" name="theme[]" value="15">Parks & Nature Reserves<br />
						<input type="checkbox" name="theme[]" value="16">Photography<br />
						<input type="checkbox" name="theme[]" value="17">Spa Towns<br />
						<input type="checkbox" name="theme[]" value="18">Unesco Monuments<br />
					</div>
					
					<div class="choices">
						<h4>Miscellaneous</h4>
						<input type="checkbox" name="assistant" value="1" />Local Area Assistant<br />
						<input type="checkbox" name="companion" value="1" />Companion for Tour/Dining<br />
						<input type="checkbox" name="honeymoon" value="1" />Honeymoon<br />
					</div>
				</td>
				<td valign="top">
					<div class="choices">
						<h4>Introductory Tours</h4>
						<input type="checkbox" name="theme[]" value="1" />Daytime Tours<br />
						<input type="checkbox" name="theme[]" value="2" />Nighttime Tours<br />
					</div>

					<div class="choices">
						<h4>Gastronomy Tours</h4>
						<input type="checkbox" name="theme[]" value="19">Beer Tours & Breweries<br />
						<input type="checkbox" name="theme[]" value="20">Folklore Dinner<br />
						<input type="checkbox" name="theme[]" value="21">Wine Tasting<br />
					</div>

					<div class="choices">
						<h4>Sports & Relaxation</h4>
						<input type="checkbox" name="theme[]" value="22">Hiking Tours<br />
						<input type="checkbox" name="theme[]" value="23">Relaxation<br />
						<input type="checkbox" name="theme[]" value="24">Sports & Adrenaline<br />
					</div>

					<div class="choices">
						<h4>Direction of Tour from Prague</h4>
						<input type="checkbox" name="direction[]" value="2">North: Germany - Dresden<br />
						<input type="checkbox" name="direction[]" value="3">NE: Poland - Warsaw<br />
						<input type="checkbox" name="direction[]" value="5">East: Poland - Cracow<br />
						<input type="checkbox" name="direction[]" value="8">SE: Austria - Vienna<br />
						<input type="checkbox" name="direction[]" value="7">South: Austria - Salzburg<br />
						<input type="checkbox" name="direction[]" value="6">SW: Germany - Munich<br />
						<input type="checkbox" name="direction[]" value="4">West: Germany - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuremberg<br />
						<input type="checkbox" name="direction[]" value="1">NW: Germany - Cologne<br />
					</div>
				</td>
			<tr>
		</table>
		</form>
		<a class="button" href="javascript:submitsearch();">SEARCH</a>
		<div id="note">
			 * In Prague, I highly recommend choosing our unique walking tours (rather than driving tours), for Prague’s historical center is very compact.
		</div>
	</div>
	<div id="searchbottom"></div>
	
	<div id="links">
		Related Pages: <a href="<?php bloginfo('siteurl'); ?>/general-tour-info/">General Tour Info</a> | 
        <a href="<?php bloginfo('siteurl'); ?>/our-private-guides/">Private Guides</a> |
        <a href="<?php bloginfo('siteurl'); ?>/price-info/">Tour Prices</a> | 
        <a href="<?php bloginfo('siteurl'); ?>/basket/">Your Basket</a> |
        <a href="<?php bloginfo('siteurl'); ?>/basket/?order=1">Order Form</a>
	</div>

</div>

<?php get_footer(); ?>