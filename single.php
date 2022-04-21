<?php get_header(); ?>

<?php
	$terms = get_the_terms( $post->ID , 'category');
	if($terms) {
	  foreach( $terms as $term ) {
	    $cat_obj = get_term($term->term_id, 'category');
	    $cat_slug = $cat_obj->slug;
	    $cat_name = $cat_obj->name;
	  }
	}
	?>

<?php /*
<section class="banner-pagina" style="background-color: #ffcc00">
	<div class="container">
		<div class="row">
			<div class="titulo-banner-pagina col-12 color-blanco">
				<h1><?php echo $cat_name ?></h1>
			</div>
		</div>
	</div>
</section>
*/?>

<section id="contenido-pagina" class="seccion-page">
	<div class="container">
		<div class="row justify-content-center item-blog">

			<div class="col-md-8 imagen-post">

				<div class="top-detalle mb-3">
					<h2 class="titulo-seccion titulo-single my-3"><?php the_title(); ?></h2>
				</div>

		    <picture>
		      <source media="(max-width: 990px)" srcset="<?php the_post_thumbnail_url('medium'); ?>">
		      <source media="(min-width: 991px)" srcset="<?php the_post_thumbnail_url('full'); ?>">
		      <img src="<?php the_post_thumbnail_url('full'); ?>">
		    </picture>
			</div>

			<div class="col-md-8 detalle-post">
				<div class="contenido-detalle mt-5 text-justify">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>		
					<?php endwhile; ?>		
					<?php endif; ?>  						
				</div>

				<div class="bottom-detalle my-5">
					<p class="date-item"><?php echo get_the_date(); ?></p>	
				</div>

				<?php /*
				<div class="bottom-detalle mt-5">			
	        <hr>
					<div class="share-single mt-5 text-center">
						<p><strong>Compartir este artículo:</strong></p>
						<ul class="share-redes mb-5">
							<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()?>/images/icono-facebook.png"></a></li>
							<?php /*<li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink();?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()?>/images/icono-linkedin.png"></a></li>
							<li><a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink();?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri()?>/images/icono-twitter.png"></a></li> 
						</ul>	
					</div>

				</div>	
				*/?>
				
			</div>	
		</div>
	</div>	
</section>	

<style type="text/css">
  .banner-pagina, #cabecera-site.menu-fijo {
    background-color: #ffcc00;
  }
</style>  

<?php get_footer(); ?>