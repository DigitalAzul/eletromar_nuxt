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

    if(isset($_FILES)){

        $arqs = count($_FILES);
    }else{
        exit;
    }

    $json = json_decode($_POST['json']);


    //GRAVA ARQUIVOS
    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\galeria\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/galeria/";
    }

    $PRE_FIXO = "GALERIA_";
    $MAX_size = 500000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();


     for ($x = 0; $x < $arqs; $x++) {
         if (isset($_FILES[$x])) {
             $path = $_FILES[$x]['name'];
             $ext = pathinfo($path, PATHINFO_EXTENSION);
             $finfo = new finfo(FILEINFO_MIME_TYPE);

             if (false === $ext = array_search(
                 $finfo->file($_FILES[$x]['tmp_name']),

                 array(
                     'jpg' => 'image/jpeg',
                     'png' => 'image/png',
                 ),
                 true
             )) {
                 throw new RuntimeException('Tipo de arquivo invalildo (JPEG, PNG)');
             }


             $date = new DateTimeImmutable();
             $micro = (int)$date->format('U');
             $RAND = rand(1000000,9999999);
             $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_'. $RAND .'.' . $ext;
             $uploadfile = $PRE_FIXO . $micro . '_'. $RAND .'.' .  $ext;

             $NOME_ARQ_TMP[$x] = $uploadfile;

             if (move_uploaded_file($_FILES[$x]['tmp_name'], $uploadfilePath)) {
             } else {
                $R['codigo'] = 1;
                $R['msg'] = 'Possível ataque de upload de arquivo!\n';
                $R['dados'] = "";
                echo json_encode($R);
                 throw new RuntimeException('Possível ataque de upload de arquivo!\n');
             }

         }
     }



    //INSERIR A galeria
    if ($json->emEdicao == false) {

        foreach ($NOME_ARQ_TMP as $path) {

            $sql = "INSERT INTO galeria (img_url) VALUES ('$path')";

            $conn->query($sql);
        }

        $R['codigo'] = 0;
        $R['msg'] = "Upload concluido";
        $R['dados'] = "";
        echo json_encode($R);

       
    //EDITA A galeria
    } else {


        $id = $json->id_img;


        if($json->q == 'exc'){

            $sqlCopia = "SELECT * FROM galeria WHERE id = $id";
            $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
            $emparrayCopia = array();
            $row = mysqli_fetch_assoc($resultCopia);

            $sql = "DELETE FROM galeria WHERE id = $id ";

            try {
                if ($conn->query($sql) === TRUE) {

                    //exclui arquivo
                    ini_set('display_errors', false);
                    unlink($uploaddir . $row['img_url']);

                    $R['codigo'] = 0;
                    $R['msg'] = "Exclisão concluida";
                    $R['dados'] = "";
                    echo json_encode($R);
                } else {
                    $R['codigo'] = 1;
                    $R['msg'] =  $conn->error;
                    $R['dados'] = "";
                    echo json_encode($R);
                }
            } catch (\Throwable $th) {
                $R['codigo'] = 1;
                $R['msg'] =  $th;
                $R['dados'] = "";
                echo json_encode($R);
            }
        }

    }
    
};

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $whereQuery = "";
    $offset = "";
    $qpag = "";
    $xLimit = "";
    $tipoSql = 0; //0 = Normal 1 = destaqueHome

    if (isset($_GET['q'])) {


        if (isset($_GET['offset'])) $offset = $_GET['offset'];
        if (isset($_GET['qpag'])) $qpag = $_GET['qpag'];

    
        if ($offset > -1 && $qpag > 0) {
            $xLimit = "LIMIT $offset, $qpag";
        } else {
            $xLimit = '';
        }



        if ($_GET['q'] == 'galeria_home') {
            $tipoSql = 1;
        } else {
            $tipoSql = 0;
        }

        $q = htmlspecialchars($_GET['q'], ENT_QUOTES);
        if($tipoSql == 1){
            $sql = "SELECT * FROM galeria ORDER BY id ASC ";
        }else{
            $sql = "SELECT * FROM galeria ORDER BY id ASC $xLimit ";
        }
    }

    //$sql = "SELECT * FROM galeria LIMIT 12";
    $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        $R['codigo'] = 0;
        $R['msg'] = "Upload concluido";
        $R['dados'] = $emparray;
        echo json_encode($R);
   

};