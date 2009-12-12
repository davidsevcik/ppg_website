<?php
/*
Template Name: Transport
*/

$custom_title = 'Transportation Services';
get_header(); ?>
<div id="transport">
	<h1 id="generictitle">Transportation Services</h1>
    <div class="transportcontent">
        <p>In cooperation with my quality transportation partners I have prepared several options
        for you. On this page you can book your Prague airport transfer, rent a limousine or get
        a door-to-door transportation service from any European city to Prague.
        <em>Jay Pesta, Private Prague Guide.</em></p>
        <div class="transport-type">
            <a href="/transport/airport-transfer/"><img class="left-box" src="<?php bloginfo('template_directory'); ?>/images/skoda_superb.jpg" /></a>
            <h3><a href="/transport/airport-transfer/">I. Prague Airport / Railway Station Transfer</a></h3>
            <p>Get to your hotel in the most comfortable way by bookinga private transfer.
            Your personal driver will wait for you at the Prague airport.</p>
            <strong><a href="/transport/airport-transfer/">Prices and booking &raquo;</a></strong>
            <span class="clear">&nbsp;</span>
        </div>
        <div class="transport-type">
            <a href="/transport/car-van-minibus-limousine/"><img class="left-box" src="<?php bloginfo('template_directory'); ?>/images/limo_van.jpg" /></a>
            <h3><a href="/transport/car-van-minibus-limousine/">II. Transportation by Car, Van, Minibus, Limousine</a></h3>
            <p>Do you want to see Prague from a limo while sipping on champagne or venture
            into the Czech countryside in an air-conditioned van?</p>
            <strong><a href="/transport/car-van-minibus-limousine/">Prices and booking&raquo;</a></strong>
            <span class="clear">&nbsp;</span>
        </div>
        <div class="transport-type">
           <a href="/transport/door-to-door/"><img class="left-box" src="<?php bloginfo('template_directory'); ?>/images/mercedes_van.jpg" /></a>
            <h3><a href="/transport/door-to-door/">III. Door-to-door Transportation Service to Prague (from any European city)</a></h3>
            <p>Did you know that a ride from Vienna to Prague only takes 3-4 hours?
            Let me take all the transportation hassle off you and order a door-to-door service.</p>
            <strong><a href="/transport/door-to-door/">Prices and booking &raquo;</a></strong>
            <span class="clear">&nbsp;</span>
        </div>
    </div>
</div>

<?php get_footer(); ?>