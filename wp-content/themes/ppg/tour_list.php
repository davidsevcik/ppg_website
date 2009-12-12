<?php 
/*
Template Name: Tour List
*/

get_header(); ?>

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

function fixTransportation($options = array())
{
	$ret = array();
	if (is_array($options)) {
		foreach($options as $opt) {
			if($opt == 1) {
				$ret[] = 1;
				$ret[] = 6;
			} else {
				$ret[] = $opt;
			}
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
		case 2: return "Out of Prague | ".($tour->transpduration_min ? $tour->transpduration_min.' minute' : ' hour')." drive (one way) "; //getDirection($tour);
		case 3: return "Central Europe | ".($tour->transpduration_min ? $tour->transpduration_min.' minute' : ' hour')." drive (one way) "; //getDirection($tour);
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
	$url = get_bloginfo('siteurl').'/tours/?search=1';
	
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
    if(intval($_POST['honeymoon']) == 1)
		$where .= " AND honeymoon=1 ";

	$count = $wpdb->get_row("SELECT COUNT(*) AS cnt FROM tours_tours WHERE aktivni=1 $where");
	$pagecount = intval($count->cnt / $perpage) + ($count->cnt % $perpage > 0 ? 1 : 0);
	$start = ($actpage-1)*$perpage;
	
	$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 $where ORDER BY title LIMIT $start,$perpage");	
} else if ($_GET['cat']) {
	$cat = intval($_GET['cat']);
	$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND category = $cat ORDER BY title");

} else if ($_GET['all'] == 1) {
	$_SESSION['searchtype'] = 3;

	$title = 'Complete Tour List';
	$url = get_bloginfo('siteurl').'/tours/?all=1';

    if ($_GET['filter'] == 1) {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND destination = 1 ORDER BY title");
    } else if ($_GET['filter'] == 2) {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND destination <> 1 ORDER BY title");
    } else {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 ORDER BY title");
    }
} else /* popular */ {
	$_SESSION['searchtype'] = 2;

	$title = 'Most Popular Tours';
	$url = get_bloginfo('siteurl').'/tours/?popular=1';

	$pagecount = 1;
    if ($_GET['filter'] == 1) {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND destination = 1 AND level=1 ORDER BY displayorder");
    } else if ($_GET['filter'] == 2) {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND destination <> 1 AND level=1 ORDER BY displayorder");
    } else {
        $tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND level=1 ORDER BY displayorder");
    }
}
?>

<div id="tourslist">
	<?php the_post() ?>
	<h1 id="generictitle" style="font-size:16px; line-height:25px;"><?php the_title() ?></h1>
    <div class="infobox-top"></div>
	<div class="infobox">
		<p><strong>Create your personalized day-to-day itinerary</strong> by adding tours on this page into 
		your basket. Please specify the meeting place, desired date/s and starting time/s of your tour/s 
		at the end of the tour request. You can also directly write (<a href="/contacts">link to Request Form</a>) 
		or call us (<a href="/contacts">link to Contacts</a>) and we will prepare a customized itinerary for you.</p>
    </div>
    <div class="infobox-bottom"></div>

    <?php if ($_GET['search'] <> 1): $categories = $wpdb->get_results("SELECT * FROM tours_categories"); ?>
        <p id="filter">
            <strong>Show:</strong>
			<?php 
				foreach($categories as $cat) { 
					echo ($_GET['cat'] == $cat->id) ? "<strong>{$cat->title}</strong>" : "<a href=\"?cat={$cat->id}\">{$cat->title}</a>";
					echo ' | ';
				}
				echo ($_GET['all']) ? "<strong>All Tours</strong>" : "<a href=\"?all=1\">All Tours</a>";
			?>
        </p>
    <?php endif ?>


	<div id="list">
		<?php foreach($tours as $tour) { ?>
			<div class="tour">
                <div class="photo"><img src="/wp-content/tourimages/<?= $tour->image1 ?>-t.jpg" /></div>
				<div class="addtobasket"><a href="<?php bloginfo('siteurl'); ?>/order/?action=addtobasket&tourid=<?php echo $tour->id; ?>">ADD TO BASKET</a></div>
				<h2>
					<a href="<?php bloginfo('siteurl'); ?>/private-tour/<?php echo $tour->id; ?>/<?php echo sanitize_title($tour->title); ?>/"><?php echo $tour->title; ?></a>
				</h2>
				<div class="description"><?php echo $tour->shortdescription; ?></div>
				<div class="location">Location - <?php echo getDestination($tour); ?> | Duration <?php echo $tour->duration_min ? $tour->duration_min.' minutes' : $tour->duration.($tour->duration > 1 ? ' hours' : ' hour') ?> | Availability <?php echo getAvailability($tour); ?></div>
			</div>
		<?php } ?>
	</div>
	<?php if($pagecount > 1) { ?>
		<div id="pagecounter">
            Pages:
            <?php
             $url .= '&filter=' . $_GET['filter'];
            if($actpage > 1) { ?>
				<a href="<?php echo $url.'&actpage='.($actpage - 1); ?>">&laquo; previous</a>
			<?php } ?>
            <?php
                for ($i = 1; $i <= $pagecount; $i++) {
                    echo ($actpage == $i) ? $i : " <a href=\"$url&amp;actpage=$i\">$i</a> ";
                }
            ?>
			<?php if($actpage < $pagecount) { ?>
				<a href="<?php echo $url.'&actpage='.($actpage + 1); ?>">next &raquo;</a>
			<?php } ?>
		</div>
	<?php } ?>
   

	<div id="links">
		Related Pages: <a href="<?php bloginfo('siteurl') ?>/general-tour-info/">General Tour Info</a> | 
        <a href="<?php bloginfo('siteurl'); ?>/our-private-guides/">Private Guides</a> |
        <a href="<?php bloginfo('siteurl'); ?>/price-info/">Tour Prices</a> |
        <a href="<?php bloginfo('siteurl'); ?>/basket/">Your Basket</a> |
        <a href="<?php bloginfo('siteurl'); ?>/basket/?order=1">Request Form</a>
	</div>
	
</div>

<?php get_footer(); ?>