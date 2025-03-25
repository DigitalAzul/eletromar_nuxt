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



    $json = json_decode($_POST['json']);


    $linha_id = $json->linha_id;
    $titulo = $json->titulo;
    $titulo_en = $json->titulo_en;
    $titulo_es = $json->titulo_es;
    $codigo = $json->codigo;
    $descricao = $json->descricao;
    $descricaoEN = $json->descricao_en;
    $descricaoES = $json->descricao_es;
    $destaque = $json->destaque;

    if ($destaque == "") {
        $destaque = 0;
    }


    // obtem pasta da linha
    $SQL_LINHA = "SELECT link as diretorio_linha FROM solucao_linhas WHERE id = $linha_id";


    try {
        $row = mysqli_query($conn, $SQL_LINHA);
        $diretorio_linha = mysqli_fetch_assoc($row);
       
    } catch (\Throwable $th) {
        echo $th;
        return false;
    }

    //CAMINHO DOS ARQUIVOS
    if ($isDev) {
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\solucoes\\';
    } else {
        $uploaddir = dirname(__DIR__, 1) . "/media/solucoes/";
    }

    $DIRETORIO_LINHA = $diretorio_linha['diretorio_linha'];

    if(is_dir($uploaddir.$DIRETORIO_LINHA)){

    }else{
        mkdir($uploaddir.$DIRETORIO_LINHA);
    }
    
    //CAMINHO DOS ARQUIVOS
    if ($isDev) {
        $uploaddir =  $uploaddir . $DIRETORIO_LINHA . '\\';
    } else {
        $uploaddir = $uploaddir . $DIRETORIO_LINHA . '/';
    }


    // ACRESCENTA O DIRETORIO DA LINHA AO UPLOADDIR
   // $uploaddir = $uploaddir . $DIRETORIO_LINHA . "";


   

    $PRE_FIXO = "SOLUCOES_";
    $MAX_size = 1000000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();


    
    for ($x = 0; $x <= 4; $x++) {
        if (isset($_FILES[$x])) {
            $path = $_FILES[$x]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES[$x]['tmp_name']),

                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'webp' => 'image/webp',
                    'mp4' => 'video/mp4',
                    'webm' => 'video/webm',
                    'dwg' => 'image/x-dwg',
                    'dxf' => 'image/x-dxf',
                    'dwf' => 'drawing/x-dwf',
                    'pdf' => 'application/pdf'
                ),
                true
            )) {
                throw new RuntimeException('Tipo de arquivo invalido (JPEG, PNG)');
            }

            $date = new DateTimeImmutable();
            $micro = (int)$date->format('U');
            $RAND = rand(1000000, 9999999);
            // $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '.' . $ext;
            // retirado pra fazer a alterão abaixo >> $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '.' .  $ext;

            // ALTERAÇÃO PARA FIXAR OS NOMES DOS ARQUIVOS DA SOLUÇÃO
            //Produtos, peças: 
            // 1.  cod_0.xxx (imagem)
            // 2.  cod_1.xxx  (imagem)
            // 3.  cod_2.xxx  (imagem)
            // 4. cod_3.xxx  (vídeo)

            //retirado em 19/02/2024 fazendo o arquivo DWG
            $uploadfile = $codigo . "_" . $x . "." . $ext;

            $uploadfilePath = $uploaddir . $codigo . "_" . $x . "." . $ext;
            $NOME_ARQ_TMP[$x] = $uploadfile;

           

            try {
               move_uploaded_file($_FILES[$x]['tmp_name'], $uploadfilePath);

            } catch (\Throwable $th) {
                echo $th;
            }
        } else {

            $NOME_ARQ_TMP[$x] = null;
        }
    }






    //INSERI A SOLUCAO
    if ($json->emEdicao == false) {

        $sql = "INSERT INTO solucoes (linha_id, titulo,titulo_en,titulo_es, codigo, descricao, descricao_en, descricao_es, img_1, img_2, img_3, destaque, dwg) 
VALUES ('$linha_id', '$titulo','$titulo_en', '$titulo_es','$codigo', '$descricao', '$descricaoEN', '$descricaoES', '$NOME_ARQ_TMP[0]', '$NOME_ARQ_TMP[1]', '$NOME_ARQ_TMP[2]', '$destaque', '$NOME_ARQ_TMP[4]')";



        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
        //EDITA A SOLUCAO
    } else {
        $imagem = ",";
        $cont = 0;
        $virgula = ",";
        $arrApagarImagemOrig = array();
        if (isset($NOME_ARQ_TMP[0])) {
            $cont = 1;
            $imagem .= " img_1='$NOME_ARQ_TMP[0]'";
            array_push($arrApagarImagemOrig, "img_1");
        }

        if (isset($NOME_ARQ_TMP[1])) {
            if ($cont > 0) {
                $imagem .= $virgula . " img_2='$NOME_ARQ_TMP[1]'";
                $cont = 2;
            } else $imagem .= " img_2='$NOME_ARQ_TMP[1]'";

            $cont += 1;
            array_push($arrApagarImagemOrig, "img_2");
        }

        if (isset($NOME_ARQ_TMP[2])) {

            if ($cont > 0) {
                $imagem .= $virgula . " img_3='$NOME_ARQ_TMP[2]'";
               
            } else $imagem .= " img_3='$NOME_ARQ_TMP[2]'";

            $cont += 1;
            array_push($arrApagarImagemOrig, "img_3");
        }


        // RETIRADO EM 30 10 2024
        //if (isset($NOME_ARQ_TMP[3])) {

        //    if ($cont > 0 ) {
        //        $imagem .= $virgula . " video_destaque='$NOME_ARQ_TMP[3]'";
              
        //    } else $imagem .= " video_destaque='$NOME_ARQ_TMP[3]'";

        //    $cont += 1;
        //    array_push($arrApagarImagemOrig, "video_destaque");
        //}

        if (isset($NOME_ARQ_TMP[4])) {

            if ($cont > 0 ) {
                $imagem .= $virgula . " dwg='$NOME_ARQ_TMP[4]'";
            } else $imagem .= " dwg='$NOME_ARQ_TMP[4]'";

       echo $imagem;
            array_push($arrApagarImagemOrig, "dwg");
        }


        // PROTEGE CASO NÃO SEJA ENVIADO UMA IMAGEM
        if($imagem == ","){
            $imagem = "";
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
        $sql = " UPDATE solucoes SET titulo='$titulo', titulo_en='$titulo_en',titulo_es='$titulo_es', codigo='$codigo', descricao='$descricao', descricao_en='$descricaoEN', descricao_es='$descricaoES', destaque='$destaque' $imagem WHERE id = $id ";

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
        // retirado depois de definido que os nomes são os CODIGOS dos produtos 
        // try {
        //     ini_set('display_errors', 0);
        //     foreach ($arrApagarImagemOrig as $img) {
        //         ini_set('display_errors', false);
        //         unlink($uploaddir . $emparrayCopia[0][$img]);
        //     }
        // } catch (\Throwable $th) {
        //     echo "Erro atualizando removendo arquivo: " . $th;
        // }
    }
};




if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $whereQuery = "";
    $offset = "";
    $qpag = "";
    $xLimit = "";
    $tipoSql = 0; //0 = Normal 1 = destaqueHome
    $linhaSolucaoId = null;


    if (isset($_GET['q'])) {

        if ($_GET['q'] == 'destaque_home') {
            $tipoSql = 1;
        } elseif ($_GET['q'] == 'destaqueLinha_home') {
            $tipoSql = 2;
            $linhaSolucaoId = $_GET['linha_id'];
        } elseif ($_GET['q'] == 'solucao_detalhe') {
            $tipoSql = 3;
            $SolucaoId = $_GET['id'];
        } else {
            $tipoSql = 0;
        }

        $q = $_GET['q'];
        $whereQuery = "LOWER(s.titulo) LIKE LOWER('%$q%') OR LOWER(s.descricao) LIKE LOWER('%$q%') ";
    }


    if (isset($_GET['c']) && $_GET['c'] != "") {
        $c = $_GET['c'];
        $whereQuery = "codigo = '$c'";
    }


    if (isset($_GET['offset'])) $offset = $_GET['offset'];
    if (isset($_GET['qpag'])) $qpag = $_GET['qpag'];



    if ($offset > -1 && $qpag > 0) {
        $xLimit = "LIMIT $offset, $qpag";
    } else {
        $xLimit = '';
    }

    // se 1 entrega pra a home site
    if ($tipoSql == 1) {
        //$sql = "SELECT s.*, sl.link, sl.titulo AS titulo_linha, sl.descricao AS descricao_linha FROM solucoes AS s LEFT JOIN solucao_linhas AS sl ON s.linha_id = sl.id WHERE s.destaque = true $xLimit";
        $sql = "select * from solucao_linhas ORDER BY ordem ASC $xLimit";

    } elseif ($tipoSql == 2) {
        $sql = "SELECT s.*, sl.link FROM solucoes AS s LEFT JOIN solucao_linhas AS sl ON s.linha_id = sl.id WHERE s.linha_id = $linhaSolucaoId  ORDER BY ordem ASC $xLimit";
    } elseif ($tipoSql == 3) {
        $sql = "SELECT s.*, sl.link FROM solucoes AS s LEFT JOIN solucao_linhas AS sl ON s.linha_id = sl.id WHERE s.id = $SolucaoId ORDER BY ordem ASC";
    } else {
        $sql = "SELECT s.*, sl.link FROM solucoes AS s LEFT JOIN solucao_linhas AS sl ON s.linha_id = sl.id WHERE $whereQuery ORDER BY ordem ASC $xLimit";
    }


    $emparray = array();
    try {
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }
    } catch (\Throwable $th) {
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
