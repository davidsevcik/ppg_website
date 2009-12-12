<?php
/*
Template Name: Link Exchange
*/
?>

<?php get_header(); ?>
<div class="post" id="link-exchange">
	<h1 id="generictitle"><?php the_title(); ?></h1>
	<div class="entry">
		<p><a href="/link-exchange/" class="add-link">Add link to your site</a></p>
		<ul id="link-list">
		<?php wp_list_bookmarks(array('show_name' => 1, 'show_description' => 1, 'category_orderby' => 'slug')) ?>
		</ul>
		<p><a href="/link-exchange/" class="add-link">Add link to your site</a></p>
	</div>
</div>

<?php get_footer(); ?>


