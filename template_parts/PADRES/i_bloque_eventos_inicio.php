<?php 
	$c = 0;
	$custom_args = array(
		'post_type' => 'evento',
		'posts_per_page' => -1,
		'orderby'	=> 'date',
		'order'	=> 'ASC',
		'tax_query' => array(
			array(
				'taxonomy'  => 'dirigido',
				'field'     => 'slug',
				'terms'     => 'padres'
			)
		),						  
	);
	$custom_query = new WP_Query( $custom_args ); 
?>

<section id="eventos-inicio" class="items-alumnos bloque-de-eventos">
	<div class="top-eventos seccion-page pb-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 color-azul d-flex flex-wrap justify-content-center position-relative">
					<div class="titulos-top-eventos wow fadeIn" data-wow-duration="3s"><?php the_field('textos_top_eventos') ?></div>
					<div class="img-top-eventos wow fadeInRight" data-wow-duration="3s">
						<img src="<?php echo get_stylesheet_directory_uri()?>/images/elipses-padres.png" width="250">
					</div>
				</div>
			</div>

			<div id="filtro-eventos" class="row pt-5">
				<div class="listado-categorias col-md-12 wow slideInLeft" data-wow-duration="4s">
					<div class="content-listado slider-filtros color-blue">
						<button id="button-all" class="boton-filtro boton-filtro-block-1 filtrado" onclick="showall();">TODOS</button>
						<?php 
							//DECLARAR ARRAY MULTIDIMENSIONAL
							$data = [];
							if ( $custom_query->have_posts() ) : ?>
							<!-- the loop -->
							<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
								<?php 
									$terms = get_the_terms( $post->ID , 'categoria_evento' );
									if($terms) {
										foreach( $terms as $term ) {
											$term_name = $term->name;
											$term_slug = $term->slug;
											$term_color = get_field('color_categoria', $term);
										}
									};
									// LLENAR EL ARRAY
									$data[] = array(
										'name_cat' => $term_name,
										'slug_cat' => $term_slug,
										'color_cat' => $term_color
									);
									// LIMPIAR VALORES REPETIVOS DEL ARRAY
									$resData = 	array_unique($data, SORT_REGULAR);
								?>	
							<?php endwhile; ?>
						<!-- end of the loop -->
						<?php wp_reset_postdata(); ?>
						<?php endif; ?>	

						<?php
							// IMPRIMIR LOS BOTONES	CON SUS ATRIBUTOS
							foreach ($resData as $resultado) {
								echo '<button id="' .$resultado['slug_cat']. '" class="boton-filtro boton-filtro-block-1" data-filtro="' .$resultado['slug_cat']. '" onclick="filtrar();" style="border-color:'.$resultado['color_cat'].'">' . $resultado['name_cat'] . '</button>';
							}
						?>
					</div>
				</div>				
			</div>			
		</div>		
	</div>

	<?php
		/*echo '<pre>';
		print_r($resData);
		echo '</pre>'; */
	?>

	<div class="bottom-eventos seccion-page">
		<div class="container">
			<div class="listado-eventos row justify-content-center">
				<?php if ( $custom_query->have_posts() ) : ?>
				      <!-- the loop -->
				      <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); $c++ ?>
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

						<div id="evento-orden-<?php echo $c ?>" class="item-evento item-evento-block-1 <?php echo $term_slug ?> col-md-3 mb-4 wow fadeIn" data-wow-duration="3s" <?php if ($c>8): ?> style="display: none" <?php endif ?>>
							<div class="contenedor-item d-flex flex-wrap color-blanco flex-column">
								<a href="<?php the_permalink() ?>">
									<figure class="imagen-item text-center">
										<?php the_post_thumbnail('large'); ?> 
									</figure>
									<div class="resumen-item py-3 px-3">
										<h4 class="titulo-categoria-eventos" style="background-color: <?php echo $term_color ?>"><?php echo $term_name ?></h4>

										<h3 class="titulo-item"><?php the_title() ?></h3>

										<div class="fecha-novedades d-flex justify-content-between">
											<?php if (get_field('fecha_evento')): ?>
												<span class="dia-fecha"><i class="far fa-clock"></i> <?php the_field('fecha_evento') ?></span>
											<?php endif ?>
											
											<?php if (get_field('hora_evento')): ?>
												<span class="mes-fecha"><i class="far fa-calendar"></i> <?php the_field('hora_evento') ?></span>
											<?php endif ?>
										</div>	

										<div class="cta-item text-center my-3">
											<span class="boton-cta">CONOCE MÁS</span>
										</div>					
									</div>
								</a>
							</div>					
						</div>					      	
			      <?php endwhile; ?>
			      <!-- end of the loop -->

				<?php wp_reset_postdata(); ?>

				<?php else:  ?>
				    <p><?php _e( 'Lo sentimos, no se encontraron posts.' ); ?></p>
				<?php endif; ?>	

				<?php if ($c > 8): ?>
					<div class="col-12 text-center mt-5">
						<button id="ver-mas-eventos" class="boton-ver-mas-eventos" onclick="verMasEvento();">MÁS <br>EVENTOS<br><img class="wow fadeInDown" data-wow-iteration="infinite" src="<?php echo get_stylesheet_directory_uri()?>/images/down-eventos.png"></button>
					</div>
				<?php endif; ?>	
			</div>
		</div>		
	</div>
</section>

