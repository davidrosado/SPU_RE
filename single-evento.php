<?php get_header(); ?>

<?php
 	global $wp;

	$idPost = $wp_query->get_queried_object_id();
	$contador = (int) get_field('contador',$_POST_ID);

  	$link = get_the_permalink();
  	$titulo = get_the_title();
	$slug = basename(get_permalink($idPost));
	$redirect = get_bloginfo('url').'/gracias';
	$carreras = get_field('carreras','option');
	//$IDCAMPANIA = get_field('field_62673b7445dd8','option');
	//echo $IDCAMPANIA;   

  /* Tipo de dispositivo */
  	$es_movil = '0';
  	if (preg_match('/(android|wap|phone|ipad)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      $es_movil++;
  	}
  	if ($es_movil > 0) {
      $DISPOSITIVO = "MOBILE";
  	} else {
      $DISPOSITIVO = "PC";
  	}

	$terms = get_the_terms( $post->ID , 'categoria_evento');
	if($terms) {
	  foreach( $terms as $term ) {
	    $cat_obj = get_term($term->term_id, 'categoria_evento');
	    $cat_slug = $cat_obj->slug;
	    $cat_name = $cat_obj->name;
	    $cat_color = get_field('color_categoria', $term);
	  }
	}

	$terms2 = get_the_terms( $post->ID , 'dirigido');
	if($terms2) {
	  foreach( $terms2 as $term2 ) {
	    $cat_obj2 = get_term($term2->term_id, 'dirigido');
	    $cat_slug2 = $cat_obj2->slug;
	  }
	}

	//FORMATEANDO FECHAS Y HORAS  PARA ENVIAR A GOOGLE CALENDAR
	$START_DATE = get_field('fecha_evento',false,false);
	$date_start = new DateTime($START_DATE);
	$new_start_date = $date_start->format('Ymd');

	$END_DATE = get_field('fecha_final_evento',false,false);
	$date_end = new DateTime($END_DATE);
	$new_end_date = $date_end->format('Ymd');

	$START_TIME = get_field('hora_evento',false,false);
	$time_start = new DateTime($START_TIME);
	$new_start_time = $time_start->format('His');

	$END_TIME = get_field('hora_final_evento',false,false);
	$time_end = new DateTime($END_TIME);
	$new_end_time = $time_end->format('His');

	$campania_alumnos = get_field('id_campania_alumnos', 'option');
	$campania_coordinadores = get_field('id_campania_coordinadores', 'option');
	$campania_directores = get_field('id_campania_directores', 'option');
	$campania_docentes = get_field('id_campania_docentes', 'option');
	$campania_padres = get_field('id_campania_padres', 'option');
	$campania_global = get_field('id_campania_global', 'option');
    
    switch ($cat_slug2) {
        case 'alumnos':
            update_field('codigo_campana', $campania_alumnos, $post->ID);
            break;
        case 'coordinadores':
            update_field('codigo_campana', $campania_coordinadores, $post->ID);
            break;
        case 'directores':
            update_field('codigo_campana', $campania_directores, $post->ID);
            break;
        case 'docentes':
            update_field('codigo_campana', $campania_docentes, $post->ID);
            break;	
        case 'padres':
            update_field('codigo_campana', $campania_padres, $post->ID);
            break;									        
        default:
            update_field('codigo_campana', $campania_global, $post->ID);
            break;
    }
?>

<section id="contenido-pagina" class="seccion-page">
	<div class="container">
		<div class="row justify-content-between detalle-item-evento">

			<div class="col-md-6 left-detalle-single">
				<h4 class="titulo-categoria-eventos  wow fadeInLeft" data-wow-duration="2s"><a style="background-color: <?php echo $cat_color ?>" class="categoria-item-" href="<?php echo $cat_url ?>"><?php echo $cat_name ?></a></h4>

				<h2 class="titulo-seccion titulo-single wow fadeInLeft" data-wow-duration="2s"><?php the_title(); ?></h2>
				<div class="wow fadeInLeft" data-wow-duration="2s">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>		
					<?php endwhile; ?>		
					<?php endif; ?> 
				</div>

				
				<?php if( have_rows('ponentes') ): ?>
					<div id="slider-ponentes" class="ponentes col-12 px-0 mt-3 d-inline-block wow fadeInLeft" data-wow-duration="2s">
						<?php while ( have_rows('ponentes') ) : the_row(); ?>                
						<div class="item-slider item-ponente">
							<?php 
								$nombre = get_sub_field('nombre_ponente'); 
								$cargo = get_sub_field('cargo_ponente'); 
								$imagen = get_sub_field('imagen_ponente');
								$descripcion = get_sub_field('descripcion_ponente');
							?>
							<div class="top-ponente">
								<?php if ($imagen): ?>
									<figure>
										<img class="img-responsive" src="<?php echo $imagen ?>"/>     
									</figure>
								<?php endif ?>  

								<div class="meta-top">
									<h3>
										Ponente<br><strong><?php echo $nombre ?></strong>
									</h3> 
									<?php if ($cargo): ?>
										<p><?php echo $cargo ?></p>
									<?php endif ?>		                    	
								</div>	 
							</div>					

							<?php if ($descripcion): ?>
								<div class="descripcion-ponente">
									<?php echo $descripcion ?>   
								</div>      
							<?php endif ?>   

						</div>  
						<?php endwhile; ?>
					</div>
				<?php endif; ?>    

				<div class="fecha-novedades wow fadeInLeft" data-wow-duration="2s">
					<?php if(get_field('fecha_evento')): ?>
						<p class="dia-fecha"><i class="far fa-clock"></i> <?php the_field('fecha_evento') ?></p>
					<?php endif?>
					<?php if(get_field('hora_evento')): ?>
						<p class="mes-fecha"><i class="far fa-calendar"></i> <?php the_field('hora_evento') ?></p>
					<?php endif?>	
				</div>	
			</div>

			<div class="col-md-5 right-detalle-single wow fadeInRight" data-wow-duration="2s">
				<picture>
				<source media="(max-width: 990px)" srcset="<?php the_post_thumbnail_url('medium'); ?>">
				<source media="(min-width: 991px)" srcset="<?php the_post_thumbnail_url('full'); ?>">
				<img src="<?php the_post_thumbnail_url('full'); ?>">
				</picture>

				<div class="formulario-evento">
					<div class="botones-form d-flex justify-content-center">
						<button id="user-new" class="active" onclick="userNew();">NUEVO <br>USUARIO</button>
						<button id="user-old" onclick="userOld();">USUARIO <br>REGISTRADO</button>
					</div>

					<?php echo do_shortcode('[contact-form-7 id="53" html_id="frm-registro" title="Formulario de Evento"]') ?>
				</div>
				
			</div>	
		</div>

		<?php if ($contador): ?>
			<div id="asistiran" class="row justify-content-center wow fadeInUp" data-wow-duration="2s">
				<div class="col text-center">
					<?php if ($contador > 1): ?>
						<img src="<?php echo get_stylesheet_directory_uri()?>/images/foco.png"> ¡YA SON <?php echo elContador() ?> ESTUDIANTES QUE ASISTIRÁN A ESTE EVENTO!						
					<?php else: ?>
						<img src="<?php echo get_stylesheet_directory_uri()?>/images/foco.png"> ¡YA HAY <?php echo elContador() ?> ESTUDIANTE QUE ASISTIRÁN A ESTE EVENTO!						
					<?php endif ?>
				</div>
			</div>			
		<?php endif ?>

	</div>	
</section>	

<?php
	if ($cat_slug2 == 'padres') {
		include 'template_parts/PADRES/i_slider_relacionados.php';
	} else {
		include 'template_parts/RE/i_slider_relacionados.php';
	}
?>

<script src="//descubre.usil.edu.pe/CDN/disclaimerV2/dist/usilterms.min.js?v=406"></script>
<script>
var termsOptions = {
	formid : "frm-registro", //Atributo id del formulario <form id="xxxx">
	contentid : "appdpdc", //Donde se contendrá los input option
	inputname : "ACEPTO_POLITICAS", //Atributo name de los input option
	inputid : "acepto", //Atributo id de los input option
	inputvalue : "S", //Atributo value de los input option
	isrequired : false //True: agrega a los imput option el atributo required
};
new UsilTerms(termsOptions).init();
</script>

<script type="text/javascript">
	let botonAntiguo = document.getElementById("user-old")
	if (localStorage.getItem("NOMBRES_PROSPECTO") == null) {
		//console.log(botonAntiguo);
		botonAntiguo.classList.add("hidden")
	} else {
		botonAntiguo.classList.remove("hidden")
		//console.log(botonAntiguo);
	}

  document.getElementById("DISPOSITIVO").value = '<?php echo $DISPOSITIVO; ?>';
  document.getElementById("utm_origin").value = '<?php echo $link; ?>';

  var getParams = function (url) {
      var params = {};
      var parser = document.createElement('a');
      parser.href = url;
      var query = parser.search.substring(1);
      var vars = query.split('&');
      for (var i = 0; i < vars.length; i++) {
         var pair = vars[i].split('=');
         params[pair[0]] = decodeURIComponent(pair[1]);
      }
      return params;
  };

  var curr_url = document.URL;
  var params_url = getParams(curr_url);

  // GET UTMS DE URL
  if(params_url.utm_source != ""){
    document.getElementById("utm_source").value = params_url.utm_source;
  }
  if(params_url.utm_medium != ""){
    document.getElementById("utm_medium").value = params_url.utm_medium;
  }
  if(params_url.utm_campaign != ""){
    document.getElementById("utm_campaign").value = params_url.utm_campaign;
  }
  if(params_url.utm_term != ""){
    document.getElementById("utm_term").value = params_url.utm_term;
  }
  if(params_url.utm_content != ""){
    document.getElementById("utm_content").value = params_url.utm_content;
  }

  // CAMPOS PARA POSTS RELACIONADOS EN PAGINA DE GRACIAS
  document.getElementById('SLUG_CATEGORIA').value = '<?php echo $cat_slug ?>'
  document.getElementById('POSTSINGLE').value = '<?php echo $idPost ?>'

  // CAMPO CONTADOR DE LEADS
  document.getElementById('TEXTO').value = '<?php echo $contador + 1 ?>'
  
 // CAMPOS PARA CALENDAR GOOGLE
  document.getElementById('NOMBRE_EVENTO').value = '<?php echo $titulo ?>'  
  document.getElementById('FECHA_EVENTO').value = '<?php echo $new_start_date ?>'  
  document.getElementById('FECHA_EVENTO_FINAL').value = '<?php echo $new_end_date ?>'  

  document.getElementById('HORA_EVENTO').value = '<?php echo $new_start_time?>'   
  document.getElementById('HORA_EVENTO_FINAL').value = '<?php echo $new_end_time ?>'   

  document.getElementById('TEXTO_GRACIAS_EVENTO').value = '<?php the_field('texto_gracias_evento') ?>'     

//CAMPOS PARA CORREO CON FORMATO DE FECHA Y HORA

  document.getElementById('SET_FECHA_EVENTO').value = '<?php the_field('fecha_evento') ?>'
  document.getElementById('SET_HORA_EVENTO').value = '<?php the_field('hora_evento') ?>'  

 // CAMPOS CRM
  document.getElementById('campo_1').value = '<?php the_field('campo_1') ?>'   
  document.getElementById('campo_2').value = '<?php the_field('campo_2') ?>'   
  document.getElementById('campo_3').value = '<?php the_field('campo_3') ?>'   
  document.getElementById('campo_4').value = '<?php the_field('campo_4') ?>'   
  document.getElementById('campo_zoom').value = '<?php the_field('campo_zoom') ?>'        
  
  // VARIABLE PARA REDIFIRIGIR LUEGO DE EVENTO SENT DE CF7
  urlredirect = '<?php echo $redirect ?>'
</script>

<style>
	.formulario-evento #frm-registro select optgroup {
		background: #0facc4;
	}
</style>

<?php if ($cat_slug2 == 'alumnos') :?>
	<script>
		carreras = document.getElementById("CODIGO_CARRERA")
		carreras.innerHTML = '<?php echo $carreras ?>'
	</script>
<?php else : ?>
	<script>
		carreras = document.getElementById("content-campo-CODIGO_CARRERA")
		carreras.classList.add('hidden')
	</script>
<?php endif ?>

<?php
	if ($cat_slug2 == 'padres') {
		get_footer('padres');
	} else {
		get_footer();
	}
?>