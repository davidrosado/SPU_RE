<?php
    if( have_rows('bloque_beneficios') ):?>
    <section id="beneficios" class="seccion-page">
        <div class="container"> 
            <div class="row">
                <div id="iframe-beneficios" class="d-flex flex-wrap iframe-block">    
                    <?php while ( have_rows('bloque_beneficios') ) : the_row(); ?>                
                        <div class="item-beneficio col-md-4 mb-3 text-center wow fadeInDown" data-wow-duration="3s">
                            <?php 
                                $icono = get_sub_field('icono'); 
                                $titulo = get_sub_field('titulo'); 
                                $enlace = get_sub_field('enlace');
                            ?>
                            <div class="content-item-beneficio px-2">
                                <?php if ($icono): ?>
                                    <figure class="imagen-item-beneficio">
                                        <img class="img-responsive" src="<?php echo $icono ?>"/>     
                                    </figure>
                                <?php endif ?>  

                                <div class="meta-item-beneficio">
                                    <h3><?php echo $titulo ?><h3> 
                                    <?php if ($enlace) : ?>
                                        <a class="cta-item-beneficio" href="<?php echo $enlace?>" target="_blank">Más Información</a>
                                    <?php endif ?>      	
                                </div>	 
                            </div>
                        </div>  
                    <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div id="elipse-beneficios" class="wow fadeInDown" data-wow-duration="4s">
        <img src="<?php echo get_stylesheet_directory_uri()?>/images/estrella.png" width="180">
    </div>    
</section>                    
<?php endif; ?>    	