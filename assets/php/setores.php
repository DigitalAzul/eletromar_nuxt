<?php

include_once("cnxdb.php"); 
include_once("param.php"); 



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['json'])){
        $json = json_decode($_POST['json']);
    }else{
        $R['codigo'] = 1;
        $R['msg'] = "Parametros Incorretos";
        $R['dados'] = "";
    }

    if($json->label){
        $setor = $json->label;
        $setor = strtoupper($setor);

        $sql = " INSERT INTO setores (label) 
        VALUES ('$setor')";
        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Registro inserido com sucesso";
            $R['dados'] = ""; 
            echo json_encode($R);
        } else {
            $R['codigo'] = 1;
            $R['msg'] = "Erro ao inserir registro:  . $conn->error";
            $R['dados'] = ""; 
        }

    }

 }


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sql = " SELECT  s.*,  COUNT(c.setor) AS qtd from setores AS s LEFT JOIN curriculo AS c ON c.setor = s.id GROUP BY s.id";

    
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    if(count($emparray) > 0){
        $R['codigo'] = 0;
        $R['msg'] = "";
        $R['dados'] = $emparray;
    }else{
        $R['codigo'] = 1;
        $R['msg'] = "Sem registros" . $conn->error;
        $R['dados'] = "";
    }

    echo json_encode($R);

    exit;
}