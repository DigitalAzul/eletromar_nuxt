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



    $ano = $json->ano;
    $textoano = $json->texto_ano;
    $textoanoEN = $json->texto_ano_en;
    $textoanoES = $json->texto_ano_es;
    $imagemano = $json->imagem_ano;


    $textoano = addslashes($textoano);
    $textoanoEN = addslashes($textoanoEN);
    $textoanoES = addslashes($textoanoES);

    //GRAVA ARQUIVOS
    
    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\empresa\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/empresa/";
    }


    $PRE_FIXO = "EMPRESAANO_";
    $MAX_size = 500000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();

    for ($x = 0; $x <= 1; $x++) {
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
            $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '.' . $ext;
            $uploadfile = $PRE_FIXO . $micro . '.' . $ext;

            $NOME_ARQ_TMP[$x] = $uploadfile;

            if (move_uploaded_file($_FILES[$x]['tmp_name'], $uploadfilePath)) {
            } else {

                throw new RuntimeException('Possível ataque de upload de arquivo!\n');
            }
        }
    }
    //INSERIR A SOLUCAO
    if ($json->emEdicao == false) {
        $sql = " INSERT INTO empresa_ano (ano, texto_ano, texto_ano_en, texto_ano_es, imagem_ano) 
            VALUES ('$ano', '$textoano','$textoanoEN', '$textoanoES', '$NOME_ARQ_TMP[0]')  ";


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
            $imagem .= ", imagem_ano='$NOME_ARQ_TMP[0]'";
            array_push($arrApagarImagemOrig, "imagem_ano");
        }



        $id = $json->id;

        // FAZ CÓPIA DA SOLUCAO ORIGINAL
        $sqlCopia = "SELECT * FROM empresa_ano WHERE id= $id";
        $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
        $emparrayCopia = array();
        while ($row = mysqli_fetch_assoc($resultCopia)) {
            $emparrayCopia[] = $row;
        }


        //ATUALIZA empresa
        $sql = " UPDATE empresa_ano SET ano=$ano , texto_ano= '$textoano', texto_ano_en='$textoanoEN', texto_ano_es='$textoanoES' $imagem WHERE id = $id ";
        
        try {
            if ($conn->query($sql) === TRUE) {
                // EXCLUI ARQUIVOS
                try {
                    foreach ($arrApagarImagemOrig as $img) {
                        ini_set('display_errors', false);
                        unlink($uploaddir . $emparrayCopia[0]['imagem_ano']);
                        ini_set('display_errors', true);
                    }
                } catch (\Throwable $th) {
                }
                
                echo "Registro atualizado com sucesso";
            } else {
                echo "Erro atualizando registro: " . $conn->error;
            }
        } catch (\Throwable $th) {
            echo $sql;
        }
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $sqlEmpresa = "SELECT * FROM empresa";
    try {
        $resultEmpresa = mysqli_query($conn, $sqlEmpresa) or die("Error in Selecting " . mysqli_error($connection));
        $EmpresaArray = array();
        while ($rowI = mysqli_fetch_assoc($resultEmpresa)) {
            $EmpresaArray[] = $rowI;
        }
    } catch (\Throwable $th) {
    }

    $sqlEmpresaAno = "SELECT * FROM empresa_ano";
    try {
        $resultEmpresaAno = mysqli_query($conn, $sqlEmpresaAno) or die("Error in Selecting " . mysqli_error($connection));
        $EmpresaAnoArray = array();
        while ($rowI = mysqli_fetch_assoc($resultEmpresaAno)) {
            $EmpresaAnoArray[] = $rowI;
        }
    } catch (\Throwable $th) {
    }

    $R['codigo'] = 0;
    $R['dados']['empresa'] = $EmpresaArray;
    $R['dados']['empresa_ano'] = $EmpresaAnoArray;
    $R['msg'] = "";


    echo json_encode($R);
}
