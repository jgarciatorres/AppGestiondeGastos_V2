<?php
$result = array(
    "estado" => "3",
    "mensaje" => "Ingresar parametros",
    "lista" => null,
    "paginacion" => null,
    "post" => $_POST,

);

if(isset($_POST['desde']) && isset($_POST["hasta"])){
    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
	if(is_numeric($desde) && is_numeric($hasta)){
        require_once('../../model/gasto_x.php');
        require_once('../../component/database.php');

        $mi_conexion = new database();
        $area=new gasto_x($mi_conexion->getCurrentConnection());
        $cantidad = 20;
        $data_area = $area->getGastoList($desde, $cantidad);
        $data_paginacion = $area->getGastoCount($cantidad);
        
		if(count($data_area) > 0 && count($data_paginacion) > 0){
            $data_area["paginacion"] =  $data_paginacion;
            echo json_encode($data_area);
        }else{
            $result = array(
                "estado" => "3",
                "mensaje" => "Error al buscar",
                "lista" => null,
                "paginacion" => null,
            );
            echo json_encode($result);
        }
    }else{
        $result = array(
            "estado" => "3",
            "mensaje" => "Los parametros no son numericos",
            "lista" => null,
            "paginacion" => null,
        );
        echo json_encode($result);
    }
}else{
    echo json_encode($result);
}
?>