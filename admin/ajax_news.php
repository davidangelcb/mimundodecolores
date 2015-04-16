<?php

require_once("lib/config.php");
require_once("lib/funcs.php");
/*
 * FUNCTIONS
 */
if (!sessionValid()) {
    echo "Error Session Lost, Please Login Again";
    exit;
}



if (isset($_GET["oper1"])) {
    
    if($_GET["oper1"]=='listNews_'){

            require_once("lib/load.php");
            $page = $_GET['page']; // get the requested page 
            $limit = $_GET['rows']; // get how many rows we want to have into the grid 
            $sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
            $sord = $_GET['sord']; // get the direction 

            if(!$sidx) $sidx =1;

            $query = "SELECT COUNT(*) AS count from  mimundo_contacto where   estado = 'I' ";
            $dataTotal = DbArgenper::fetchOne($query);//

            $count = $dataTotal['count']; 
            if( $count >0 ) { 
                $total_pages = ceil($count/$limit); 
            } else { 
                $total_pages = 0; 
            }
            if ($page > $total_pages){ $page=$total_pages; }
            if( $count >0 ) { 
                $start = $limit*$page - $limit; // 
            }else{
                $start = 0; // do not put $limit*($page - 1) 
            }


            $SQL = "select id, DATE_FORMAT(fecha,'%m-%d-%Y') as ingreso,apellidos, nombre, email,telefono,direccion,comentario from mimundo_contacto where estado='I' ORDER BY $sidx $sord LIMIT $start , $limit"; 
            // Error: Tamaño mensaje(150)
            // Error: Verificacion Celular 
            // Error: Argenper Validacion 

            //$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
            $giros = DbArgenper::fetchAll($SQL);//fetchAll

            $response->page = $page; 
            $response->total = $total_pages; 
            $response->records = $count; 
            $i=0;
            foreach($giros as $row){
                $response->rows[$i]['id']=$row['id']; 
                $response->rows[$i]['cell']=array($row['ingreso'],$row['apellidos'],$row['nombre'],$row['email'],$row['telefono'],$row['comentario']); 
                $i++; 
            }

            echo json_encode($response);            
    }
    
}
if (isset($_POST["oper1"])) {
    
    if($_POST["oper1"]=='procesa'){

        require_once("lib/load.php");        
        $ids =  $_POST['ids'] ;
        $iduser=1;
        if(isset($_SESSION['UID'])){
            $iduser=$_SESSION['UID'];
        }
        $datel = date("Y-m-d H:i:s");
        $q = "update mimundo_contacto set fechaarchivo='".$datel."',iduser='".$iduser."',estado='A'  where id in (".$ids.")";
        DbArgenper::exec($q);
        echo "Done||";
 
    }
}    
?>
