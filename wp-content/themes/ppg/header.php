<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?blg=21" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/modalbox.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/menu.js"></script>
    <meta name="verify-v1" content="P53uVMJUYOw3kEszHi3SaG95R54ovO/s3sr0S0KipGA=" />
    <!--[if IE 6]>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie6.css?bl=1" type="text/css" media="screen" />
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" media="screen" />
    </style>
    <![endif]-->
    <?php wp_head() ?>

    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/ga-set.js"></script>
    <script type="text/javascript"><!--
        var pageTracker = _ga._getTracker('UA-5598646-1', '.private-prague-guide.com');
        pageTracker._trackPageview();
    //--></script>
</head>
<body>
<div id="container">
<div id="page">

<div id="header">
<?php if ($_SERVER['REQUEST_URI'] == '/'): ?>
    <h1 id="sitetitle"><a href="<?php bloginfo('home'); ?>" title="Private Prague Guide - Sightseeing Tours"><?php bloginfo('name') ?> | <?php bloginfo('description') ?></a></h1>
<?php else: ?>
    <h2 id="sitetitle"><a href="<?php bloginfo('home'); ?>" title="Private Prague Guide - Sightseeing Tours"><?php bloginfo('name') ?> | <?php bloginfo('description') ?></a></h2>
<?php endif ?>
</div>

<div id="pane">
<div id="content">