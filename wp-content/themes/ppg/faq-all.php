<?php
/*
Template Name: FAQ All
*/

$faqs = $wpdb->get_results("SELECT id, post_title, post_content, post_name FROM wp_posts WHERE post_parent=22 AND post_type='page' ORDER BY post_title");

?>

<?php get_header(); ?>

<div id="faq">
	<h2 id="generictitle">Frequently Asked Questions</h2>
	
	<a name="top"></a>
	<div id="links">
		<p><strong>FAQ (A-Z)</strong></p>
		<?php foreach($faqs as $post) { ?>
			<a href="<?php bloginfo('siteurl'); ?>/faq-all/#<?php echo $post->id; ?>"><?php echo $post->post_title; ?></a><br />
		<?php } ?>
		<p>Note: This information was accurate on the time of its writing (July 2008), but can change without notice. Please be sure to confirm all details in question before planning your trip.</p>
	</div>

	<div id="list">
		<?php foreach($faqs as $post) { ?>
			<div class="faq">
				<a name="<?php echo $post->id; ?>"></a>
				<h3><?php echo $post->post_title; ?></h3>
				<?php echo wpautop($post->post_content); ?>
				<div class="toplink"><a href="#top">top of page</a></div>
			</div>
		<?php } ?>
	</div>
	
</div>

<?php get_footer(); ?>