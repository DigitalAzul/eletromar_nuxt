<?php

include_once("cnxdb.php");
include_once("param.php");


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $tipoSql = "";

    if (isset($_GET['q'])) {

        if ($_GET['q'] == 'formBlog') {
            $tipoSql = 1;
        } else {
            $tipoSql = 0;
        }
    }

    if($tipoSql == 1){
        $sql = "SELECT * FROM tags";
    }else{
        $sql = "SELECT DISTINCT tg.*, tp.tag_id FROM tags AS tg RIGHT JOIN tag_post AS tp ON tg.id = tp.tag_id";
    }

    try {
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
        $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }
        $R['codigo'] = 0;
        $R['msg'] = "";
        $R['dados'] = $emparray;
        echo json_encode($R);
    } catch (\Throwable $th) {
        $R['codigo'] = 1;
        $R['msg'] = $th;
        $R['dados'] = "";
        echo json_encode($R);
    }
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['json']))
        $json = json_decode($_POST['json']);


    $titulo = $json->titulo;
    $tituloEN = $json->titulo_en;
    $tituloES = $json->titulo_es;


    if ($json->emEdicao == false) {
        $sql = " INSERT INTO tags (titulo, titulo_en, titulo_es) 
        VALUES ('$titulo', '$tituloEN', '$tituloES')";


        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Tag registrada com sucesso!";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        } else {
            $R['codigo'] = 1;
            $R['msg'] = "Erro no registro da Tag";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }
    }

    // UPADATE
    if ($json->emEdicao == true) {
        $id = $json->id;

        $sql = "UPDATE tags SET titulo='$titulo', titulo_en='$tituloEN', titulo_es='$tituloES'
        WHERE id = $id";


        if ($conn->query($sql) === TRUE) {
            $R['codigo'] = 0;
            $R['msg'] = "Tag registrada com sucesso!";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        } else {
            $R['codigo'] = 1;
            $R['msg'] = "Erro no registro da Tag";
            $R['dados'] = "";
            echo json_encode($R);
            exit;
        }
    }

}
