<?php
header('Content-type: text/xml; charset="utf-8"');

$tours = $wpdb->get_results("SELECT * FROM tours_tours WHERE aktivni=1 AND level=1 ORDER BY displayorder");

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<tours>
	<?php foreach($tours as $tour) { ?>
		<tour>
			<title><?php echo $tour->title; ?></title>
			<link><?php bloginfo('siteurl'); ?>/index.php/tour/<?php echo $tour->id; ?>/<?php echo sanitize_title($tour->title); ?>/</link>
			<description><?php echo $tour->shortdescription; ?></description>
		</tour>
	<?php } ?>
</tours>


