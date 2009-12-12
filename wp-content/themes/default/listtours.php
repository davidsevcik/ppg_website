<?php get_header(); ?>

<?php
$actpage = empty($_GET['actpage']) ? (empty($_SESSION['actpage']) ? 1 : $_SESSION['actpage']) : intval($_GET['actpage']);
$_SESSION['actpage'] = $actpage;
$perpage = get_option("toursperpage");

function getOrQuery($options, $field)
{
	$sql = '';
	if(!empty($options)) {
		$sql = ' AND (';
		$first = true;
		foreach($options as $opt) {
			if(!$first)
				$sql .= ' OR ';

			$sql .= " $field=$opt ";
			
			$first = false;
		}
		$sql .= ') ';
	}
	
	return $sql;
}

function getSetQuery($options, $field)
{
	$sql = '';
	if(!empty($options)) {
		$sql = ' AND (';
		$first = true;
		foreach($options as $opt) {
			if(!$first)
				$sql .= ' OR ';
				
			$sql .= " FIND_IN_SET('$opt', $field) ";
			
			$first = false;
		}
		$sql .= ') ';
	}
	
	return $sql;
}

function fixTransportation($options)
{
	$ret = array();
	
	foreach($options as $opt) {
		if($opt == 1) {
			$ret[] = 1;
			$ret[] = 6;
		} else {
			$ret[] = $opt;
		}
	}
	
	return $ret;
}

$directions = array(
	1 => "Northwest of Prague (direction Germany - Cologne)",
	2 => "North of Prague (direction Germany - Dresden)",
	3 => "Northeast of Prague (direction Poland - Warsaw)",
	4 => "West of Prague (direction Germany - Nuremberg)",
	5 => "East of Prague (direction Poland - Cracow)",
	6 => "Southwest of Prague (direction Germany - Munich)",
	7 => "South of Prague (direction Austria - Salzburg)",
	8 => "Southeast of Prague (direction Slovakia and Austria - Vienna)");

function getDirection($tour)
{
	global $directions;
	
	return empty($tour->direction) ? '' : $directions[$tour->direction];
}

function getDestination($tour)
{
	switch($tour->destination) {
		case 1: return "Prague";
		case 2: return "Out of Prague | {$tour->transpduration} hour drive (one way) | ".getDirection($tour);
		case 3: return "Central Europe | {$tour->transpduration} hour drive (one way) | ".getDirection($tour);
	}
}

function getAvailability($tour)
{
	switch($tour->availability) {
		case 1: return "all year around";
		case 2: 
			$av = '';
			if(!empty($tour->availability1))
				$av .= $tour->availability1;
			if(!empty($tour->availability2)) {
				if(!empty($av))
					$av .= ', ';
				$av .= $tour->availability2;
			}
			if(!empty($tour->availability3)) {
				if(!empty($av))
					$av .= ', ';
				$av .= $tour->availability3;
			}
			return $av;
	}
}

if(empty($_GET['popular']) && empty($_GET['search']) && empty($_GET['all'])) {
	if($_SESSION['searchtype'] == 1)
		$_GET['search'] = 1;
	else if($_SESSION['searchtype'] == 2)
		$_GET['popular'] = 1;
}

if($_GET['search'] == 1) {
	$_SESSION['searchtype'] = 1;
	if(empty($_POST['location']) && empty($_POST['walking']) && empty($_POST['transportation']) && empty($_POST['theme']) && empty($_POST['direction'])) {
		if(!empty($_SESSION['location']))
			$_POST['location'] = $_SESSION['location'];
		if(!empty($_SESSION['walking']))
			$_POST['walking'] = $_SESSION['walking'];
		if(!empty($_SESSION['transportation']))
			$_POST['transportation'] = $_SESSION['transportation'];
		if(!empty($_SESSION['theme']))
			$_POST['theme'] = $_SESSION['theme'];
		if(!empty($_SESSION['direction']))
			$_POST['direction'] = $_SESSION['direction'];
	}
	$_SESSION['location'] = $_POST['location'];
	$_SESSION['walking'] = $_POST['walking'];
	$_SESSION['transportation'] = $_POST['transportation'];
	$_SESSION['theme'] = $_POST['theme'];
	$_SESSION['direction'] = $_POST['direction'];

	$title = 'Search Results';
	$url = get_bloginfo('siteurl').'/index.php/list/?search=1';
	
	$where = getOrQuery($_POST['location'], 'destination');
	$where .= getSetQuery(fixTransportation($_POST['transportation']), 'transportation');
	$where .= getSetQuery($_POST['theme'], 'type');
	$where .= getSetQuery($_POST['direction'], 'direction');
	if(intval($_POST['walking']) > 0)
		$where .= " AND walkingability>=".intval($_POST['walking']).' ';
	if(intval($_POST['assistant']) == 1)
		$where .= " AND assistant=1 ";
	if(intval($_POST['companion']) == 1)
		$where .= " AND companion=1 ";

	$count = $wpdb->get_row("SELECT COUNT(*) AS cnt FROM tours_tours WHERE aktivni=1 $where");
	$pagecount = intval($count->cnt / $perpage) + ($count->cnt % $perpage > 0 ? 1 : 0);
	$start = ($actpage-1)*$perpage;
	
	$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 $where ORDER BY title LIMIT $start,$perpage");	
} else if($_GET['popular'] == 1) {
	$_SESSION['searchtype'] = 2;

	$title = 'Most Popular Tours';
	$url = get_bloginfo('siteurl').'/index.php/list/?popular=1';
	
	$pagecount = 1;
	
	$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND level=1 ORDER BY displayorder");
} else {
	$_SESSION['searchtype'] = 3;

	$title = 'Complete Tour List';
	$url = get_bloginfo('siteurl').'/index.php/list/?all=1';

	$pagecount = 1;

	$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 ORDER BY title");
}
?>

<div id="tourslist">
	<h2 id="generictitle">Private Guided Tours</h2>
	
	<h1><?php echo $title; ?></h1>

	<div id="list">
		<?php foreach($tours as $tour) { ?>
			<div class="tour">
				<h3>
					<div class="addtobasket"><a href="<?php bloginfo('siteurl'); ?>/index.php/order/?action=addtobasket&tourid=<?php echo $tour->id; ?>">ADD TO BASKET</a></div>
					<a href="<?php bloginfo('siteurl'); ?>/index.php/tour/<?php echo $tour->id; ?>/<?php echo sanitize_title($tour->title); ?>/"><?php echo $tour->title; ?></a>
				</h3>
				<div class="description"><?php echo $tour->shortdescription; ?></div>
				<div class="location">Location - <?php echo getDestination($tour); ?> | Duration <?php echo $tour->duration; ?> hour<?php if($tour->duration > 1) echo 's'; ?> | Availability <?php echo getAvailability($tour); ?></div>
			</div>
		<?php } ?>
	</div>
	<?php if($pagecount > 1) { ?>
		<div id="pagecounter">
			<?php if($actpage != $pagecount) { ?>
				<div id="next">
					<a href="<?php echo $url.'&actpage='.($actpage + 1); ?>">&gt; next</a>
				</div>
			<?php } ?>
			<?php if($actpage > 1) { ?>
				<div id="back">
					<a href="<?php echo $url.'&actpage='.($actpage - 1); ?>">&lt; previous</a>
				</div>
			<?php } ?>
			Page <?php echo $actpage; ?> of <?php echo $pagecount; ?>
		</div>
	<?php } ?>

	<div id="links">
		Related Pages: <a href="<?php bloginfo('siteurl'); ?>/index.php/general-tour-info/">General Tour Info</a> | <a href="<?php bloginfo('siteurl'); ?>/index.php/our-private-guides/">Our Guides</a> | <a href="<?php bloginfo('siteurl'); ?>/index.php/price-info/">Price Info</a> | <a href="<?php bloginfo('siteurl'); ?>/index.php/basket/">Your Basket</a> | <a href="<?php bloginfo('siteurl'); ?>/index.php/basket/?order=1">Order Form</a>
	</div>
	
</div>

<?php get_footer(); ?>