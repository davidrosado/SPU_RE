<section id="relacionados" class="seccion-page">
	<div class="container">
		<div class="row">
			<div class="titulo-seccion text-center col mb-5">
				<h2 class="text-uppercase color-blanco"><span class="color-amarillo">Estos Eventos</span> también te pueden interesar</h2>
			</div>
			<div id="listado-eventos" class="col-md-12 slider-relacionados">
				<?php 
				  $custom_args = array(
				      'post_type' => 'evento',
				      'posts_per_page' => -1,
				      'orderby'	=> 'date',
				      'order'	=> 'ASC',
				      'offset__in'	=> $_POST_ID,
						'tax_query' => array(
							array(
								'taxonomy'  => 'categoria_evento',
								'field'     => 'slug',
								'terms'     => $cat_slug
							)
						),	      
				    );

				  $custom_query = new WP_Query( $custom_args ); ?>

				<?php if ( $custom_query->have_posts() ) : ?>
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
								<h4 class="titulo-categoria-eventos"><a style="background-color: <?php echo $term_color ?>" class="categoria-item-" href="<?php echo $term_url ?>"><?php echo $term_name ?></a></h4>

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

				<?php else:  ?>
				    <p><?php _e( 'Lo sentimos, no se encontraron posts.' ); ?></p>
				<?php endif; ?>	
			</div>			
		</div>
	</div>
</section>			
