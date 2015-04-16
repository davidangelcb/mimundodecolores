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

require_once 'lib/Controller.php';

class Template extends Controller
{
    public function listar()
    {
        require_once("lib/load.php");
        $page =  $this->getParam('page'); 
        $limit = $this->getParam('rows'); 
        $sidx =  $this->getParam('sidx'); 
        $sord =  $this->getParam('sord');

        if(!$sidx) $sidx =1;
        
        $query = "SELECT COUNT(*) AS count from  argenper_template  where estado='E'";
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

        $SQL = "SELECT   id,  titulo, sms FROM    argenper_template where  estado='E'  ORDER BY $sidx $sord LIMIT $start , $limit"; 
        $giros = DbArgenper::fetchAll($SQL);//fetchAll
        
        $response->page = $page; 
        $response->total = $total_pages; 
        $response->records = $count; 
        $i=0;
        foreach($giros as $row){
            $response->rows[$i]['id']=$row['id']; 
            $response->rows[$i]['cell']=array($row['id'],$row['titulo'],$row['sms']); 
            $i++; 
        }
        return json_encode($response);
    }

    public function edit()
    {
        $response = array(
            'error' => 1,
            'message' => ''
        );
       require_once("lib/load.php"); 
        try {
            $id = (int)$this->getPost('id');
            $note = trim($this->getPost('note'));
            $titulo = trim($this->getPost('titulo')); 
            
            $template = DbArgenper::fetchOneBy('id = ?', 'argenper_template', null, $id);
            if (!$template) {
                throw new Exception('Row not exists');
            }
            
            $params = array(
                'sms' => $note,
                'titulo' => $titulo
            );
            DbArgenper::update('argenper_template', $params, 'id = ?', $id);

            $response['error'] = 0;
            $response['message'] = 'Se Actualizo el Item';
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }    
        
        return json_encode($response);        
    }
    
    public function add()
    {
        //  
        $response = array(
            'error' => 1,
            'message' => ''
        );
       require_once("lib/load.php"); 
        try {

            $note = trim($this->getPost('note'));
            $titulo = trim($this->getPost('titulo')); 
            $datel = date("Y-m-d H:i:s");
            
            $params = array(
                'id' => null,
                'fecha' => $datel,
                'sms' => $note,
                'titulo' => $titulo
            );
            DbArgenper::insert('argenper_template', $params);

            $response['error'] = 0;
            $response['message'] = 'Se Agrego el Item';
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }    
        
        return json_encode($response);                
    }
    
    public function del()
    {
        $response = array(
                    'error' => 1,
                    'message' => ''
        );
        require_once("lib/load.php"); 
        try {
            $coupon = DbArgenper::fetchOneBy('id = ' . (int)$this->getPost('id'), 'argenper_template');
            if (!$coupon) {
                throw new Exception('Row not exists');
            }

            $params = array(
                'estado' => 'D' 
            );
            DbArgenper::update('argenper_template', $params, 'id = ?', $coupon['id']);
            
            $response['error'] = 0;
            $response['message'] = 'Se elimino el Item';
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }    

        return json_encode($response);
                   
    }
}

$controller = new Template();
$controller->run();