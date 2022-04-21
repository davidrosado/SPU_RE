<?php
$dev = TRUE;
$v_ = ($dev) ? '?v=' . rand(100, 999) : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php /*<title><?php the_title();?> | <?php bloginfo('title')?></title> */?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri()?>/favicon.png">

	<?php // HOJA DE ESTILOS?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri()?>/style.css<?=$v?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/css/animate.css" />	
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()?>/js/wow.min.js"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<?php wp_head(); ?>	
</head>

<body <?php body_class(); ?>>

	<header id="cabecera-site">
		<div class="container">
			<div id="menu-header" class="row">
				<div id="identidad" class="col-md-12">
					<h1>
						<a href="<?php bloginfo('url');?>">
							<img src="<?php the_field('logo','option'); ?>" alt="SPU Relaciones Educativas" title="SPU Relaciones Educativas" width="300">
						</a>
					</h1>
				</div>	
			</div>
		</div>
	</header>