<section id="bloque_2_inicio" class="seccion-page">
	<div class="container">
		<div class="row justify-content-between">
			<?php if (get_field('left_contenido')): ?>
				<div class="col-md-6 left-contenido wow fadeInLeft" data-wow-duration="2s">
					<?php the_field('left_contenido') ?>
				</div>				
			<?php endif ?>

			<?php if (get_field('right_contenido')): ?>
				<div class="col-md-6 right-contenido pb-5 wow fadeInRight" data-wow-duration="2s">
					<?php the_field('right_contenido') ?>
				</div>
			<?php endif ?>
		</div>
	</div>
</section>