	<div class="row">
		<div class="small-12 medium-4 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery" style="background: transparent;">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(
						array(400,'auto'), /*Consultado () en: http://eppand.com/wordpress-featured-images-with-an-auto-width-or-height/*/
						array('itemprop'=>'image')
					      ); ?>
					<?php do_action('thb_post_review_circle','small'); ?>
				</a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-8 columns">
			<header class="post-title entry-header">
				<?php the_title('<h5 class="entry-title" itemprop="name headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h5>'); ?>
			</header>
			<div class="post-content entry-content small">
				<?php echo thb_excerpt(200, '&hellip;'); ?>
			</div>
			<h5 class="entry-title">
				<a href="<?php the_permalink(); /*Consultado (07-2018) en: https://wordpress.stackexchange.com/questions/233036/how-to-add-a-read-more-button-to-my-blog*/?>">Leer más</a>
			</h5>
		</div>
	</div>
