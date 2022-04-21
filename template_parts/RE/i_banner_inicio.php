<section id="banner-home" class="seccion-page">
  <div class="container">
    <div class="row wow fadeInDown" data-wow-duration="4s">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php the_content(); ?>   
        <?php endwhile; ?>    
        <?php endif; ?>  
    </div>
    <div class="arrow-down row text-center">
      <a href="#bloque_2_inicio" class="go-to"><img class="wow fadeInDown" data-wow-iteration="infinite" src="<?php echo get_stylesheet_directory_uri()?>/images/button-down.png"></a>
    </div>
  </div>

  <div id="sello-ad" class="wow fadeInDown" data-wow-duration="4s">
    <img src="<?php echo get_stylesheet_directory_uri()?>/images/sello-padres.png" width="280">
  </div>
</section>

<section class="franja bgLight py-4">
  <div class="container">
    <div class="d-flex">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">     
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">
      <img class="img" src="<?php echo get_stylesheet_directory_uri()?>/images/marquesinas-re.png" alt="Relaciones Educativas">          
    </div>
  </div>
</section>