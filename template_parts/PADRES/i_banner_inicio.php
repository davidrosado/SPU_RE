<section id="banner-home" class="seccion-page">
  <div class="container">
    <div class="row wow fadeInDown" data-wow-duration="4s">
        <div class="contenedor-banner col-md-12">
          <div class="col-md-7">
            <img src="<?php the_field('imagen_banner') ?>">
          </div>
          <div class="formulario-evento col-12 col-md-5">
            <?php
                $form = get_field('formulario_banner');
                echo do_shortcode($form);
            ?>
          </div>
        </div>
    </div>
  </div>

  <div id="sello-ad" class="wow fadeInDown" data-wow-duration="4s">
    <img src="<?php echo get_stylesheet_directory_uri()?>/images/sello-re.png" width="280">
  </div>
</section>

<?php if(get_field('texto_bottom_banner')): ?>
  <section id="bottom-banner">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10 text-center">
          <?php the_field('texto_bottom_banner')?>
        </div>
      </div>
    </div>
  </section>
<?php endif?>

<section class="arrow">
  <div class="container">
    <div class="arrow-down row text-center">
      <a href="#bloque_2_inicio" class="go-to"><img class="wow fadeInDown" data-wow-iteration="infinite" src="<?php echo get_stylesheet_directory_uri()?>/images/button-down.png"></a>
    </div>   
  </div>
</section>

<section class="franja bgLight py-4">
  <div class="container">
    <div class="d-flex">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">     
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/spu-padres-marquesinas.png" alt="Relaciones Educativas">          
    </div>
  </div>
</section>