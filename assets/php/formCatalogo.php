<?php

include_once("cnxdb.php"); 
include_once("param.php"); 



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);

    
    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\catalogos\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/catalogos/";
    }

    $titulo = $json->titulo;
    $pdf = $json->pdf;
    $imagem = $json->imagem;

    //GRAVA ARQUIVOS

    $PRE_FIXO = "CATALOGOS_";
    $MAX_size = 500000;
    $ARRAY_NOME_ARQ = array();

    foreach($_FILES as $key=>$f) {
        $path = $f['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $date = new DateTimeImmutable();
        $micro = (int)$date->format('U');
        $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '.' . $ext;
        $uploadfile = $PRE_FIXO . $micro . '.' . $ext;
        $ARRAY_NOME_ARQ[$key] = $uploadfile;
        echo $uploadfilePath;
        try {
            move_uploaded_file($f['tmp_name'], $uploadfilePath);
        } catch (\Throwable $th) {
            echo $th;
        }
        
      }


    $sql = " INSERT INTO catalogo (titulo, pdf, imagem ) VALUES ('$titulo', '$ARRAY_NOME_ARQ[0]', '$ARRAY_NOME_ARQ[1]')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro inserido com sucesso";
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
};





if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $sql = " SELECT * FROM catalogo";

    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);
};

if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){


    //var_dump($_GET['d']);

    $id = $_GET['d'];

    $sql = " SELECT * FROM catalogo WHERE id= $id";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }
    unlink($uploaddir . $emparray[0]['pdf']);
    unlink($uploaddir . $emparray[0]['imagem']);

    
    $sql = " DELETE FROM catalogo WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";

    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }


};