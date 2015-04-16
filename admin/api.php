<?php
//extract data from the post



//OK 1757116
//$url  = file_get_contents("http://api.mensajesonline.pe/sendsms?app=webservices&u=argenper_sms&p=Arg3np3rSMS2014&to=952303639&msg=hola%20desde%20api");
//$status  = file_get_contents("http://api.mensajesonline.pe/sendsms?app=webservices&ta=ds&u=argenper_sms&p=Arg3np3rSMS2014&slid=".$id_sms);
      $url = file_get_contents("https://api.mensajesonline.pe/sendsms?app=webservices&ta=ds&u=argenper_sms&p=Arg3np3r8M82014&slid=1759390");
 print_r($url);

?>
