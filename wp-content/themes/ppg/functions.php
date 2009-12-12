<?php

function safe($input) {
	return trim(get_magic_quotes_gpc() ? $input : addslashes($input));
}

function p_excerpt(&$post, $max = 130)
{
	$img = '';
	$pos = strpos($post->post_content, '|');
	if($post !== FALSE) {
		$img = substr($post->post_content, 0, $pos);
		$post->post_content = substr($post->post_content, $pos + 1, strlen($post->post_content) - $pos - 1);
	}

	if(strlen($post->post_content) > $max) {
		$txt = substr($post->post_content, 0, $max).' ... '.'<a href="'.get_bloginfo('url').'/index.php/'.$post->post_name.'/">more</a>';
		return array($img, $txt);
	} else 
		return array($img, $post->post_content);
}


function printNumbers($from, $to, $sel)
{
	for($i = $from; $i <= $to; $i++) {
		$selected = $sel == $i ? 'selected="selected"' : '';
		echo '<option value="'.$i.'" '.$selected.' >'.$i.'</option>';
	}
}


add_action('init', 'remheadlink');

function remheadlink() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
}
