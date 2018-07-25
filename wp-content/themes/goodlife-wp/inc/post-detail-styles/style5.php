<?php
	$id = get_the_ID();
	$review_style = get_post_meta($id, 'post-review-style', true);
	$fixed = ot_get_option('article_fixed_sidebar', 'on');
	$featured_image_credit = get_post_meta($id, 'standard-featured-credit', true);
	$image_id = get_post_thumbnail_id();
	$image_link = wp_get_attachment_image_src($image_id,'full');
	$vars = $wp_query->query_vars;
	$thb_ajax = array_key_exists('thb_ajax', $vars) ? $vars['thb_ajax'] : false;
?>
<div class="post-detail-row">
	<div class="post post-header small parallax_bg">
		<div class="inline_bg"
				 data-bottom-top="transform: translate3d(0px, 5%, 0px);"
				 data-top-bottom="transform: translate3d(0px, -5%, 0px);"
				 style="background-image: url('<?php echo esc_attr($image_link[0]); ?>')"></div>
		<div class="inner_header">
			<div class="row">
				<div class="small-12 columns">
					<header class="post-title entry-header">
						<?php do_action( 'thb_DisplaySingleCategory', true); ?>
						<?php the_title('<h1 class="entry-title" itemprop="name headline">', '</h1>' ); ?>
						<?php do_action('thb_PostMeta', true, true, true, true, true ); ?>
					</header>
				</div>
			</div>
		</div>
		
	</div>
	<div class="row style5-container"<?php if ($fixed == 'on') { ?> data-equal=">.columns" data-row-detection="true"<?php } ?>>
		<?php if ($featured_image_credit) { ?>
			<figcaption class="featured_image_credit"><?php echo esc_attr($featured_image_credit); ?></figcaption>
		<?php } ?>
		<div class="small-12 medium-8 columns">
		  <article itemscope itemtype="http://schema.org/Article" <?php post_class('post blog-post style5'); ?> id="post-<?php the_ID(); ?>" role="article" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
		  	<div class="share-container">
			  	<?php do_action('thb_social_article_detail_vertical', false, true, 'hide-for-small'); ?>
				  <div class="post-content-container">
						<div class="post-content entry-content cf">
							<?php if ($review_style !== 'style3') { do_action('thb_post_review' ); } ?>
				    	<?php the_content(); ?>
				    	<?php if ( is_single()) { wp_link_pages(); } ?>
						</div>
					</div>
				</div>
				<?php if ($review_style === 'style3') { do_action('thb_post_review' ); } ?>
				<?php get_template_part( 'inc/postformats/post-end' ); ?>
		  </article>
			<?php if (!$thb_ajax) { ?>
				<?php comments_template('', true); ?>
			<?php } ?>
		</div>
		<?php get_sidebar('single'); ?>
	</div>
</div>
<?php if (!$thb_ajax) { ?>
	<?php if(ot_get_option('related_posts') !== 'off') { ?>
	<div class="row">
	  <div class="small-12 columns">
	  	<?php get_template_part( 'inc/postformats/post-latest' ); ?>
	  </div>
	</div>
	<?php } ?>
<?php } ?>