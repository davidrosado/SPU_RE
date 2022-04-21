<?php
  /*Template Name: Página de Inicio Padres */
  get_header('padres'); 
?>

<?php include 'template_parts/PADRES/i_banner_inicio.php' ?>

<?php include 'template_parts/PADRES/i_bloque_ii_inicio.php' ?>

<?php include 'template_parts/PADRES/i_bloque_eventos_inicio.php' ?>

<div id="ver-eventos" class="wow fadeIn" data-wow-duration="5s">
  <a href="#eventos-inicio" class="cta-btn go-to">VER EVENTOS</a>
</div>

<?php get_footer('padres'); ?>