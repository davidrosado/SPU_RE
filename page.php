<?php get_header(); ?>

<section class="banner-pagina">
	<div class="container">
		<div class="row">
			<div class="titulo-banner-pagina col-12 color-blanco">
				<?php if (get_field('top_titulo_cabecera')): ?>
					<h2><?php the_field('top_titulo_cabecera') ?></h2>
				<?php endif ?>
				<h1><?php the_field('titulo_cabecera') ?></h1>
			</div>
		</div>
	</div>
</section>

<section id="contenido-pagina" class="seccion-page">
	<div class="container">
		<div class="row my-3">
			<h2 class="titulo-pagina"><?php the_title(); ?></h2>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>		
				<?php endwhile; ?>		
				<?php endif; ?>  						
			</div>	
		</div>
	</div>	
</section>

<?php 
  $fondo = get_field('fondo_cabecera');
  switch ($fondo) {
      case 'amarillo':
          $color = '#ffcc00';
          break;
      case 'rosado':
          $color = '#ff6699';
          break;
      case 'celeste':
          $color = '#0099ff';
          break;
      case 'azul':
          $color = '#6666ff';
          break;
      case 'verde':
          $color = '#66cccc';
          break;
  }
?>
  
<style type="text/css">
  .banner-pagina, #cabecera-site.menu-fijo {
    background-color: <?php echo $color; ?>;
  }
</style>  	

<?php get_footer(); ?>