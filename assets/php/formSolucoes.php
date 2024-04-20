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


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];
    $titulo = $data['titulo'];
    $codigo = $data['codigo'];
    $descricao = $data['descricao'];
    $descricaoEN = $data['descricaoEN'];
    $descricaoES = $data['descricaoES'];


    $sql = " UPDATE solucoes SET titulo='$titulo', codigo='$codigo', descricao='$descricao', descricao_en='$descricaoEN', descricao_es='$descricaoES' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    
  


    //GRAVA ARQUIVOS
      if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\solucoes\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/solucoes/";
    }

    
    $PRE_FIXO = "SOLUCOES_";
    $MAX_size = 500000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();

    for ($x = 0; $x <= 3; $x++) {
        if (isset($_FILES[$x])) {
            $path = $_FILES[$x]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES[$x]['tmp_name']),

                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'mp4' => 'video/mp4',
                    'webm' => 'video/webm'
                ),
                true
            )) {
                throw new RuntimeException('Tipo de arquivo invalido (JPEG, PNG)');
            }

            $date = new DateTimeImmutable();
            $micro = (int)$date->format('U');
            $RAND = rand(1000000,9999999);
            $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_'. $RAND .'.' . $ext;
            $uploadfile = $PRE_FIXO . $micro . '_'. $RAND .'.' .  $ext;

            $NOME_ARQ_TMP[$x] = $uploadfile;

            try {
                move_uploaded_file($_FILES[$x]['tmp_name'], $uploadfilePath);
            } catch (\Throwable $th) {
                echo $th;
            }

        }else{

            $NOME_ARQ_TMP[$x] = null;
        }
    }
    $json = json_decode($_POST['json']);


    $linha_id = $json->linha_id;
    $titulo = $json->titulo;
    $codigo = $json->codigo;
    $descricao = $json->descricao;
    $descricaoEN = $json->descricao_en;
    $descricaoES = $json->descricao_es;
    $destaque = $json->destaque;

    if($destaque == ""){
        $destaque = 0;
    }

    //INSERI A SOLUCAO
    if ($json->emEdicao == false) {
        var_dump($json);
        $sql = "INSERT INTO solucoes (linha_id, titulo, codigo, descricao, descricao_en, descricao_es, img_1, img_2, img_3, video_destaque, destaque) 
VALUES ('$linha_id', '$titulo', '$codigo', '$descricao', '$descricaoEN', '$descricaoES', '$NOME_ARQ_TMP[0]', '$NOME_ARQ_TMP[1]', '$NOME_ARQ_TMP[2]','$NOME_ARQ_TMP[3]', '$destaque')";



        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    //EDITA A SOLUCAO
    }else{ 
        $imagem = "";
        $cont = 0;
        $virgula = ",";
        $arrApagarImagemOrig = array();
        if(isset($NOME_ARQ_TMP[0])){
             $cont = 1;
             $imagem .= ", img_1='$NOME_ARQ_TMP[0]'";
             array_push($arrApagarImagemOrig, "img_1");
            }

        if(isset($NOME_ARQ_TMP[1])) {
            if($cont == 1) {
                $imagem .= $virgula . " img_2='$NOME_ARQ_TMP[1]'";
                $cont = 2;
                
            }
            else $imagem .= " img_2='$NOME_ARQ_TMP[1]'";   

            array_push($arrApagarImagemOrig, "img_2");
        }

        if(isset($NOME_ARQ_TMP[2])) {
             
             if($cont == 2) {
                $imagem .= $virgula . " img_3='$NOME_ARQ_TMP[2]'";
             }
             else $imagem .= " img_3='$NOME_ARQ_TMP[2]'";

             array_push($arrApagarImagemOrig, "img_3");
        }

        if(isset($NOME_ARQ_TMP[3])) {
             
            if($cont == 2 || $destaque != "") {
                $imagem .= $virgula . " video_destaque='$NOME_ARQ_TMP[3]'";
             }
             else $imagem .= " video_destaque='$NOME_ARQ_TMP[3]'";
 
             array_push($arrApagarImagemOrig, "video_destaque");
       }


        $id = $json->id;

        // FAZ CÓPIA DA SOLUCAO ORIGINAL
        $sqlCopia = "SELECT * FROM solucoes WHERE id= $id";
        $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
        $emparrayCopia = array();
        while ($row = mysqli_fetch_assoc($resultCopia)) {
            $emparrayCopia[] = $row;
        }

        //ATUALIZA SOLUCAO
        $sql = " UPDATE solucoes SET titulo='$titulo', codigo='$codigo', descricao='$descricao', descricao_en='$descricaoEN', descricao_es='$descricaoES', destaque='$destaque' $imagem WHERE id = $id ";

        try {
            if ($conn->query($sql) === TRUE) {
                echo "Registro atualizado com sucesso";
            } else {
                echo "Erro atualizando registro: " . $conn->error;
            }
        } catch (\Throwable $th) {
            echo "Erro atualizando registro: " . $th;
        }

        // EXCLUI ARQUIVOS
        try {
            foreach($arrApagarImagemOrig as $img) {
                ini_set('display_errors', false);
                unlink($uploaddir . $emparrayCopia[0][$img]);
            }
        } catch (\Throwable $th) {
            echo "Erro atualizando removendo arquivo: " . $th;
        } 

    }
};




if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $whereQuery = "";
    $offset = "";
    $qpag = "";
    $xLimit = "";
    $tipoSql = 0; //0 = Normal 1 = destaqueHome
    $linhaSolucaoId = null;

   
    if(isset($_GET['q'])) {

        if($_GET['q'] == 'destaque_home'){
            $tipoSql = 1;
        }elseif($_GET['q'] == 'destaqueLinha_home'){
            $tipoSql = 2;
            $linhaSolucaoId = $_GET['linha_id'];
        }elseif($_GET['q'] == 'solucao_detalhe'){
            $tipoSql = 3;
            $SolucaoId = $_GET['id'];
        }else{
            $tipoSql = 0;
        }

        $q = $_GET['q'];
        $whereQuery = "LOWER(titulo) LIKE LOWER('%$q%') OR LOWER(descricao) LIKE LOWER('%$q%')";
    }


    if(isset($_GET['c']) && $_GET['c'] != "") {
        $c = $_GET['c'];
        $whereQuery = "codigo = '$c'";
    }


    if(isset($_GET['offset'])) $offset = $_GET['offset'];
    if(isset($_GET['qpag'])) $qpag = $_GET['qpag'];
    


    if ($offset > -1 && $qpag > 0) {
        $xLimit = "LIMIT $offset, $qpag";
    } else {
        $xLimit = '';
    }
    
    // se 1 entrega pra a home site
    if($tipoSql == 1){
        $sql = "SELECT * FROM solucoes WHERE destaque = true $xLimit";
    }elseif($tipoSql == 2){
        $sql = "SELECT * FROM solucoes WHERE linha_id = $linhaSolucaoId  $xLimit";
    }elseif($tipoSql == 3){
        $sql = "SELECT * FROM solucoes WHERE id = $SolucaoId";
    }else{
        $sql = "SELECT * FROM solucoes WHERE $whereQuery $xLimit";
    }

  
    try {
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    } catch (\Throwable $th) {

    }
   

    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $emparray[] = $row;
    }

    echo json_encode($emparray);
};




if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM solucoes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};
