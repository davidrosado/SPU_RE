<?php
/*Template Name: Página Gracias*/
 get_header(); 

	$POSTSINGLE = $_SESSION['cf7_submission']['POSTSINGLE'];
	$SLUG_CATEGORIA = $_SESSION['cf7_submission']['SLUG_CATEGORIA'];
	$SLUG_DIRIGIDO = $_SESSION['cf7_submission']['SLUG_DIRIGIDO'];

	$TEXTO_GRACIAS_EVENTO = $_SESSION['cf7_submission']['TEXTO_GRACIAS_EVENTO'];
	$FECHA_INICIO_EVENTO = $_SESSION['cf7_submission']['FECHA_EVENTO'];
	$FECHA_FIN_EVENTO = $_SESSION['cf7_submission']['FECHA_EVENTO_FINAL'];
	$HORA_INICIO_EVENTO = $_SESSION['cf7_submission']['HORA_EVENTO'];
	$HORA_FIN_EVENTO = $_SESSION['cf7_submission']['HORA_EVENTO_FINAL'];
	$TITULO_EVENTO = $_SESSION['cf7_submission']['NOMBRE_EVENTO'];
	$ENLACE_ZOOM = $_SESSION['cf7_submission']['campo_zoom'];	
?>

<section id="contenido-pagina-gracias" class="seccion-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div id="iframe-gracias" class="iframe-block wow fadeInDown" data-wow-duration="3s">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>		
					<?php endwhile; ?>		
					<?php endif; ?>  	
					
					<?php if ($TEXTO_GRACIAS_EVENTO) {
						echo '<div class="mt-3 text-center">';
						echo $TEXTO_GRACIAS_EVENTO;
						echo '</div>';
					}
					?>
				</div>
			</div>	
		</div>

		<div class="row justify-content-center mt-5">
			<div class="cta-page-gracias text-center">
				<img width="55" src="<?php echo get_stylesheet_directory_uri()?>/images/icono-calendario.png"> 
				<a href="https://www.google.com/calendar/event?action=TEMPLATE&details=<?php echo $ENLACE_ZOOM ?>&dates=<?php echo $FECHA_INICIO_EVENTO ?>T<?php echo $HORA_INICIO_EVENTO?>/<?php echo $FECHA_FIN_EVENTO ?>T<?php echo $HORA_FIN_EVENTO?>&text=<?php echo $TITULO_EVENTO;?>&trp=false&amp;ctz=America/Lima&sprop=website:<?php bloginfo('url')?>" target="_blank" rel="noreferrer noopener" class="boton-cta">AGREGAR EVENTO A TU CALENDARIO</a>
			</div>	
		</div>		
	</div>	
</section>

<?php 
  $custom_args = array(
      	'post_type' => 'evento',
      	'posts_per_page' => -1,
      	'orderby'	=> 'date',
      	'order'	=> 'ASC',
		'post__not_in' => array($POSTSINGLE),       
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy'  => 'categoria_evento',
				'field'     => 'slug',
				'terms'     => $SLUG_CATEGORIA
			),
			array(
				'taxonomy'  => 'dirigido',
				'field'     => 'slug',
				'terms'     => $SLUG_DIRIGIDO
			)	
		),	    
    );

  $custom_query = new WP_Query( $custom_args ); ?>

<?php if ( $custom_query->have_posts() ) : ?>
	<section id="relacionados" class="seccion-page">
		<div class="container">
			<div class="row">
				<div class="titulo-seccion text-center col mb-5 wow fadeInDown" data-wow-duration="3s">
					<h2 class="text-uppercase color-blanco"><span class="color-amarillo">Estos Eventos</span> también te pueden interesar</h2>
				</div>
				<div id="listado-eventos" class="col-md-12 slider-relacionados wow fadeInDown" data-wow-duration="3s">	
			      <!-- the loop -->
			      <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
					<?php 
						$terms = get_the_terms( $post->ID , 'categoria_evento' );
						if($terms) {
							foreach( $terms as $term ) {
								//Captura ID de cada term o categoría
								$term_name = $term->name;
								$term_slug = $term->slug;
								$term_url = get_term_link($term->slug, 'categoria_evento');
								$term_id = $term->term_id;
								$term_color = get_field('color_categoria', $term);
							}
						};
					?>				
				<div class="item-evento px-2 mb-4 <?php echo $term_slug ?>">
					<div class="contenedor-item d-flex flex-wrap color-blanco flex-column">
						<figure class="imagen-item text-center">
							<a href="<?php the_permalink() ?>"><?php the_post_thumbnail('large'); ?></a> 
						</figure>
						<div class="resumen-item py-3 px-3">
							<h4 class="titulo-categoria-eventos" style="background-color: <?php echo $term_color ?>"><?php echo $term_name ?></h4>

							<h3 class="titulo-item"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

							<div class="fecha-novedades d-flex justify-content-between">
								<?php if (get_field('fecha_evento')): ?>
									<span class="dia-fecha"><i class="far fa-clock"></i> <?php the_field('fecha_evento') ?></span>
								<?php endif ?>
								
								<?php if (get_field('hora_evento')): ?>
									<span class="mes-fecha"><i class="far fa-calendar"></i> <?php the_field('hora_evento') ?></span>
								<?php endif ?>
							</div>	

							<div class="cta-item text-center my-3">
								<a class="boton-cta" href="<?php the_permalink() ?>">CONOCE MÁS</a>
							</div>					
						</div>
					</div>					
				</div>							      	
			  <?php endwhile; ?>

			<?php wp_reset_postdata(); ?>
				</div>			
			</div>
		</div>
	</section>	
<?php else:  ?>
    <?php /*<p><?php _e( 'Lo sentimos, no se encontraron posts.' ); ?></p> */?>
<?php endif; ?>	

<?php
	if ($SLUG_DIRIGIDO == 'padres') {
		get_footer('padres');
	} else {
		get_footer();
	}
?>