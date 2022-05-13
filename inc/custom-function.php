<?php
/**
 * Custom functions
 */

$linkredirect = get_the_permalink(); 
// Variables de configuración para panel digital
$pdConfig['end_point'] = 'https://paneldigital.usil.edu.pe/api/savelead';
$pdConfig['token'] = 'c6e3e41d-f406-4ca5-b562-fdd2099928de';
//$IDCAMPANIA = get_field('field_6270091fd4d46','option');
//$IDCAMPANIA = get_field('field_627bbe78aa6fe',$post->ID);

function elContador() {
    //global $post;
    //$data = 0;
    $contador = (int) get_field('contador',$post->ID);
    //$contador++;
    //update_field('field_6255b33c14d70', $data, $post->ID);
    return $contador;
}

function setearCampania() {
    global $post;

}

add_action( 'wpcf7_before_send_mail', 'action_wpcf7_before_send_mail', 10, 1 );
// Definir funcion callback para CF7
function action_wpcf7_before_send_mail( $contact_form ) {
    global $pdConfig;
    global $post;
    global $IDCAMPANIA;

       
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();

    //Devuelve todos los datos enviados por formulario.
    $data = $submission->get_posted_data();

    // Obteniendo ID Campaña del POST
    $IDCAMPANIA = get_field('codigo_campana', $data['POSTSINGLE']);    

    //Preparar información para enviar a panel digital
    $postFields = array(
        $data['ID_CAMPANIA'] = $IDCAMPANIA,
        //'ID_CAMPANA' => '1140',
        'ID_CAMPANA' => $data['ID_CAMPANIA'],
        'NOMBRES_PROSPECTO' => $data['NOMBRES_PROSPECTO'],
        'APATERNO_PROSPECTO' => $data['APATERNO_PROSPECTO'],
        'AMATERNO_PROSPECTO' => $data['AMATERNO_PROSPECTO'],   
        'CORREO_PROSPECTO' => $data['CORREO_PROSPECTO'],
        'CELULAR_PROSPECTO' => $data['CELULAR_PROSPECTO'],
        'DNI_PROSPECTO' => $data['DNI_PROSPECTO'],
        'DISPOSITIVO' => $data['DISPOSITIVO'],
        //'ANIO_ESTUDIOS' => $data['ANIO_ESTUDIOS'][0],
        'TEXTO' => $data['NOMBRE_EVENTO'],
        'TEXTO_2' => 'POST ID: ' . $data['POSTSINGLE'],
        'URL_ORIGEN' => $data['utm_origin'],  
        'utm_term' => $data['utm_term'],
        'utm_source' => $data['utm_source'],
        'utm_medium' => $data['utm_medium'],             
        'utm_campaign' => $data['utm_campaign'], 
        'utm_origin' => $data['utm_origin'], 
        'utm_content' => $data['utm_content'], 
        'campo_1' => $data['campo_1'],      
        'campo_2' => $data['campo_2'], 
        'campo_3' => $data['campo_3'],  
        'campo_4' => $data['campo_4'],
        'CARRERA_INTERES' => $data['NOMBRE_EVENTO'],
        'comodin_1' => $data['POSTSINGLE'], //POST ID       
        'CODIGO_CARRERA' => $data['CODIGO_CARRERA'][0], // CODIGO CARRERA       
        'INSTITUCION_PROCEDENCIA' => $data['INSTITUCION_PROCEDENCIA'],
        'DISTRITO_PROSPECTO' => $data['DISTRITO_PROSPECTO'],                   
    );

    //Iniciamos CURL
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $pdConfig['end_point'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",

        CURLOPT_POSTFIELDS => $postFields,


        CURLOPT_HTTPHEADER => array(
        "X-API-KEY: " . $pdConfig['token'],
        "Cookie: ci_session=7h7n81asg4kdo76g9oobe5t6n3eejmhr"
        ),
    ));

    $curl_response = curl_exec($curl);
    if (curl_error($curl)) {
        $error_msg = curl_error($curl);
    }
    curl_close($curl);
    $jason = json_decode($curl_response, true);
    //VARS CUSTOM
    $pre_post = $data;


    if (!empty($jason['success'])) {
        // UPDATE FIELD CONTADOR
        update_field('contador', $data['TEXTO'], $data['POSTSINGLE']);        
    } else {

    }

};

add_action('wpcf7_mail_sent', 'save_cf7_data');
// Definir funcion callback para CF7
function save_cf7_data($cf) 
{
    if(session_id() == '') {
       session_start();
    }

    $current_submission = WPCF7_Submission::get_instance();

    $_SESSION['cf7_submission'] = $current_submission->get_posted_data();

}