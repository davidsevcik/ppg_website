<?php
/*
if(strstr($_SERVER["REQUEST_URI"], '/search-tour/') !== FALSE) {
	require_once('searchtour.php');
} else if(strstr($_SERVER["REQUEST_URI"], '/order/') !== FALSE) {
	require_once('order.php');
} else if(strstr($_SERVER["REQUEST_URI"], '/hotels/') !== FALSE) {
	require_once('hotels.php'); 
} else if(strstr($_SERVER["REQUEST_URI"], '/toursfeed/') !== FALSE) {
	require_once('toursfeed.php'); 
} else if(strstr($_SERVER["REQUEST_URI"], '/tickets/') !== FALSE) {
	require_once('tickets.php'); 
} else if(strstr($_SERVER["REQUEST_URI"], '/faq-all/') !== FALSE) {
	require_once('faq-all.php'); 
} else if(strstr($_SERVER["REQUEST_URI"], '/basket/') !== FALSE) {
	require_once('basket.php'); 
} else if(strstr($_SERVER["REQUEST_URI"], '/orderform/') !== FALSE) {
	require_once('orderform.php');
} else {*/
	$intro = $wpdb->get_row("SELECT * FROM {$table_prefix}posts WHERE ID=3");
	$prvni = $wpdb->get_row("SELECT * FROM {$table_prefix}posts WHERE ID=4");
	list($prvniimg, $prvniexcerpt) = p_excerpt($prvni, 1000);
	$druhy = $wpdb->get_row("SELECT * FROM {$table_prefix}posts WHERE ID=7");
	list($druhyimg, $druhyexcerpt) = p_excerpt($druhy, 1000);
	$treti = $wpdb->get_row("SELECT * FROM {$table_prefix}posts WHERE ID=9");
	list($tretiimg, $tretiexcerpt) = p_excerpt($treti, 1000);
	$ctvrty = $wpdb->get_row("SELECT * FROM {$table_prefix}posts WHERE ID=11");
	list($ctvrtyimg, $ctvrtyexcerpt) = p_excerpt($ctvrty, 1000);
?>
<?php get_header(); ?>

	<div id="intro">
		<h2><?php echo get_the_title(3); ?></h2>
		<div><?php echo $intro->post_content; ?></div>
	</div>
	
	<div id="ctyrka">
		<div id="sloupec1">
			<div id="prvni" class="uvod">
				<h2><?php echo $prvni->post_title; ?></h2>
				<img class="vectyrce" src="<?php echo $prvniimg; ?>" />
				<div><?php echo $prvniexcerpt; ?></div>
			</div>
			<div id="druhy" class="uvod">
				<h2><?php echo $treti->post_title; ?></h2>
				<img class="vectyrce" src="<?php echo $tretiimg; ?>" />
				<div><?php echo $tretiexcerpt; ?></div>
			</div>
		</div>
		<div id="sloupec2">
			<div id="treti" class="uvod">
				<h2><?php echo $druhy->post_title; ?></h2>
				<img class="vectyrce" src="<?php echo $druhyimg; ?>" />
				<div><?php echo $druhyexcerpt; ?></div>
			</div>
			<div id="ctvrty" class="uvod">
				<h2><?php echo $ctvrty->post_title; ?></h2>
				<img class="vectyrce" src="<?php echo $ctvrtyimg; ?>" />
				<div><?php echo $ctvrtyexcerpt; ?></div>
			</div>
		</div>
	</div>
	
	<div id="news"><a name="news"></a>
		<hr />
		<h2 style="font-size:1.5em">Private Prague Guide on YouTube</h2>
		
		
		<p><object width="320" height="265"><param name="movie" value="http://www.youtube.com/v/IdmPoOvO8ss&#038;hl=cs&#038;fs=1&#038;rel=0&#038;color1=0x006699&#038;color2=0x54abd6"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/IdmPoOvO8ss&#038;hl=cs&#038;fs=1&#038;rel=0&#038;color1=0x006699&#038;color2=0x54abd6" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="265"></embed></object></p>

		
		<hr />
		<h2>News</h2>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">
				<small class="date"><?php the_time('d-m-Y') ?></small>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="entry">
					<?php the_content('more'); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link('&laquo; newer entries') ?></div>
			<div class="alignright"><?php next_posts_link('older entries &raquo;') ?></div>
		</div>

	</div>

<?php get_footer(); ?>
<?php //} ?>