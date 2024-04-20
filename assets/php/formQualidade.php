<?php

include_once("cnxdb.php"); 
include_once("param.php"); 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "mectronic";

// $conn = new mysqli(
//     $servername,
//     $username,
//     $password,
//     $database
// );

// if ($conn->connect_error) {
//     die("Conexão falhou: " . $conn->connect_error);
// };


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);

    $texto = $json->texto;
    $textoEN =  $json->texto_en;
    $textoES = $json->texto_es;

    $texto = addslashes($json->texto);
    $textoEN =  addslashes($json->texto_en);
    $textoES = addslashes($json->texto_es);

    $arq = $json->arquivo;


     if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\qualidade\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/qualidade/";
    }


    $PRE_FIXO = "QUALIDADE_";
    $MAX_size = 500000;
    $ARRAY_NOME_ARQ = array();
    $ARQUIVO = "";

    if (isset($_FILES[0])) {
        foreach ($_FILES as $key => $f) {
            $path = $f['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $date = new DateTimeImmutable();
            $micro = (int)$date->format('U');
            $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '.' . $ext;
            $uploadfile = $PRE_FIXO . $micro . '.' . $ext;
            $ARRAY_NOME_ARQ[$key] = $uploadfile;

            if (move_uploaded_file($f['tmp_name'], $uploadfilePath)) {
            } else {
                throw new RuntimeException('Possível ataque de upload de arquivo!\n');
            }
        }
        $ARQUIVO .= ", arquivo='$ARRAY_NOME_ARQ[0]'";
    } else {
        $ARQUIVO = "";
    }



    if ($json->emEdicao == false) {

        $sql = " INSERT INTO qualidade (texto, texto_en, texto_es, arquivo) VALUES ('$texto','$textoEN', '$textoES', '$ARRAY_NOME_ARQ[0]')";
        $msg = "Registro inserido com sucesso";
    } else {
        $id = $json->id;

         // FAZ CÓPIA DA imagem ORIGINAL
         $sqlCopia = "SELECT * FROM qualidade WHERE id = $id";
         $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
         $emparrayCopia = array();
         while ($row = mysqli_fetch_assoc($resultCopia)) {
             $emparrayCopia[] = $row;
         }


        //ATUALIZA institucional
        $sql = "UPDATE qualidade SET texto='$texto', texto_en='$textoEN', texto_es='$textoES' $ARQUIVO  WHERE id = $id ";
        $msg = "Registro Atualizado com sucesso";

         if($ARQUIVO != ""){
            ini_set('display_errors', false);
             unlink($uploaddir . $emparrayCopia[0]['arquivo']);
         }

       
    }


    if ($conn->query($sql) === TRUE) {
        $R['codigo'] = 0;
        $R['msg'] = $msg;
        $R['dados'] = "";
        echo json_encode($R);
    } else {
        $R['codigo'] = 0;
        $R['msg'] = "Erro ao inserir registro: " . $conn->error;
        $R['dados'] = "";
        echo json_encode($R);
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sql = " SELECT * FROM qualidade ";


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