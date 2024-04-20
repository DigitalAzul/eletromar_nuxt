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

    $historia = $json->historia;
    $historiaEN = $json->historia_en;
    $historiaES = $json->historia_es;
    $missao = $json->missao;
    $visao = $json->visao;
    $valores = $json->valores;


    $historia = addslashes($json->historia);
    $historiaEN = addslashes($json->historia_en);
    $historiaES = addslashes($json->historia_es);
    $missao = addslashes($json->missao);
    $visao = addslashes($json->visao);
    $valores = addslashes($json->valores);





    //GRAVA ARQUIVOS
    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\empresa\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/empresa/";
    }

    $PRE_FIXO = "EMPRESA_";
    $MAX_size = 500000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();
    $imagem_url = "";

    if (isset($_FILES[0])) {
        $path = $_FILES[0]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        if (false === $ext = array_search(
            $finfo->file($_FILES[0]['tmp_name']),

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
        $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '.' . $ext;
        $uploadfile = $PRE_FIXO . $micro . '.' . $ext;

        $NOME_ARQ_TMP[0] = $uploadfile;

        try {
            move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    //INSERIR A SOLUCAO
    if ($json->emEdicao == false) {
        $sql = " INSERT INTO empresa (historia, historia_en, historia_es, img_url, missao, visao, valores ) 
            VALUES ('$historia','$historiaEN', '$historiaES', '$uploadfile', '$missao', '$visao', '$valores' ) ";


        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }


        //EDITA A SOLUCAO
    } else {
        $imagem = "";
        $cont = 0;
        $virgula = ",";
        $arrApagarImagemOrig = array();
        if (isset($NOME_ARQ_TMP[0])) {
            $cont = 1;
            $imagem .= ", img_url='$NOME_ARQ_TMP[0]'";
            array_push($arrApagarImagemOrig, "img_url");
        }

        $id = $json->id; 

        // FAZ CÓPIA DA SOLUCAO ORIGINAL
        $sqlCopia = "SELECT * FROM empresa WHERE id= $id";
        $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
        $emparrayCopia = array();
        while ($row = mysqli_fetch_assoc($resultCopia)) {
            $emparrayCopia[] = $row;
        }

        //ATUALIZA institucional
        $sql = " UPDATE empresa SET historia='$historia', historia_en='$historiaEN', historia_es='$historiaES' , missao='$missao', visao='$visao', valores='$valores'  $imagem WHERE id = $id ";

        try {
            if ($conn->query($sql) === TRUE) {
                // EXCLUI ARQUIVOS

                foreach ($arrApagarImagemOrig as $img) {
                    ini_set('display_errors', false);
                    unlink($uploaddir . $emparrayCopia[0]['img_url']);
                    ini_set('display_errors', true);
                }
                


                $R['codigo'] = 0;
                $R['msg'] = "Atualização concluída";
                $R['dados'] = "";
                echo json_encode($R);
            }
        } catch (\Throwable $th) {
            $R['codigo'] = 1;
            $R['msg'] = "Erro atualizando registro: " . $conn->error;
            $R['dados'] = "";
            echo json_encode($R);
          
        }
    }
}
