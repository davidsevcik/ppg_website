<?php
/*
Plugin Name: Tours
Plugin URI: 
Description: Správa tours
Author: Jaroslav Cmunt (jcmunt@gmail.com)
Version: 1.0
Author URI: 
*/
//error_reporting(E_ERROR);
function obsluha_chyb($errno, $errmsg, $filename, $linenum, $vars) {
  if (error_reporting()) {
    echo $filename.' :: '.$linenum.' :: '.$errmsg."<br />\n";
  }
}
//set_error_handler("obsluha_chyb");

if($_GET['page'] == 'tours.php') {
	$editing = true;
	wp_enqueue_script('prototype');
	wp_enqueue_script('interface');
	//wp_enqueue_script('quicktags');
	wp_enqueue_script('utils');
	//wp_enqueue_script('editor');
	//wp_enqueue_script('wp-ajax');
	wp_enqueue_script('sack');
	if($_GET['section'] == 'placesorder' || $_GET['section'] == 'interiorsorder' || $_GET['section'] == 'popularorder')
		wp_enqueue_script('scriptaculous');
}


$url = get_option('siteurl').$_SERVER['REQUEST_URI'];
$ajaxurl = get_option('siteurl').'/wp-content/plugins/tours-ajax.php';

$tourtypesintro = array(
	1 => array("id" => 1, "title" => "Daytime Tours"),
	array("id" => 2, "title" => "Nighttime Tours")
);

$tourtypesthema = array(
	1 => array("id" => 3, "title" => "Antiques"),
	array("id" => 4, "title" => "Archeological Sites"),
	array("id" => 5, "title" => "Architecture"),
	array("id" => 25, "title" => "Art"),
	array("id" => 6, "title" => "Catacombs & City´s Underground"),
	array("id" => 8, "title" => "Crystal Glassworks"),
	array("id" => 9, "title" => "Czech Souvenirs"),
	array("id" => 10, "title" => "Ecclesiastical Monuments"),
	array("id" => 7, "title" => "Folk Architecture"),
	array("id" => 11, "title" => "Folk Handicrafts"),
	array("id" => 26, "title" => "History"),
	array("id" => 27, "title" => "Jewish Heritage"),
	array("id" => 12, "title" => "Medieval Castles & Châteaux"),
	array("id" => 13, "title" => "Museums & Galleries"),
	array("id" => 14, "title" => "Musicians & Famous People"),
	array("id" => 15, "title" => "Parks & Nature Reserves"),
	array("id" => 16, "title" => "Photography"),
	array("id" => 17, "title" => "Spa Towns"),
	array("id" => 18, "title" => "Unesco Monuments")
);

$tourtypesgastro = array(
	1 => array("id" => 19, "title" => "Beer Tours & Breweries"),
	array("id" => 20, "title" => "Folklore Dinner"),
	array("id" => 21, "title" => "Wine Tasting")
);

$tourtypessports = array(
	1 => array("id" => 22, "title" => "Hiking Tours"),
	array("id" => 23, "title" => "Relaxation"),
	array("id" => 24, "title" => "Sports & Adrenalin")
);

$tourtypes = array(
	1 => array("id" => 1, "title" => "Introductory Sightseeing Tour"),
	array("id" => 2, "title" => "Thematic Sightseeing Tour"),
	array("id" => 3, "title" => "Architecture"),
	array("id" => 4, "title" => "Medieval Castles"),
	array("id" => 5, "title" => "Museums/Galleries"),
	array("id" => 6, "title" => "Prague Parks"),
	array("id" => 7, "title" => "Souvenir Shopping"),
	array("id" => 8, "title" => "Glassworks"),
	array("id" => 9, "title" => "Brewery"),
	array("id" => 10, "title" => "Vintage"),
	array("id" => 11, "title" => "Spa"),
	array("id" => 12, "title" => "Horse Carriage"),
	array("id" => 13, "title" => "Antique Car"),
	array("id" => 14, "title" => "Antiques"),
	array("id" => 15, "title" => "Photography"),
	array("id" => 16, "title" => "Musitians, Writers, Famous Persons"),
	array("id" => 17, "title" => "River Cruise"),
	array("id" => 18, "title" => "Folclore"),
	array("id" => 19, "title" => "Unesco Monuments"),
	array("id" => 20, "title" => "Hiking"),
	array("id" => 21, "title" => "Sports & Adrenalin")
);

$tourdestinations = array(
	1 => array("id" => 1, "title" => "In Prague"),
	array("id" => 2, "title" => "Out of Prague (Czech Republic)"),
	array("id" => 3, "title" => "Abroad (Central Europe)")
);

$tourlevels = array(
	1 => array("id" => 1, "title" => "Ano")
);

$tourtransportations = array(
	1 => array("id" => 1, "title" => "Walking"),
	array("id" => 2, "title" => "Driving - Car, Van, Minibus, Bus"),
	array("id" => 3, "title" => "Driving - Limo"),
	array("id" => 4, "title" => "Driving - Antique Car"),
	array("id" => 5, "title" => "Driving - Horse Carriage"),
	array("id" => 7, "title" => "Walking / Public Transportation (upon request)"),
	array("id" => 8, "title" => "Sailing"),
	array("id" => 9, "title" => "Railing"),
	array("id" => 10, "title" => "Flying")
);

$tourwalkingabilities = array(
	1 => array("id" => 1, "title" => "High"),
	array("id" => 2, "title" => "Medium"),
	array("id" => 3, "title" => "Low"),
	array("id" => 4, "title" => "Wheelchair User")
	/*array("id" => 5, "title" => "Full-Time  Wheelchair User")*/
);

$touravailabilities = array(
	1 => array("id" => 1, "title" => "All Year Round"),
	array("id" => 2, "title" => "Restricted")
);

$tourinteriors = array(
	1 => array("id" => 1, "title" => "Yes"),
	array("id" => 2, "title" => "No"),
	array("id" => 3, "title" => "Upon Request")
);

$tourdaytimes = array(
	1 => array("id" => 1, "title" => "Day"),
	array("id" => 2, "title" => "Night"),
	array("id" => 3, "title" => "Sunset"),
	array("id" => 4, "title" => "Sunrise")
);

$tourregions = array(
	1 => array("id" => 1, "title" => "The Capital Prague"),
	array("id" => 2, "title" => "Central Bohemia Region"),
	array("id" => 3, "title" => "South Bohemian Region"),
	array("id" => 4, "title" => "Plzeň Region"),
	array("id" => 5, "title" => "Karlovy Vary Region"),
	array("id" => 6, "title" => "Ústí Region"),
	array("id" => 7, "title" => "Liberec Region"),
	array("id" => 8, "title" => "Hradec Králové Region"),
	array("id" => 9, "title" => "Pardubice Region"),
	array("id" => 10, "title" => "Vysočina Region"),
	array("id" => 11, "title" => "Southern Moravian Region"),
	array("id" => 12, "title" => "Olomouc Region"),
	array("id" => 13, "title" => "Zlín Region"),
	array("id" => 14, "title" => "Moravian-Silesian Region")
);

function print_options($name, $values, $selected, $action = '')
{ 
	$act = empty($action) ? '' : 'onChange="'.$action.'"';
	echo '<select name="'.$name.'" '.$act.'>';
	foreach($values as $value) {
		$sel = $selected == $value['id'] ? 'selected="selected"' : '';
		echo '<option value="'.$value['id'].'" '.$sel.'>'.$value['title'].'</option>';
	}
	echo '</select>';
}

function print_multiselect_options($name, $values, $selected, $cols, $action = '')
{
	$act = empty($action) ? '' : 'onChange="'.$action.'"';

	echo '<table>';
	$col = 1;
	foreach($values as $value) {
		if($col == 1)
			echo '<tr>';

		$sel = in_array($value['id'], $selected) ? 'checked="checked"' : '';
			
		echo '<td>';
		echo '<input type="checkbox" name="'.$name.'" value="'.$value['id'].'" '.$sel.'>&nbsp;'.$value['title'];
		echo '</td>';
			
		if($col == $cols) {
			echo '</tr>';
			$col = 0;
		}
		$col++;
	}
	if(!empty($values) && $col != 1)
		echo '</tr>';
	echo '</table>';
}

function listTours()
{
	global $wpdb, $url, $tourtypes;
	
	echo '<div class="wrap" style="text-align:left">';
	echo '<h2>Správa tours</h2>';

	if($_GET['action'] == "save") {
		echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("<strong>Uloženo</strong>.") . "</p></div>";
	}
	if($_GET['action'] == "delete") {
		echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("<strong>Smazáno</strong>.") . "</p></div>";
	}
	if($_POST['action'] == "saveconfig") {
		echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("<strong>Uloženo</strong>.") . "</p></div>";
		update_option("toursperpage", $_POST["toursperpage"]);
		update_option("toursemail", $_POST["toursemail"]);
	}
	
	$toursperpage = get_option("toursperpage");
	$toursemail = get_option('toursemail');
	echo '<form method="post" name="config">';
	echo '<label>Počet túr na stránku v databázi:&nbsp;</label>';
	echo '<input type="text" name="toursperpage" value="'.$toursperpage.'" size="5" /><br />';
	echo '<label>Email pro objednávky:&nbsp;</label>';
	echo '<input type="text" name="toursemail" value="'.$toursemail.'" size="30" />';
	echo '<input type="hidden" name="action" value="saveconfig"><br />';
	echo '<input type="submit" value="Uložit">';
	echo '</form><br />';

?>
	<a href="options-general.php?page=tours.php&section=popularorder">Pořadí popular tours</a><br /><br />
	<script type="text/javascript">
	function deleteTour(id)
	{
		if(confirm('Opravdu smazat?'))
			window.location = 'options-general.php?page=tours.php&section=delete&id=' + id;
	}
	</script>
	<a href="options-general.php?page=tours.php&section=edit">Přidat novou tour</a><br /><br />
	<table class="widefat">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Duration</th>
                <th>Hotovo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="the-list">
		<?php
            $count = 0;
			$tours = $wpdb->get_results("SELECT * FROM tours_tours ORDER BY aktivni, title", ARRAY_A);
			foreach($tours as $tour) {
				?>
				<? echo ($count++ % 2 == 0) ? '<tr class="alternate">' : '<tr>' ?>
					<td><?php echo $tour["title"]?></td>
					<td><?php echo $tourtypes[$tour['type']]['title']; ?></td>
					<td><?php echo $tour['duration_min'] ? $tour['duration_min'].' min' : $tour['duration'].' h'; ?></td>
					<td><?php if($tour['aktivni'] == 1) echo "Ano"; else echo "Ne"; ?></td>
					<td>
						<a href="options-general.php?page=tours.php&section=edit&tourid=<?php echo $tour['id']; ?>">edit</a>&nbsp;&nbsp;
						<a href="javascript:void(0);" onClick="deleteTour(<?php echo $tour['id']; ?>)">delete</a>&nbsp;&nbsp;
						<a href="/index.php/tour/<?php echo $tour['id']; ?>/">náhled</a>
					</td>
				</tr>
				<?php
			}
		?>
        </tbody>
	</table>
	</div>
<?php
}

function editTour()
{
	global $wpdb, $url, $editing, $ajaxurl, $tourdestinations, $tourtransportations, $tourwalkingabilities,
		$touravailabilities, $tourinteriors, $tourtypeofgroups, $tourdaytimes, $tourlevels,
		$tourtypesintro, $tourtypesthema, $tourtypesgastro, $tourtypessports, $tourregions;
		
	$categories = $wpdb->get_results("SELECT * FROM tours_categories", ARRAY_A);
	
	$tourid = intval($_REQUEST['tourid']);
	if($tourid != 0) {
		$tour = $wpdb->get_row("SELECT * FROM tours_tours WHERE id=$tourid", ARRAY_A);
		if(!$tour) {
			echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("<strong>Tato tour neexistuje</strong>.") . "</p></div>";
			return;
		}
		if(empty($tour['pickup']))
			$tour['pickup'] = 'Your guide will pick you up at agreed place and time; most likely at the reception of your hotel.';
	} else {
		$tour['id'] = 0;
		$tour['aktivni'] = 0;
		$tour['title'] = '';
		$tour['category'] = 1;
		$tour['description'] = '';
		$tour['type'] = 1;
		$tour['region'] = 1;
		$tour['duration'] = '';
		$tour['duration_min'] = '';
		$tour['destination'] = 1;
		$tour['distancefromprague'] = '';
		$tour['transportation'] = 1;
		$tour['walkingability'] = 3;
		$tour['availability'] = 1;
		$tour['interiors'] = 1;
		$tour['typeofgroup'] = 1;
		$tour['daytime'] = 1;
		$tour['references'] = '';
		$tour['notes'] = '';
		$tour['links'] = '';
		$tour['sloupec1'] = 'Guide';
		$tour['sloupec2'] = 'Guide + Car&Driver';
		$tour['sloupec3'] = 'Guide + Van&Driver';
		$tour['lidi1'] = '1-6 People';
		$tour['lidi2'] = '1-2 People';
		$tour['lidi3'] = '3-6 People';
		$tour['info'] = ''; //"It is your tour so don’t hesitate to stop wherever or whenever you want. During the tour your personal guide will give you invaluable information about cultural life, dining venues, safe money exchange, tips for remaining days of your stay, etc.";
		$tour['pickup'] = 'Your guide will pick you up at agreed place and time; most likely at the reception of your hotel.';
		$tour['companion'] = 0;
		$tour['assistant'] = 0;
		$tour['honeymoon'] = 0;
	}
	
	echo '<div class="wrap" style="text-align:left">';
	
	if($tourid == 0)
		echo '<h2>Nová tour</h2>';
	else
		echo '<h2>Edituj tour</h2>';
	?>
	<script type="text/javascript">
	function newPlace()
	{
		var placename = document.forms['edittour'].newplace.value;
		
		if(document.forms['edittour'].op.value == 0) {
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=newplace&name=' + placename, {
				method: 'get',
				onSuccess: function(answer) {
					var id = answer.responseText.evalJSON();
					$('allplacesselect').options[$('allplacesselect').options.length] = new Option(placename, id.id);
				}});
		} else {
			var length = $('allplacesselect').options.length;
			var placeid = '';
			for(i = 0; i < length; i++)
				if($('allplacesselect').options[i].selected)
					placeid = $('allplacesselect').options[i].value;
			
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=editplace&placeid=' + placeid + '&name=' + placename, {
				method: 'get',
				onSuccess: function(answer) {
					for(i = 0; i < length; i++)
						if($('allplacesselect').options[i].selected)
							$('allplacesselect').options[i].text = placename;
				}});
		}
		document.forms['edittour'].op.value = 0;
		document.forms['edittour'].newplace.value = '';
		document.forms['edittour'].addplace.value = "Přidej";
	}
	function editPlace()
	{
		var length = $('allplacesselect').options.length;
		var text = '';
		for(i = 0; i < length; i++)
			if($('allplacesselect').options[i].selected)
				text = $('allplacesselect').options[i].text;
				
		document.forms['edittour'].newplace.value = text;
		document.forms['edittour'].addplace.value = 'Ulož';
		document.forms['edittour'].op.value = 1;
	}
	function deletePlace()
	{
		if(confirm("Opravdu smazat?")) {
			var length = $('allplacesselect').options.length;
			var placeid = '';
			for(i = 0; i < length; i++)
				if($('allplacesselect').options[i].selected)
					placeid = $('allplacesselect').options[i].value;
			
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=deleteplace&placeid=' + placeid, {
				method: 'get',
				onSuccess: function(answer) {
					for(i = 0; i < length; i++)
						if($('allplacesselect').options[i].selected)
							$('allplacesselect').options[i].remove();
				}});
		}
	}
	function selPlace(box)
	{
		var length = $('allplacesselect').options.length;
		var cnt = 0;
		for(i = 0; i < length; i++)
			if($('allplacesselect').options[i].selected)
				cnt++;

		if(cnt == 1) {
			document.forms['edittour'].editplace.disabled = false;
			document.forms['edittour'].editplace.style.color = "black";
			document.forms['edittour'].delplace.disabled = false;
			document.forms['edittour'].delplace.style.color = "black";
		} else {
			document.forms['edittour'].editplace.disabled = true;
			document.forms['edittour'].editplace.style.color = "gray";
			document.forms['edittour'].delplace.disabled = true;
			document.forms['edittour'].delplace.style.color = "gray";
		}
		document.forms['edittour'].newplace.value = '';
		document.forms['edittour'].addplace.value = 'Přidej';
	}
	function pridej()
	{
		var length = $('allplacesselect').options.length;
		for(i = length - 1; i >= 0; i--) {
			if($('allplacesselect').options[i].selected) {
				$('placesselect').options[$('placesselect').options.length] = new Option($('allplacesselect').options[i].text, $('allplacesselect').options[i].value);
				//$('allplacesselect').options[i].remove();
				$('allplacesselect').remove(i);
			}
		}
	}
	function odeber()
	{
		var length = $('placesselect').options.length;
		for(i = length - 1; i >= 0; i--) {
			if($('placesselect').options[i].selected) {
				$('allplacesselect').options[$('allplacesselect').options.length] = new Option($('placesselect').options[i].text, $('placesselect').options[i].value);
				//$('placesselect').options[i].remove();
				$('placesselect').remove(i);
			}
		}
	}
	function selectAll()
	{
		var length = $('placesselect').options.length;
		for(i = 0; i < length; i++)
			$('placesselect').options[i].selected = true;

		var length = $('interiorsselect').options.length;
		for(i = 0; i < length; i++)
			$('interiorsselect').options[i].selected = true;

		return true;
	}
	
	function sdates(box)
	{
		if(box.selectedIndex == 1)
			document.getElementById('dates').style.display = 'block';
		else
			document.getElementById('dates').style.display = 'none';
	}

	function dest(box)
	{
		if(box.options[box.selectedIndex].value == 1)
			document.getElementById('vzdalenost').style.display = 'none';
		else
			document.getElementById('vzdalenost').style.display = 'block';
	}

	function sinteriors(box)
	{
		if(box.selectedIndex != 1)
			document.getElementById('interiorsblock').style.display = 'block';
		else
			document.getElementById('interiorsblock').style.display = 'none';
	}
	function newInterior()
	{
		var placename = document.forms['edittour'].newinterior.value;
		var hours = document.forms['edittour'].openninghours.value;
		var fee = document.forms['edittour'].entrancefee.value;
		
		if(document.forms['edittour'].opint.value == 0) {
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=newinterior&name=' + placename + '&hours=' + hours + '&fee=' + fee, {
				method: 'get',
				onSuccess: function(answer) {
					var id = answer.responseText.evalJSON();
					$('allinteriorsselect').options[$('allinteriorsselect').options.length] = new Option(placename, id.id);
				}});
		} else {
			var length = $('allinteriorsselect').options.length;
			var intid = '';
			for(i = 0; i < length; i++)
				if($('allinteriorsselect').options[i].selected)
					intid = $('allinteriorsselect').options[i].value;
			
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=editinterior&intid=' + intid, {
				method: 'post',
				parameters: $('edittourform').serialize(),
				onSuccess: function(answer) {
					for(i = 0; i < length; i++)
						if($('allinteriorsselect').options[i].selected)
							$('allinteriorsselect').options[i].text = placename;
				}});
		}
		document.forms['edittour'].opint.value = 0;
		document.forms['edittour'].newinterior.value = '';
		document.forms['edittour'].openninghours.value = '';
		document.forms['edittour'].entrancefee.value = '';
		document.forms['edittour'].addinterior.value = "Přidej";
	}
	function editInterior()
	{
		var length = $('allinteriorsselect').options.length;
		var text = '';
		var intid = 0;
		for(i = 0; i < length; i++)
			if($('allinteriorsselect').options[i].selected) {
				text = $('allinteriorsselect').options[i].text;
				intid = $('allinteriorsselect').options[i].value;
			}
				
		document.forms['edittour'].newinterior.value = text;
		document.forms['edittour'].addinterior.value = 'Ulož';
		document.forms['edittour'].opint.value = 1;
		
		new Ajax.Request('<?php echo $ajaxurl; ?>?action=getinterior&id=' + intid + '&rand=' + Math.random(), {
			method: 'get',
			onSuccess: function(answer) { 
				var interior = answer.responseText.evalJSON(); 
				document.forms['edittour'].openninghours.value = interior.hours;
				document.forms['edittour'].entrancefee.value = interior.fees;
			}});
	}
	function deleteInterior()
	{
		if(confirm("Opravdu smazat?")) {
			var length = $('allinteriorsselect').options.length;
			var intid = '';
			for(i = 0; i < length; i++)
				if($('allinteriorsselect').options[i].selected)
					intid = $('allinteriorsselect').options[i].value;
			
			new Ajax.Request('<?php echo $ajaxurl; ?>?action=deleteinterior&intid=' + intid, {
				method: 'get',
				onSuccess: function(answer) {
					for(i = 0; i < length; i++)
						if($('allinteriorsselect').options[i].selected)
							$('allinteriorsselect').options[i].remove();
				}});
		}
	}
	function selInterior(box)
	{
		var length = $('allinteriorsselect').options.length;
		var cnt = 0;
		for(i = 0; i < length; i++)
			if($('allinteriorsselect').options[i].selected)
				cnt++;

		if(cnt == 1) {
			document.forms['edittour'].editinterior.disabled = false;
			document.forms['edittour'].editinterior.style.color = "black";
			document.forms['edittour'].delinterior.disabled = false;
			document.forms['edittour'].delinterior.style.color = "black";
		} else {
			document.forms['edittour'].editinterior.disabled = true;
			document.forms['edittour'].editinterior.style.color = "gray";
			document.forms['edittour'].delinterior.disabled = true;
			document.forms['edittour'].delinterior.style.color = "gray";
		}
		document.forms['edittour'].newinterior.value = '';
		document.forms['edittour'].openninghours.value = '';
		document.forms['edittour'].entrancefee.value = '';
		document.forms['edittour'].addinterior.value = 'Přidej';
	}
	function pridejInterior()
	{
		var length = $('allinteriorsselect').options.length;
		for(i = length - 1; i >= 0; i--) {
			if($('allinteriorsselect').options[i].selected) {
				$('interiorsselect').options[$('interiorsselect').options.length] = new Option($('allinteriorsselect').options[i].text, $('allinteriorsselect').options[i].value);
				$('allinteriorsselect').remove(i);
			}
		}
	}
	function odeberInterior()
	{
		var length = $('interiorsselect').options.length;
		for(i = length - 1; i >= 0; i--) {
			if($('interiorsselect').options[i].selected) {
				$('allinteriorsselect').options[$('allinteriorsselect').options.length] = new Option($('interiorsselect').options[i].text, $('interiorsselect').options[i].value);
				$('interiorsselect').remove(i);
			}
		}
	}
	
	function praha3hod()
	{
		document.forms['edittour'].cena11.value = "2100";
		document.forms['edittour'].cena12.value = "88";
		document.forms['edittour'].cena13.value = "140";
		document.forms['edittour'].cena21.value = "5500";
		document.forms['edittour'].cena22.value = "229";
		document.forms['edittour'].cena23.value = "367";
		document.forms['edittour'].cena31.value = "7000";
		document.forms['edittour'].cena32.value = "292";
		document.forms['edittour'].cena33.value = "467";

		document.forms['edittour'].hodina11.value = "700";
		document.forms['edittour'].hodina12.value = "30";
		document.forms['edittour'].hodina13.value = "50";
		document.forms['edittour'].hodina21.value = "1800";
		document.forms['edittour'].hodina22.value = "75";
		document.forms['edittour'].hodina23.value = "120";
		document.forms['edittour'].hodina31.value = "2500";
		document.forms['edittour'].hodina32.value = "104";
		document.forms['edittour'].hodina33.value = "167";

		document.forms['edittour'].entrancefees.value = "";
		document.forms['edittour'].entrancefees1.value = "";
		document.forms['edittour'].entrancefees2.value = "";
	}
	function praha4hod()
	{
		document.forms['edittour'].cena11.value = "2800";
		document.forms['edittour'].cena12.value = "116";
		document.forms['edittour'].cena13.value = "187";
		document.forms['edittour'].cena21.value = "6500";
		document.forms['edittour'].cena22.value = "271";
		document.forms['edittour'].cena23.value = "434";
		document.forms['edittour'].cena31.value = "8000";
		document.forms['edittour'].cena32.value = "334";
		document.forms['edittour'].cena33.value = "534";

		document.forms['edittour'].hodina11.value = "700";
		document.forms['edittour'].hodina12.value = "30";
		document.forms['edittour'].hodina13.value = "50";
		document.forms['edittour'].hodina21.value = "1800";
		document.forms['edittour'].hodina22.value = "75";
		document.forms['edittour'].hodina23.value = "120";
		document.forms['edittour'].hodina31.value = "2500";
		document.forms['edittour'].hodina32.value = "104";
		document.forms['edittour'].hodina33.value = "167";

		document.forms['edittour'].entrancefees.value = "";
		document.forms['edittour'].entrancefees1.value = "";
		document.forms['edittour'].entrancefees2.value = "";
	}
	function praha5hod()
	{
		document.forms['edittour'].cena11.value = "3500";
		document.forms['edittour'].cena12.value = "146";
		document.forms['edittour'].cena13.value = "234";
		document.forms['edittour'].cena21.value = "7500";
		document.forms['edittour'].cena22.value = "313";
		document.forms['edittour'].cena23.value = "500";
		document.forms['edittour'].cena31.value = "9500";
		document.forms['edittour'].cena32.value = "396";
		document.forms['edittour'].cena33.value = "634";

		document.forms['edittour'].hodina11.value = "700";
		document.forms['edittour'].hodina12.value = "30";
		document.forms['edittour'].hodina13.value = "50";
		document.forms['edittour'].hodina21.value = "1800";
		document.forms['edittour'].hodina22.value = "75";
		document.forms['edittour'].hodina23.value = "120";
		document.forms['edittour'].hodina31.value = "2500";
		document.forms['edittour'].hodina32.value = "104";
		document.forms['edittour'].hodina33.value = "167";

		document.forms['edittour'].entrancefees.value = "270";
		document.forms['edittour'].entrancefees1.value = "12";
		document.forms['edittour'].entrancefees2.value = "18";
	}
	</script>
	
	<div class="tourform">
		<form method="post" action="options-general.php?page=tours.php&section=save" name="edittour" id="edittourform" enctype="multipart/form-data" onSubmit="return selectAll()">
			<input type="hidden" name="id" value="<?php echo $tour['id']; ?>" />

			<label>Hotovo</label><br />
			<input type="checkbox" name="aktivni" value="1" <?php if($tour['aktivni'] == 1) echo 'checked="checked"'; ?> /> Ano<br /><br />
			
			<label>Název tour</label><br />
			<input id="title" class="textinput" type="text" name="title" size="60" style="font-size:1.5em" value="<?php echo $tour['title']; ?>" />
			<br /><br />
			
			<label>Kategorie</label><br />
			<?php print_options('category', $categories, $tour['category']); ?>
			<br /><br />

			<label>Krátký popis</label><br />
			<textarea name="shortdescription" rows="3" cols="100"><?php echo $tour['shortdescription']; ?></textarea><br /><br />

			<?php /*<fieldset id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>">
				<legend>Popis</legend>
				<?php the_editor($tour['description']); ?>
			</fieldset><br /> */ ?>
			
			<label>Popis</label><br />
			<textarea name="description" rows="15" cols="100"><?php echo $tour['description']; ?></textarea><br /><br />

			<label>Additional Info</label><br />
			<textarea name="info" rows="7" cols="100"><?php echo $tour['info']; ?></textarea><br /><br />
			
			<a name="images"></a>
			<label>Obrázky</label><br />
			<input type="file" name="img1" /><br />
			<input type="file" name="img2" /><br />
			<input type="file" name="img3" /><br /><br />
			
			<label>Náhledy</label><br />
			<table>
				<tr><td>První</td><td>Druhá</td><td>Třetí</td></tr>
				<tr>
					<td><?php if(!empty($tour['image1'])) echo '<img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour['image1'].'-t.jpg" /><br /><a href="options-general.php?page=tours.php&section=deletephoto&photoid=1&tourid='.$tour['id'].'">smazat</a>';  else echo 'není'; ?></td>
					<td><?php if(!empty($tour['image2'])) echo '<img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour['image2'].'-t.jpg" /><br /><a href="options-general.php?page=tours.php&section=deletephoto&photoid=2&tourid='.$tour['id'].'">smazat</a>';  else echo 'není'; ?></td>
					<td><?php if(!empty($tour['image3'])) echo '<img src="'.get_bloginfo('siteurl').'/wp-content/tourimages/'.$tour['image3'].'-t.jpg" /><br /><a href="options-general.php?page=tours.php&section=deletephoto&photoid=3&tourid='.$tour['id'].'">smazat</a>';  else echo 'není'; ?></td>
				</tr>
			</table>

			<a name="places"></a>
			<div>
				<table border="0">
					<tr>
						<td valign="top">
							<label>Navštívená místa</label>
							<select id="placesselect" name="places[]" multiple="multiple" size="10" style="width:350px">
								<?php
								if($tour['id'] != 0) {
									$places = $wpdb->get_results("
										SELECT tours_places.* 
										FROM tours_tour_place 
										JOIN tours_places
											ON tours_places.id=tours_tour_place.placeid
										WHERE tourid={$tour['id']}
										ORDER BY placeorder", ARRAY_A);
									foreach($places as $place)
										echo '<option value="'.$place['id'].'">'.$place['name'].'</option>';
								}
								?>
							</select><br />
							<input type="submit" value="Upravit pořadí" name="placesorder" />
						</td>
						<td align="center">
							&nbsp;&nbsp;<input type="button" value="&larr; Přidej" onClick="pridej()" />&nbsp;&nbsp;<br /><br />
							&nbsp;&nbsp;<input type="button" value="&rarr; Odeber" onClick="odeber()" />&nbsp;&nbsp;
						</td>
						<td valign="top">
							<label>Dostupná místa</label>
							<select id="allplacesselect" name="allplaces[]" multiple="multiple" size="10" style="width:450px" onChange="selPlace(this)">
								<?php
									$places = $wpdb->get_results("
										SELECT * 
										FROM tours_places 
										WHERE id NOT IN (
											SELECT placeid FROM tours_tour_place WHERE tourid={$tour['id']}) 
										ORDER BY name", ARRAY_A);
									foreach($places as $place)
										echo '<option value="'.$place['id'].'">'.$place['name'].'</option>';
								?>
							</select><br />							
							Nové: <input type="text" size="30" name="newplace" />
							<input type="button" value="Přidej" name="addplace" onClick="newPlace()" />
							<input type="button" value="Edit" name="editplace" disabled="true" style="color:gray" onClick="editPlace()" />
							<input type="button" value="Smaž" name="delplace" disabled="true" style="color:gray" onClick="deletePlace()" />
							<input type="hidden" name="op" value="0" />
						</td>
					</tr>
				</table>
			</div>
			<br /><br />

			<a name="interiors"></a>
			<label>Interiéry</label><br />
			<?php print_options('haveinteriors', $tourinteriors, $tour['interiors'], 'sinteriors(this)'); ?>
			<br /><br />
			<div id="interiorsblock" <?php if($tour['interiors'] == 2) echo 'style="display:none"'; ?>>
				<table border="0">
					<tr>
						<td valign="top">
							<label>Navštívené</label>
							<select id="interiorsselect" name="interiors[]" multiple="multiple" size="10" style="width:350px">
								<?php
								if($tour['id'] != 0) {
									$interiors = $wpdb->get_results("
										SELECT tours_interiors.* 
										FROM tours_tour_interior 
										JOIN tours_interiors
											ON tours_interiors.id=tours_tour_interior.interiorid
										WHERE tourid={$tour['id']}
										ORDER BY displayorder", ARRAY_A);
									foreach($interiors as $interior)
										echo '<option value="'.$interior['id'].'">'.$interior['name'].'</option>';
								}
								?>
							</select><br />
							<input type="submit" value="Upravit pořadí" name="interiorsorder" />
						</td>
						<td align="center">
							&nbsp;&nbsp;<input type="button" value="&larr; Přidej" onClick="pridejInterior()" />&nbsp;&nbsp;<br /><br />
							&nbsp;&nbsp;<input type="button" value="&rarr; Odeber" onClick="odeberInterior()" />&nbsp;&nbsp;
						</td>
						<td valign="top">
							<label>Dostupné</label>
							<select id="allinteriorsselect" name="allinteriors[]" multiple="multiple" size="10" style="width:500px" onChange="selInterior(this)">
								<?php
									$interiors = $wpdb->get_results("
										SELECT * 
										FROM tours_interiors
										WHERE id NOT IN (
											SELECT interiorid FROM tours_tour_interior WHERE tourid={$tour['id']}) 
										ORDER BY name", ARRAY_A);
									foreach($interiors as $interior)
										echo '<option value="'.$interior['id'].'">'.$interior['name'].'</option>';
								?>
							</select><br />
							<table>
								<tr>
									<td>
										Interiér:
									</td>
									<td>
										 <input type="text" size="30" name="newinterior" />
									</td>
									<td>
										<input type="button" value="Přidej" name="addinterior" onClick="newInterior()" />
										<input type="button" value="Edit" name="editinterior" disabled="true" style="color:gray" onClick="editInterior()" />
										<input type="button" value="Smaž" name="delinterior" disabled="true" style="color:gray" onClick="deleteInterior()" />
										<input type="hidden" name="opint" value="0" />
									</td>
								</tr>
								<tr style="display: none">
									<td>
										Otevíračky:
									</td>
									<td>
										<textarea cols="30" rows="3" name="openninghours" ></textarea>
									</td>
								</tr>
								<tr style="display: none">
									<td>
										Vstupné:
									</td>
								 	<td>
										<textarea cols="30" rows="3" name="entrancefee" /></textarea>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<br /><br />

			<label>Dostupnost</label><br />
			<?php print_options('availability', $touravailabilities, $tour['availability'], 'sdates(this)'); ?>
			<br /><br />

			<div id="dates" <?php if($tour['availability'] == 1) echo 'style="display:none"'; ?>>
				První termín: <input type="text" size="40" name="dostupnost1" value="<?php echo $tour['availability1']; ?>" /><br />
				Druhý termín: <input type="text" size="40" name="dostupnost2" value="<?php echo $tour['availability2']; ?>" /><br />
				Třetí termín: <input type="text" size="40" name="dostupnost3" value="<?php echo $tour['availability3']; ?>" />
				<br />
				<br />
			</div>

			<label>Druh tour</label><br />
			<?php $type = explode(',', $tour['type']); if($type === FALSE) $type = array(); ?>
			<table>
				<tr>
					<td><strong>Introductory Tours</strong></td>
					<td><strong>Thematic Tours</strong></td>
					<td><strong>Gastronomy Tours</strong></td>
					<td><strong>Sports & Relaxation</strong></td>
				</tr>
				<tr>
					<td valign="top" width="200px">
						<?php print_multiselect_options('type[]', $tourtypesintro, $type, 1, ''); ?>
					</td>
					<td valign="top" width="300px">
						<?php print_multiselect_options('type[]', $tourtypesthema, $type, 1, ''); ?>
					</td>
					<td valign="top" width="220px">
						<?php print_multiselect_options('type[]', $tourtypesgastro, $type, 1, ''); ?>
					</td>
					<td valign="top">
						<?php print_multiselect_options('type[]', $tourtypessports, $type, 1, ''); ?>
					</td>
				</tr>
			</table>
			<br /><br />

			<label>Různé</label><br />
			<input type="checkbox" name="assistant" value="1" <?php if($tour['assistant'] == 1) echo 'checked="checked"'; ?> />Local Area Assistant<br />
			<input type="checkbox" name="companion" value="1" <?php if($tour['companion'] == 1) echo 'checked="checked"'; ?> />Companion for Tour/Dining<br />
			<input type="checkbox" name="honeymoon" value="1" <?php if($tour['honeymoon'] == 1) echo 'checked="checked"'; ?> />Honeymoon
			<br /><br />

			<label>Regiony</label><br />
			<?php $region = explode(',', $tour['region']); if($region === FALSE) $region = array(); ?>
			<?php print_multiselect_options('region[]', $tourregions, $region, 3, ''); ?>
			<br /><br />

			<label>Na seznam Popular Tours?</label><br />
			<?php $level = explode(',', $tour['level']); if($level === FALSE) $level = array(); ?>
			<?php print_multiselect_options('level[]', $tourlevels, $level, 1, ''); ?>
			<br /><br />
			
			<label>Trvání (v hodinách)</label><br />
			<input type="text" name="duration" size="5" value="<?php echo $tour['duration']; ?>" />
			<br /><br />

			<label>Destination</label><br />
			<?php print_options('destination', $tourdestinations, $tour['destination'], 'dest(this)'); ?>
			<br /><br />
			
			<div id="vzdalenost" <?php echo $tour['destination'] == 1 ? 'style="display:none"' : '' ;?>>
				<label>Vzdálenost od Prahy (v kilometrech)</label>
				<input type="text" name="distancefromprague" size="20" value="<?php echo $tour['distancefromprague']; ?>" />
				<br /><br />
				<label>Trvání přepravy</label>
                v hodinách <input type="text" name="transpduration" size="5" value="<?php echo $tour['transpduration']; ?>" />
                nebo v minutách <input type="text" name="transpduration_min" size="5" value="<?php echo $tour['transpduration_min']; ?>" />
				
				<br /><br />
				<label>Směr</label>
				<?php $directions = explode(',', $tour['direction']); if($directions === FALSE) $directions = array(); ?>
				<table>
					<tr>
						<td><input type="checkbox" value="1" <?php if(in_array(1, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;Northwest of Prague (direction Germany - Cologne)</td>
						<td><input type="checkbox" value="2" <?php if(in_array(2, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;North of Prague (direction Germany - Dresden)</td>
						<td><input type="checkbox" value="3" <?php if(in_array(3, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;Northeast of Prague (direction Poland - Warsaw)</td>
					</tr>
					<tr>
						<td><input type="checkbox" value="4" <?php if(in_array(4, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;West of Prague (direction Germany - Nuremberg)</td>
						<td></td>
						<td><input type="checkbox" value="5" <?php if(in_array(5, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;East of Prague (direction Poland - Cracow)</td>
					</tr>
					<tr>
						<td><input type="checkbox" value="6" <?php if(in_array(6, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;Southwest of Prague (direction Germany - Munich)</td>
						<td><input type="checkbox" value="7" <?php if(in_array(7, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;South of Prague (direction Austria - Salzburg)</td>
						<td><input type="checkbox" value="8" <?php if(in_array(8, $directions)) echo 'checked="checked"'; ?> name="direction[]" />&nbsp;Southeast of Prague (direction Slovakia and Austria - Vienna)</td>
					</tr>
				</table>
				<br /><br />
			</div>
			
			<label>Způsob přepravy</label><br />
			<?php $transp = explode(',', $tour['transportation']); if($transp === FALSE) $transp = array(); ?>
			<?php print_multiselect_options('transportation[]', $tourtransportations, $transp, 1, ''); ?>
			<br /><br />
			
			<label>Pěší náročnost</label><br />
			<?php print_options('walkingability', $tourwalkingabilities, $tour['walkingability']); ?>
			<br /><br />

			<label>Day Time</label><br />
			<?php print_options('daytime', $tourdaytimes, $tour['daytime']); ?>
			<br /><br />

			<label>Ceny</label><br />
			<table>
				<tr>
					<td>Název sloupce</td>
					<td><input type="text" name="sloupec1" size="25" value="<?php echo $tour['sloupec1']; ?>" /></td>
					<td><input type="text" name="sloupec2" size="25" value="<?php echo $tour['sloupec2']; ?>" /></td>
					<td><input type="text" name="sloupec3" size="25" value="<?php echo $tour['sloupec3']; ?>" /></td>
					<td rowspan="2">Entrance Fees</td>
				</tr>
				<tr>
					<td>Počet lidí</td>
					<td><input type="text" name="lidi1" size="25" value="<?php echo $tour['lidi1']; ?>" /></td>
					<td><input type="text" name="lidi2" size="25" value="<?php echo $tour['lidi2']; ?>" /></td>
					<td><input type="text" name="lidi3" size="25" value="<?php echo $tour['lidi3']; ?>" /></td>
				</tr>
				<tr>
					<td>Cena CZK/EUR/USD</td>
					<td>
						<input type="text" name="cena11" value="<?php echo $tour['cena11']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena12" value="<?php echo $tour['cena12']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena13" value="<?php echo $tour['cena13']; ?>" size="5" />
					</td>
					<td>
						<input type="text" name="cena21" value="<?php echo $tour['cena21']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena22" value="<?php echo $tour['cena22']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena23" value="<?php echo $tour['cena23']; ?>" size="5" />
					</td>
					<td>
						<input type="text" name="cena31" value="<?php echo $tour['cena31']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena32" value="<?php echo $tour['cena32']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="cena33" value="<?php echo $tour['cena33']; ?>" size="5" />
					</td>
					<td rowspan="2">
						<input type="text" name="entrancefees" size="5" value="<?php echo $tour['entrancefees']; ?>" />&nbsp;/&nbsp;
						<input type="text" name="entrancefees1" size="5" value="<?php echo $tour['entrancefees1']; ?>" />&nbsp;/&nbsp;
						<input type="text" name="entrancefees2" size="5" value="<?php echo $tour['entrancefees2']; ?>" />
					</td>
				</tr>
				<tr>
					<td>Hodina navíc</td>
					<td>
						<input type="text" name="hodina11" value="<?php echo $tour['hodina11']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina12" value="<?php echo $tour['hodina12']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina13" value="<?php echo $tour['hodina13']; ?>" size="5" />
					</td>
					<td>
						<input type="text" name="hodina21" value="<?php echo $tour['hodina21']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina22" value="<?php echo $tour['hodina22']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina23" value="<?php echo $tour['hodina23']; ?>" size="5" />
					</td>
					<td>
						<input type="text" name="hodina31" value="<?php echo $tour['hodina31']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina32" value="<?php echo $tour['hodina32']; ?>" size="5" />&nbsp;/&nbsp;
						<input type="text" name="hodina33" value="<?php echo $tour['hodina33']; ?>" size="5" />
					</td>
				</tr>
				<tr>
					<td>Přednastavení:</td>
					<td><input type="button" value="Praha 3 hod." onClick="praha3hod()" /></td>
					<td><input type="button" value="Praha 4 hod." onClick="praha4hod()" /></td>
					<td><input type="button" value="Praha 5 hod." onClick="praha5hod()" /></td>
				</tr>
			</table>
			<br /><br />

			<label>Pickup</label><br />
			<textarea name="pickup" rows="4" cols="60"><?php echo $tour['pickup']; ?></textarea>
			<br /><br />

			<label>Comments</label><br />
			<textarea name="inprice" rows="10" cols="60"><?php echo $tour['inprice']; ?></textarea>
			<br /><br />

			<label>Reference</label><br />
			<textarea name="references" rows="10" cols="60"><?php echo $tour['tourreferences']; ?></textarea>
			<br /><br />

			<label>Poznámky</label><br />
			<textarea name="notes" rows="10" cols="60"><?php echo $tour['notes']; ?></textarea>
			<br /><br />
			
			<label>Odkazy</label><br />
			<textarea name="links" rows="10" cols="60"><?php echo $tour['links']; ?></textarea>
			<br /><br />

			<p class="submit">
				<input type="submit" name="submit" value="<?php _e('Save'); ?>" style="font-weight: bold;" tabindex="4" />
			</p>

		</form>
	</div>
	
	<?php
}

function placesOrder()
{
	global $wpdb, $url, $tourtypes, $ajaxurl;

	$tourid = intval($_REQUEST['tourid']);
	$tour = $wpdb->get_row("SELECT * FROM tours_tours WHERE id=$tourid", ARRAY_A);
	
	echo '<div class="wrap" style="text-align:left">';
	echo '<h2>Pořadí navštívených míst pro tour '.$tour['title'].'</h2>';

?>
	<script type="text/javascript">
	function hotovo()
	{
		window.location = 'options-general.php?page=tours.php&section=edit&tourid=<?php echo $tourid; ?>#places';
	}
	</script>
	<h3>Uprav pořadí přerovnáním míst myší</h3>
	<div class="places" id="sortable">
		<?php
			$places = $wpdb->get_results("
				SELECT tours_places.*
				FROM tours_tour_place
				JOIN tours_places
				 ON tours_places.id=tours_tour_place.placeid
				WHERE tourid=$tourid 
				ORDER BY placeorder", ARRAY_A);
			foreach($places as $place) {
				?>
				<div class="placessortable" id="place_<?php echo $place['id']; ?>" style="padding: 3px 0 3px 0">
					<?php echo $place['name']; ?>
				</div>
				<?php
			}
			?>
	</div>
	<br />
	<input type="button" value="Hotovo" onClick="hotovo()" />
	
	<script type="text/javascript">
		Sortable.create('sortable', {tag: 'div', overlap: 'horizontal', constraint: false,
			onUpdate: function() { 
				new Ajax.Request('<?php echo $ajaxurl; ?>?action=setplacesorder&tourid=<?php echo $tourid; ?>', {
					method: 'post',
					parameters: Sortable.serialize("sortable")
					});
			}});
	</script>
	<?php
}

function interiorsOrder()
{
	global $wpdb, $url, $tourtypes, $ajaxurl;

	$tourid = intval($_REQUEST['tourid']);
	$tour = $wpdb->get_row("SELECT * FROM tours_tours WHERE id=$tourid", ARRAY_A);
	
	echo '<div class="wrap" style="text-align:left">';
	echo '<h2>Pořadí navštívených interiérů pro tour '.$tour['title'].'</h2>';

?>
	<script type="text/javascript">
	function hotovo()
	{
		window.location = 'options-general.php?page=tours.php&section=edit&tourid=<?php echo $tourid; ?>#interiors';
	}
	</script>
	<h3>Uprav pořadí přerovnáním interiérů myší</h3>
	<div class="places" id="sortable">
		<?php
			$interiors = $wpdb->get_results("
				SELECT tours_interiors.*
				FROM tours_tour_interior
				JOIN tours_interiors
				 ON tours_interiors.id=tours_tour_interior.interiorid
				WHERE tourid=$tourid 
				ORDER BY displayorder", ARRAY_A);
			foreach($interiors as $interior) {
				?>
				<div class="interiorssortable" id="interior_<?php echo $interior['id']; ?>" style="padding: 3px 0 3px 0">
					<?php echo $interior['name']; ?>
				</div>
				<?php
			}
			?>
	</div>
	<br />
	<input type="button" value="Hotovo" onClick="hotovo()" />
	
	<script type="text/javascript">
		Sortable.create('sortable', {tag: 'div', overlap: 'horizontal', constraint: false,
			onUpdate: function() { 
				new Ajax.Request('<?php echo $ajaxurl; ?>?action=setinteriorsorder&tourid=<?php echo $tourid; ?>', {
					method: 'post',
					parameters: Sortable.serialize("sortable")
					});
			}});
	</script>
	<?php
}

function popularOrder()
{
	global $wpdb, $url, $tourtypes, $ajaxurl;

	echo '<div class="wrap" style="text-align:left">';
	echo '<h2>Pořadí populárních túr</h2>';

?>
	<script type="text/javascript">
	function hotovo()
	{
		window.location = 'options-general.php?page=tours.php&section=list';
	}
	</script>
	<h3>Uprav pořadí přerovnáním túr myší</h3>
	<div class="places" id="sortable">
		<?php
			$tours = $wpdb->get_results("
				SELECT id, title
				FROM tours_tours
				WHERE level=1
				ORDER BY displayorder", ARRAY_A);
			foreach($tours as $tour) {
				?>
				<div class="tourssortable" id="tour_<?php echo $tour['id']; ?>" style="padding: 3px 0 3px 0">
					<?php echo $tour['title']; ?>
				</div>
				<?php
			}
			?>
	</div>
	<br />
	<input type="button" value="Hotovo" onClick="hotovo()" />

	<script type="text/javascript">
		Sortable.create('sortable', {tag: 'div', overlap: 'horizontal', constraint: false,
			onUpdate: function() { 
				new Ajax.Request('<?php echo $ajaxurl; ?>?action=settoursorder', {
					method: 'post',
					parameters: Sortable.serialize("sortable")
					});
			}});
	</script>
	<?php
}

function saveTour()
{
	global $wpdb, $url, $visitedplaces;
	
	$id = intval($_REQUEST['id']);
	$aktivni = intval($_REQUEST['aktivni']);
	$title = mysql_real_escape_string($_REQUEST['title']);
	$category = intval($_REQUEST['category']);
	$description = mysql_real_escape_string($_REQUEST['description']);
	$shortdescription = mysql_real_escape_string($_REQUEST['shortdescription']);
	$info = mysql_real_escape_string($_REQUEST['info']);
	$duration = intval($_REQUEST['duration']);
	$duration_min = intval($_REQUEST['duration_min']);
	$destination = intval($_REQUEST['destination']);
	$distancefromprague = intval($_REQUEST['distancefromprague']);
	$transpduration = mysql_real_escape_string($_REQUEST['transpduration']);
	$transpduration_min = intval($_REQUEST['transpduration_min']);
	$availability = intval($_REQUEST['availability']);
	$availability1 = mysql_real_escape_string($_REQUEST['dostupnost1']);
	$availability2 = mysql_real_escape_string($_REQUEST['dostupnost2']);
	$availability3 = mysql_real_escape_string($_REQUEST['dostupnost3']);
	$interiors = intval($_REQUEST['haveinteriors']);
	$daytime = intval($_REQUEST['daytime']);
	$references = mysql_real_escape_string($_REQUEST['references']);
	$notes = mysql_real_escape_string($_REQUEST['notes']);
	$pickup = mysql_real_escape_string($_REQUEST['pickup']);
	$links = mysql_real_escape_string($_REQUEST['links']);
	$inprice = mysql_real_escape_string($_REQUEST['inprice']);
	$type = implode(',', $_REQUEST['type']);
	if ($_REQUEST['level']) $level = implode(',', $_REQUEST['level']);
	$transportation = implode(',', $_REQUEST['transportation']);
	if ($_REQUEST['region']) $region = implode(',', $_REQUEST['region']);
	if ($_REQUEST['direction']) $direction = implode(',', $_REQUEST['direction']);
	$walkingability = intval($_REQUEST['walkingability']);
	$entrancefees = mysql_real_escape_string($_REQUEST['entrancefees']);
	$entrancefees1 = mysql_real_escape_string($_REQUEST['entrancefees1']);
	$entrancefees2 = mysql_real_escape_string($_REQUEST['entrancefees2']);
	$companion = intval($_REQUEST['companion']);
	$assistant = intval($_REQUEST['assistant']);
	$honeymoon = intval($_REQUEST['honeymoon']);

	$sloupec1 = mysql_real_escape_string($_REQUEST['sloupec1']);
	$sloupec2 = mysql_real_escape_string($_REQUEST['sloupec2']);
	$sloupec3 = mysql_real_escape_string($_REQUEST['sloupec3']);
	$lidi1 = mysql_real_escape_string($_REQUEST['lidi1']);
	$lidi2 = mysql_real_escape_string($_REQUEST['lidi2']);
	$lidi3 = mysql_real_escape_string($_REQUEST['lidi3']);

	$cena11 = mysql_real_escape_string($_REQUEST['cena11']);
	$cena12 = mysql_real_escape_string($_REQUEST['cena12']);
	$cena13 = mysql_real_escape_string($_REQUEST['cena13']);
	$cena21 = mysql_real_escape_string($_REQUEST['cena21']);
	$cena22 = mysql_real_escape_string($_REQUEST['cena22']);
	$cena23 = mysql_real_escape_string($_REQUEST['cena23']);
	$cena31 = mysql_real_escape_string($_REQUEST['cena31']);
	$cena32 = mysql_real_escape_string($_REQUEST['cena32']);
	$cena33 = mysql_real_escape_string($_REQUEST['cena33']);
	
	$hodina11 = mysql_real_escape_string($_REQUEST['hodina11']);
	$hodina12 = mysql_real_escape_string($_REQUEST['hodina12']);
	$hodina13 = mysql_real_escape_string($_REQUEST['hodina13']);
	$hodina21 = mysql_real_escape_string($_REQUEST['hodina21']);
	$hodina22 = mysql_real_escape_string($_REQUEST['hodina22']);
	$hodina23 = mysql_real_escape_string($_REQUEST['hodina23']);
	$hodina31 = mysql_real_escape_string($_REQUEST['hodina31']);
	$hodina32 = mysql_real_escape_string($_REQUEST['hodina32']);
	$hodina33 = mysql_real_escape_string($_REQUEST['hodina33']);
	
	if($id == 0) {
		$wpdb->query("
			INSERT INTO tours_tours (id, title, description, shortdescription, info, type, region, level, duration, duration_min, destination, distancefromprague, transpduration, transpduration_min, direction,
				transportation, walkingability,	availability, availability1, availability2, availability3, interiors, daytime, 
				inprice, tourreferences, notes, links, sloupec1, sloupec2, sloupec3, lidi1, lidi2, lidi3, entrancefees, entrancefees1, entrancefees2,
				cena11, cena12, cena13, cena21, cena22, cena23, cena31, cena32, cena33,
				hodina11, hodina12, hodina13, hodina21, hodina22, hodina23, hodina31, hodina32, hodina33, aktivni, pickup,
				companion, assistant, honeymoon, category) VALUES
				(NULL, '$title', '$description', '$shortdescription','$info', '$type', '$region', '$level', $duration, $duration_min, $destination, $distancefromprague, '$transpduration', $transpduration_min, '$direction',
				'$transportation', $walkingability, $availability, '$availability1', '$availability2', '$availability3', $interiors, $daytime,
				'$inprice', '$references', '$notes', '$links', '$sloupec1', '$sloupec2', '$sloupec3', '$lidi1', '$lidi2', '$lidi3', '$entrancefees', '$entrancefees1', '$entrancefees2',
				'$cena11', '$cena12', '$cena13', '$cena21', '$cena22', '$cena23', '$cena31', '$cena32', '$cena33',
				'$hodina11', '$hodina12', '$hodina13', '$hodina21', '$hodina22', '$hodina23', '$hodina31', '$hodina32', '$hodina33', $aktivni, '$pickup',
				$companion, $assistant, $honeymoon, $category)
		");
		$id = $wpdb->insert_id;
	} else {
		$wpdb->query("UPDATE tours_tours SET
			title='$title', description='$description', shortdescription='$shortdescription', info='$info', type='$type', region='$region', level='$level', duration=$duration, duration_min=$duration_min, destination=$destination,
			distancefromprague=$distancefromprague, transpduration='$transpduration', transpduration_min=$transpduration_min, direction='$direction',
			transportation='$transportation', walkingability=$walkingability,	availability=$availability, availability1='$availability1',
			availability2='$availability2', availability3='$availability3', interiors=$interiors,
			daytime=$daytime, inprice='$inprice', tourreferences='$references', notes='$notes', links='$links',
			sloupec1='$sloupec1', sloupec2='$sloupec2', sloupec3='$sloupec3', lidi1='$lidi1', lidi2='$lidi2', lidi3='$lidi3', entrancefees='$entrancefees', entrancefees1='$entrancefees1', entrancefees2='$entrancefees2',
			cena11='$cena11', cena12='$cena12', cena13='$cena13', cena21='$cena21', cena22='$cena22', cena23='$cena23', 
			cena31='$cena31', cena32='$cena32', cena33='$cena33', hodina11='$hodina11', hodina12='$hodina12', hodina13='$hodina13', 
			hodina21='$hodina21', hodina22='$hodina22', hodina23='$hodina23', hodina31='$hodina31', hodina32='$hodina32', hodina33='$hodina33', aktivni=$aktivni, pickup='$pickup',
			companion=$companion, assistant=$assistant, honeymoon=$honeymoon, category=$category
			WHERE id=$id
		");
	}
	
	$wpdb->query("DELETE FROM tours_tour_place WHERE tourid=$id");
	$placeorder = 0;
	if ($_POST['places']) foreach($_POST['places'] AS $place) {
		$wpdb->query("INSERT INTO tours_tour_place (tourid, placeid, placeorder) VALUES ($id, $place, $placeorder)");
		$placeorder++;
	}

	$wpdb->query("DELETE FROM tours_tour_interior WHERE tourid=$id");
	$displayorder = 0;
	if ($_POST['interiors']) foreach($_POST['interiors'] AS $interior) {
		$wpdb->query("INSERT INTO tours_tour_interior (tourid, interiorid, displayorder) VALUES ($id, $interior, $displayorder)");
		$displayorder++;
	}

	$path = realpath(dirname($_SERVER["SCRIPT_FILENAME"]).'/../wp-content/tourimages/').'/';
	$name = md5(rand() + time());
	if(move_uploaded_file($_FILES["img1"]["tmp_name"], $path.$name.'.jpg')) {
		addImage($path, $name, $id, 1);
	}
	$name = md5(rand() + time());
	if(move_uploaded_file($_FILES["img2"]["tmp_name"], $path.$name.'.jpg')) {
		addImage($path, $name, $id, 2);
	}
	$name = md5(rand() + time());
	if(move_uploaded_file($_FILES["img3"]["tmp_name"], $path.$name.'.jpg')) {
		addImage($path, $name, $id, 3);
	}

	if($_POST['placesorder']) {
		//header("Location: options-general.php?page=tours.php&section=placesorder&tourid=$id");
		echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=placesorder&tourid='.$id.'"</script>';
		exit;
	}

	if($_POST['interiorsorder']) {
		//header("Location: options-general.php?page=tours.php&section=interiorsorder&tourid=$id");
		echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=interiorsorder&tourid='.$id.'"</script>';
		exit;
	}

	//header("Location: options-general.php?page=tours.php&section=list&action=save");
	echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=list&action=save"</script>';
}

function addImage($path, $name, $id, $idx)
{
	global $wpdb;
	
	$imginfo = getimagesize($path.$name.'.jpg', $imginfo);
	if($imginfo === FALSE) return;

	$thumbheight = 140;
	$height = 500;
	
	/*$contents = file_get_contents($path.$name.'.jpg');
	$image = imagecreatefromstring($contents); echo "xx"; print_r($image); exit;*/

	$thumbwidth = round(($thumbheight/$imginfo[1])*$imginfo[0]); //echo $thumbwidth;
	$newimage = imagecreatetruecolor($thumbwidth, $thumbheight); //echo "0";
	$image = imagecreatefromjpeg($path.$name.'.jpg'); //echo "1";
	imagecopyresampled($newimage, $image, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imginfo[0], $imginfo[1]); //echo "2";
	imagejpeg($newimage, $path.$name.'-t.jpg'); //echo "3";
	$wpdb->query("UPDATE tours_tours SET image$idx = '$name' WHERE id=$id");

	if($imginfo[1] > 400) {
		$width = round(($height/$imginfo[1])*$imginfo[0]);
		$newimage = imagecreatetruecolor($width, $height);
		imagecopyresampled($newimage, $image, 0, 0, 0, 0, $width, $height, $imginfo[0], $imginfo[1]);
		imagejpeg($newimage, $path.$name.'-f.jpg');
		imagedestroy($newimage);
	} else {
		imagejpeg($newimage, $path.$name.'-f.jpg');
		imagedestroy($newimage);
	}

	imagedestroy($image);
}

function deleteTour()
{
	global $wpdb;
	
	$wpdb->query("DELETE FROM tours_tours WHERE id=".intval($_GET['id']));
	$wpdb->query("DELETE FROM tours_tour_place WHERE tourid=".intval($_GET['id']));
	$wpdb->query("DELETE FROM tours_interiors WHERE tourid=".intval($_GET['id']));
	
	//header("Location: options-general.php?page=tours.php&section=list&action=delete");
	echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=list&action=delete"</script>';
}

function deleteInterior()
{
	global $wpdb;

	$tourid = intval($_GET['tourid']);
	$id = intval($_GET['id']);
	
	$wpdb->query("DELETE FROM tours_interiors WHERE id=$id");

	//header("Location: options-general.php?page=tours.php&section=edit&tourid=$tourid#interiors");
	echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=edit&tourid='.$tourid.'#interiors"</script>';
}

function deletePhoto()
{
	global $wpdb;
	
	$photoid = intval($_GET['photoid']);
	$tourid = intval($_GET['tourid']);
	
	$wpdb->query("UPDATE tours_tours SET image$photoid = '' WHERE id=$tourid");

	//header("Location: options-general.php?page=tours.php&section=edit&tourid=$tourid#images");
	echo '<script type="text/javascript">location.href = "options-general.php?page=tours.php&section=edit&tourid='.$tourid.'#images"</script>';
}

function tours_optionsSubpanel() {
	
	if($_REQUEST['section'] == '' || $_REQUEST['section'] == 'list')
		listTours();
	else if($_REQUEST['section'] == 'edit')
		editTour();
	else if($_REQUEST['section'] == 'save')
		saveTour();
	else if($_REQUEST['section'] == 'delete')
		deleteTour();
	else if($_REQUEST['section'] == 'deleteinterior')
		deleteInterior();
	else if($_REQUEST['section'] == 'placesorder')
		placesOrder();
	else if($_REQUEST['section'] == 'interiorsorder')
		interiorsOrder();
	else if($_REQUEST['section'] == 'popularorder')
		popularOrder();
	else if($_REQUEST['section'] == 'deletephoto')
		deletePhoto();
}

function tours_adminpanel() {
		add_options_page('Tours', 'Tours', 10, basename(__FILE__), 'tours_optionsSubpanel');
}

add_action('admin_menu', 'tours_adminpanel');



function tour_add_head(){
	/*echo('<link rel="stylesheet" href="'.get_option('siteurl').'/wp-includes/js/tinymce/themes/advanced/skins/wp_theme/ui.css?ver=3241-1141">'."\n");
	echo('<link rel="stylesheet" href="'.get_option('siteurl').'/wp-includes/js/tinymce/plugins/inlinepopups/skins/clearlooks2/window.css?ver=3241-1141">'."\n");
	*/
	echo "<style type=\"text/css\">\n";
	echo ".tourform select {height: auto !important}\n";
	echo "</style>\n";
}

add_action('admin_head', 'tour_add_head');



?>