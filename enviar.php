<?php 
function es_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

if(es_ajax()) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];
    $header = 'From: ' . $email . "\r\n";
    $header .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $header .= 'Mime-Version: 1.0 \r\n';
    $header .= 'Content-Type: text/plain';
    $mensajeCorreo = "Este mensaje fue enviado por: " . $nombre . "\r\n";
    $mensajeCorreo .= "Email: " . $email . "\r\n";
    $mensajeCorreo .= "Mensaje:: " . $mensaje . "\r\n";
    $para = "jpdelatorre@easy-webdev.com";
    $asunto = "Contacto de sitio web";
    
    mail($para, $asunto, utf8_encode($mensajeCorreo), $header );
    
    echo json_encode(array(
        'mensaje' => sprintf('El mensaje se ha enviado!')
    ));
    
} else {
    die("Prohibido!");
}


?>