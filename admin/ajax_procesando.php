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
    
    if($_GET["oper1"]=='listPro_'){
        
        
        // verifica identidad en base de datos
        require_once("lib/load.php");
        $page = $_GET['page']; // get the requested page 
        $limit = $_GET['rows']; // get how many rows we want to have into the grid 
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort 
        $sord = $_GET['sord']; // get the direction 

        if(!$sidx) $sidx =1;
        
        if(isset($_GET["cd_mask"])) 
            $nm_mask = $_GET['cd_mask']; 
        else 
            $nm_mask = "";
        
        $filtro = ""; 
        if($nm_mask!=''){ 
            $filtro.= " AND numero_giro LIKE '".$nm_mask."%'";
        }
         $query = "SELECT COUNT(*) AS count from  mimundo_contacto where   estado = 'A' ";
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
        
        $SQL = "select id, DATE_FORMAT(fechaarchivo,'%m-%d-%Y') as ingreso,apellidos, nombre, email,telefono,direccion,comentario from mimundo_contacto where estado='A'  ORDER BY $sidx $sord LIMIT $start , $limit"; 
        
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
?>