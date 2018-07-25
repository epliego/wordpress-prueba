<?php 
/*
 * Creado por: Eduardo Pliego Meré
 * Fecha y hora: 24-07-2018; 19:23
 * Plantillas personalizadas: Consultado (07-2018) en: https://developer.wordpress.org/themes/template-files-section/page-template-files/
 * Consultado (07-2018) en: https://wpdirecto.com/que-ficheros-editar-theme-wordpress/
 * Crear loop. Consultado (07-2018) en: https://codex.wordpress.org/The_Loop
 * 
 */
?>

<?php get_header(); ?>
<?php $VC = class_exists('WPBakeryVisualComposerAbstract'); ?>
<?php global $post; ?>
<?php $last_posts = get_posts(array('posts_per_page' => 9)); /*get_posts(array('posts_per_page' => 3))*/ ?>
<?php
//Consultado (07-2018) en: https://stackoverflow.com/questions/40561301/loop-row-in-bootstrap-every-3-columns
//Columns must be a factor of 12 (1,2,3,4,6,12)
$numOfCols = 3;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;

//Consultado (07-2018) en: https://stackoverflow.com/questions/24838864/how-do-i-get-pagination-to-work-for-get-posts-in-wordpress
$btpgid=get_queried_object_id();
$btmetanm=get_post_meta( $btpgid, 'WP_Catid','true' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array( 'posts_per_page' => 9, 'category_name' => $btmetanm, 'paged' => $paged,'post_type' => 'post' );
$postslist = new WP_Query( $args );
?>

<div class="row top-padding" data-equal=">.equal" data-row-detection="true">
	<section class="small-12 medium-8 columns equal">
	  <?php if ($postslist->have_posts()): /*Consultado (07-2018) en: https://empresiona.com/blog/como-crear-loop-ultimas-entradas-blog/*/?>
		<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style2'); ?> role="article">
			<div class="row">
				<?php while ( $postslist->have_posts() ) : $postslist->the_post(); ?>
					<div class="small-12 medium-<?php echo $bootstrapColWidth; ?> columns">
						<?php get_template_part( 'inc/poststyles/style5' ); ?>
						<?php $rowCount++; ?>
					</div>
		    <!--Cerrar el div row, dependiendo de la cantidad de columnas --><?php if($rowCount % $numOfCols == 0) echo '</div><div class="row">'; ?>
				<?php endwhile; ?>
		</article>
		<div align="center">
			<?php next_posts_link( '« Viejas Entradas', $postslist->max_num_pages ); ?>
			<?php previous_posts_link( 'Nuevas Entradas &raquo;' ); ?>
		</div>
		<?php wp_reset_postdata(); ?>
	  <?php the_posts_pagination(array(
	  	'prev_text' 	=> '<span>'.esc_html__( "&larr;", 'goodlife' ).'</span>',
	  	'next_text' 	=> '<span>'.esc_html__( "&rarr;", 'goodlife' ).'</span>',
	  	'mid_size'		=> 2
	  )); ?>
	  <?php else : ?>
	    <?php get_template_part( 'inc/loop/notfound' ); ?>
	  <?php endif; ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>