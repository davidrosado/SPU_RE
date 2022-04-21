<?php
/**
 * Custom functions
 */

$linkredirect = get_the_permalink(); 
// Variables de configuración para panel digital
$pdConfig['end_point'] = 'https://paneldigital.usil.edu.pe/api/savelead';
$pdConfig['token'] = 'c6e3e41d-f406-4ca5-b562-fdd2099928de';

function elContador() {
    //global $post;
    //$data = 0;
    $contador = (int) get_field('field_6255b33c14d70',$post->ID);
    //$contador++;
    //update_field('field_6255b33c14d70', $data, $post->ID);
    return $contador;
}

add_action( 'wpcf7_before_send_mail', 'action_wpcf7_before_send_mail', 10, 1 );
// Definir funcion callback para CF7
function action_wpcf7_before_send_mail( $contact_form ) {
    global $pdConfig;
    global $post;

    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();

    //Devuelve todos los datos enviados por formulario.
    $data = $submission->get_posted_data();

    //Preparar información para enviar a panel digital
    $postFields = array(
        'ID_CAMPANA' => '514',
        'NOMBRES_PROSPECTO' => $data['NOMBRES_PROSPECTO'],
        'APATERNO_PROSPECTO' => $data['APATERNO_PROSPECTO'],
        'AMATERNO_PROSPECTO' => $data['AMATERNO_PROSPECTO'],   
        'CORREO_PROSPECTO' => $data['CORREO_PROSPECTO'],
        'CELULAR_PROSPECTO' => $data['CELULAR_PROSPECTO'],
        'DNI_PROSPECTO' => $data['DNI_PROSPECTO'],
        'DISPOSITIVO' => $data['DISPOSITIVO'],
        'TEXTO' => $data['TEXTO'],
        'TEXTO_2' => $data['POSTSINGLE'],
        'URL_ORIGEN' => $data['URL_ORIGEN'],   
        'utm_term' => $data['utm_term'],
        'utm_source' => $data['utm_source'],
        'utm_medium' => $data['utm_medium'],             
        'utm_campaign' => $data['utm_campaign'], 
        'utm_origin' => $data['utm_origin'], 
        'utm_content' => $data['utm_content'], 
        'campo_1' => $data['campo_1'],      
        'campo_2' => $data['campo_2'], 
        'campo_3' => $data['campo_3'],                             
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
        update_field('field_6255b33c14d70', $data['TEXTO'], $data['POSTSINGLE']);        
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