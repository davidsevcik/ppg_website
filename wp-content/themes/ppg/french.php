<?php
/*
Template Name: French Version
*/ 
get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post french-post" id="post-<?php the_ID(); ?>">
		<h1 id="generictitle"><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

					<br /><br />
					<hr />
					<div id="basket" style="text-align: left;">
						<div id="unscheduled" style="text-align: left;">
							<form id="schedule" method="post" action="<?php bloginfo('siteurl'); ?>/index.php/basket/">
								<input type="hidden" name="lang" value="fr" />
								<input type="hidden" name="action" value="save" />
								<input id="touridvalue" type="hidden" name="tourid" value="" />
								<input id="targetvalue" type="hidden" name="target" value="sendorder" />

								<input type="hidden" name="order" value="1" />
								<div id="nameinfo" style="text-align: left;">
									<label>Votre Nom<sup>*</sup></label><input class="block" name="yourname" value="<?php echo $tourorder->name; ?>" size="40" />
									<label>Votre e-mail<sup>*</sup></label><input class="block" name="youremail" value="<?php echo $tourorder->email; ?>" size="40" />
									<label>Combien de personnes<sup>*</sup></label><input class="block" name="people" value="<?php echo $tourorder->people; ?>" size="5" /><br />
									<label>Date<sup>*</sup></label>
									<div id="date">
										<select name="month_without_tour">
											<?php printNumbers(1, 12); ?>
										</select>/
										<select name="day_without_tour">
											<?php printNumbers(1, 31); ?>
										</select>/
										<select name="year_without_tour">
											<?php printNumbers(2009, 2010); ?>
										</select>
										<small>(MOIS/JOUR/ANNEE)</small>
									</div>
								</div>
								<div id="requirements" style="text-align: left;">
									<label>Votre Demande<sup>*</sup></label><textarea name="requirements"><?php echo $tourorder->requirements; ?></textarea>
								</div>
								<div id="infoblock" style="text-align: left;">
									<label>Lieu et Heure de RdV<sup>*</sup></label><textarea name="meetingplace"><?php echo $tourorder->place; ?></textarea>
									<label>Info supplémentaires <small>(Avez-vous besoin de transfert, restaurant, billets de théatre, etc.) </small></label><textarea name="info"><?php echo $tourorder->info; ?></textarea>
								</div>

								<div id="required" style="text-align: left;">
									<small><sup>*</sup>&nbsp;Nr du programme démandé </small><br />
								</div>
								<div id="orderbuttons">
									<a href="javascript:document.getElementById('schedule').submit();" style="padding-top: 25px">Envoyer </a>
								</div>
							</form>
						</div>
					</div>
				
				<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>

<?php get_footer(); ?>