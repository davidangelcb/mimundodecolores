<?php
if(isset($_POST['cmd'])){
require_once('admin/lib/config.php');
require_once("admin/lib/funcs.php");
require_once("admin/lib/load.php");
$config = array(
    'correocontacto'=>'david@mayopi.com',
    'correocccontacto'=>''
    );        
$query0 = "select *  from configuracion   limit 1";
$_conf = DbArgenper::fetchOne($query0);//
if($_conf){
    $config['correocontacto'] =$_conf['correocontacto']; 
    $config['correocccontacto'] =$_conf['correocccontacto']; 
}


ini_set("display_errors",0);

ini_set("SMTP","localhost");//Cambien mail.cantv.net Por localhost ... ojo, ojo OJO
ini_set("smtp_port",25);
ini_set("sendmail_from","turemitente@gmail.com");


$to  = $config['correocontacto']; // note the comma    info@mimundodecolores.com
if($config['correocccontacto']!=''){
    $to .= ','.$config['correocccontacto']; //solo de prueba quitar luego
}


// subject
$subject = 'Contactemos Formulario mimundodecolores.com';
// message
$message = '
<html>
<head>
  <title>Contacto</title>
</head>
<body>
  <p>Datos</p>
  <table width="450" style="font-size:12px; font-family:arial;">
    <tr>
      <td width="150"><strong>Apellido</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['ape'].'</td>
    </tr>
    <tr>
      <td width="150"><strong>Nombre</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['nom'].'</td>
    </tr>    
    <tr>      
      <td width="150"><strong>Email</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['ema'].'</td>
    </tr>    
    <tr>      
      <td width="150"><strong>Telefono</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['tel'].'</td>
    </tr>    
    <tr>      
      <td width="150"><strong>Direccion</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['dir'].'</td>
    </tr>    
    <tr>      
      <td width="150"><strong>Comentario</strong></td>
    </tr>
    <tr>
        <td>'.$_POST['com'].'</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: '.$to . "\r\n";
$headers .= 'From: '.$_POST['nom'].' <'.$_POST['ema'].'>' . "\r\n";

// Mail it
    if(mail($to, $subject, $message, $headers)){
        echo "OK";
        $envio = "Y";
    }else{
        echo "OK";
        $envio = "N";
    }
    $datel = date("Y-m-d H:i:s");
    
    $paramsInsert = array(
        'id'=>NULL,
        'apellidos'=>  utf8_encode($_POST['ape']),
        'nombre'=>  utf8_encode($_POST['nom']),
        'email'=>utf8_encode($_POST['ema']),
        'telefono'=>utf8_encode($_POST['tel']),
        'direccion' =>utf8_encode($_POST['dir']),
        'comentario'=>utf8_encode($_POST['com']),
        'fecha'=>$datel,
        'estado' =>'I',
        'envioEmail'=>$envio

    );
    DbArgenper::insert('mimundo_contacto', $paramsInsert);   
}
?>
