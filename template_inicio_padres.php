<?php
  /*Template Name: Página de Inicio Padres */

  get_header('padres'); 

  global $wp;
  $codigo_campania = get_field('codigo_campana');
	$campania_padres = get_field('id_campania_padres', 'option');
	$campania_global = get_field('id_campania_global', 'option');

  if ($campania_padres) {
    update_field('codigo_campana', $campania_padres, $post->ID);
  } else {
    update_field('codigo_campana', $campania_global, $post->ID);
  }

  $isLocalStorage = FALSE;
	$redirect = get_bloginfo('url').'/gracias';
	$carreras = get_field('carreras','option');
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
?>

<?php include 'template_parts/PADRES/i_banner_inicio.php' ?>

<?php include 'template_parts/PADRES/i_bloque_ii_inicio.php' ?>

<?php include 'template_parts/PADRES/i_bloque_eventos_inicio.php' ?>

<div id="ver-eventos" class="wow fadeIn" data-wow-duration="5s">
  <a href="#eventos-inicio" class="cta-btn go-to">VER EVENTOS</a>
</div>


<?php 
  $c = -1;
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
  if ( $custom_query->have_posts() ) : ?>
  <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); $c++?>
    <?php
    // VARIABLES DE LOS POSTS
      $idPost = get_the_ID();
      $contador = (int) get_field('contador',$_POST_ID);

      $link = get_the_permalink();
      $titulo = get_the_title();
      $slug = basename(get_permalink($idPost));
      $zoom = get_field('campo_zoom');
      $texto_gracias_evento = get_field('texto_gracias_evento');
      $campo_1 = get_field('campo_1');
      $campo_2 = get_field('campo_2');
      $campo_3 = get_field('campo_3');
      $campo_4 = get_field('campo_4');

      $cats = get_the_terms( $post->ID , 'categoria_evento');
      if($cats) {
        foreach( $cats as $cat ) {
          $categ_obj = get_term($cat->term_id, 'categoria_evento');
          $categ_slug = $categ_obj->slug;
        }
      }

      //FORMATEANDO FECHAS Y HORAS  PARA ENVIAR A GOOGLE CALENDAR
      $START_DATE = get_field('fecha_evento',false,false); $date_start = new DateTime($START_DATE); $new_start_date = $date_start->format('Ymd');
      $END_DATE = get_field('fecha_final_evento',false,false); $date_end = new DateTime($END_DATE); $new_end_date = $date_end->format('Ymd');
      $START_TIME = get_field('hora_evento',false,false); $time_start = new DateTime($START_TIME); $new_start_time = $time_start->format('His');
      $END_TIME = get_field('hora_final_evento',false,false); $time_end = new DateTime($END_TIME); $new_end_time = $time_end->format('His');
      $FECHA = get_field('fecha_evento');
      $HORA = get_field('hora_evento');

      $dataEventos[] = array(
        'indice' => $c,
        'idPost' => $idPost,
        'titulo' => $titulo,
        'link'  => $link,
        'categ_slug' => $categ_slug,
        'start_date' => $FECHA,
        'start_time' => $HORA,
        'new_start_date' => $new_start_date,
        'new_end_date' => $new_end_date,
        'new_start_time' => $new_start_time,
        'new_end_time' => $new_end_time,
        'contador'  => $contador,
        'texto_gracias_evento' => $texto_gracias_evento,
        'zoom' => $zoom,
        'campo_1' => $campo_1,
        'campo_2' => $campo_2,
        'campo_3' => $campo_3,
        'campo_4' => $campo_4                        
      );

      //$resData = 	array_unique($data, SORT_REGULAR);
    ?>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
<?php else:  ?>
    <p><?php _e( 'Lo sentimos, no se encontraron posts.' ); ?></p>
<?php endif; ?>	

<script>
  selectEventos = document.getElementById("CARRERA_INTERES");
  listEventos = <?php echo json_encode($dataEventos, JSON_PRETTY_PRINT) ?>;
  //console.log(listEventos)
  for (var i = 0; i < listEventos.length; i++) {
    // POPULATE SELECT ELEMENT WITH JSON.
    selectEventos.innerHTML = selectEventos.innerHTML + '<option data-fecha="'+listEventos[i]['start_date']+'" data-indice="'+listEventos[i]['indice']+'" value="'+listEventos[i]['titulo']+'">'+listEventos[i]['titulo']+'</option>';
  }  
  document.querySelector('#POSTSINGLE').value = '<?php echo $post->ID ?>'
</script>

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

  const selectElement = document.querySelector('#CARRERA_INTERES');
  // LLENAR CAMPOS SEGUN SELECCIONEMOS EN EL COMBO EVENTOS
  selectElement.onchange = (e) => {
    const [option] = e.target.selectedOptions
    opcion = option.dataset.indice // obtenemos el indice del option para obtener los valores

    // CAMPOS PARA POSTS RELACIONADOS EN PAGINA DE GRACIAS
    document.querySelector('#SLUG_CATEGORIA').value = listEventos[opcion]['categ_slug']
    
    //document.querySelector('#POSTSINGLE').value = listEventos[opcion]['idPost']
    //document.querySelector('#POSTSINGLE').value = '<?php echo $idPost?>'

    // CAMPO CONTADOR DE LEADS
    document.querySelector('#TEXTO').value = listEventos[opcion]['contador'] + 1
    
  // CAMPOS PARA CALENDAR GOOGLE
    document.querySelector('#NOMBRE_EVENTO').value = listEventos[opcion]['titulo']
    document.querySelector('#FECHA_EVENTO').value = listEventos[opcion]['new_start_date']
    document.querySelector('#FECHA_EVENTO_FINAL').value = listEventos[opcion]['new_end_date']
    document.querySelector('#HORA_EVENTO').value = listEventos[opcion]['new_start_time']
    document.querySelector('#HORA_EVENTO_FINAL').value = listEventos[opcion]['new_end_time']   

    document.querySelector('#TEXTO_GRACIAS_EVENTO').value = listEventos[opcion]['texto_gracias_evento']
    // FECHA Y HORA MAIL SUCIRPCION A EVENTO
    document.querySelector('#SET_FECHA_EVENTO').value = listEventos[opcion]['start_date']
    document.querySelector('#SET_HORA_EVENTO').value = listEventos[opcion]['start_time']

    // CAMPOS CRM
    document.querySelector('#campo_zoom').value = listEventos[opcion]['zoom']
    document.querySelector('#campo_1').value = listEventos[opcion]['campo_1']
    document.querySelector('#campo_2').value = listEventos[opcion]['campo_2']
    document.querySelector('#campo_3').value = listEventos[opcion]['campo_3']
    document.querySelector('#campo_4').value = listEventos[opcion]['campo_4']      

    
  } 

  // VARIABLE PARA REDIFIRIGIR LUEGO DE EVENTO SENT DE CF7
  urlredirect = '<?php echo $redirect ?>'
  //console.log(urlredirect)
  carreras = document.getElementById("CODIGO_CARRERA");
  carreras.innerHTML = '<?php echo $carreras ?>'

</script>

<style>
	.formulario-evento #frm-registro select optgroup {
		background: #0facc4;
	}
</style>

<?php get_footer('padres'); ?>