<?php

include_once("cnxdb.php");
include_once("param.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);

    $exe = $json->exe;
    $linha_id = $json->linha_id;



    //CAMINHO DOS ARQUIVOS
    if ($isDev) {
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\solucoes\\';
    } else {
        $uploaddir = dirname(__DIR__, 1) . "/media/solucoes/";
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

    $DIRETORIO_LINHA = $diretorio_linha['diretorio_linha'];

    if(is_dir($uploaddir.$DIRETORIO_LINHA)){

    }else{
        mkdir($uploaddir.$DIRETORIO_LINHA);
    }




    if (isset($_FILES[0])) {
        $path = $_FILES[0]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $finfo = new finfo(FILEINFO_MIME_TYPE);

        // File Type Validation
        if (empty($ext) || $ext != 'csv') {
            $R['codigo'] = 1;
            $R['msg'] = "Arquivo inválido";
            $R['dados'] = "";
            return json_encode($R);
        }

        // Declare the delimiter
        $delimiter = '&';
        // Open the file in read mode
        $csv = fopen($_FILES[0]['tmp_name'], 'r');

        $rows = array();
        $row_number = 0;


        
        while ($csv_row = fgetcsv($csv, 0, $delimiter)) {
            
            // Increment Row Number
            $row_number++;
            
            // Optional
            $encoded_row = array_map('utf8_encode', $csv_row);
            

            if($csv_row[3] == ""){
                $R['codigo'] = 1;
                $R['msg'] = "Erro, há produto sem código!";
                $R['dados'] = "";
                echo json_encode($R);
                exit;
            }

                // valida o codigo
                $SQL = "SELECT id from solucoes WHERE codigo = '$csv_row[3]'";

                try {
                    $result = mysqli_query($conn, $SQL);
                    $regs = mysqli_num_rows($result);
                    if($regs > 0 ){
                        array_push($csv_row,"duplicado");
                       
                    }

                } catch (\Throwable $th) {
                    echo $th;
                    return false;
                }

            $rows[] = $csv_row;
        }



        if ($exe == "validar") {

            $R['codigo'] = 0;
            $R['msg'] = "";
            $R['dados'] = $rows;
            echo json_encode($R);
        }


        if ($exe == "salvar") {

            $inseridos = 0;
            $X = count($rows);

            for ($x = 0; $x < $X; $x++) {

              
               
                $titulo = $rows[$x][0];
                $tituloEN = $rows[$x][1];
                $tituloES = $rows[$x][2];
                $codigo = $rows[$x][3];
                $descricao = $rows[$x][4];
                $descricaoEN = $rows[$x][5];
                $descricaoES = $rows[$x][6];

                $destaque = 0;



                ini_set('display_errors', 0);
                // FORMATA OS NOMES DOS ARQUIVOS DE IMAGENS
                try {
                    $NOME_ARQ_TMP[0] = $rows[$x][7];
                } catch (\Throwable $th) {
                    $NOME_ARQ_TMP[0] = "";
                }

                try {
                    $NOME_ARQ_TMP[1] = $rows[$x][8];
                } catch (\Throwable $th) {
                    $NOME_ARQ_TMP[1] = "";
                }

                try {
                    $NOME_ARQ_TMP[2] = $rows[$x][9];
                } catch (\Throwable $th) {
                    $NOME_ARQ_TMP[2] = "";
                }


                // ERA VIDEO DESTAQUE
               // try {
               //     $NOME_ARQ_TMP[3] = $codigo . "_" . 3 . "." . "webm";
               // } catch (\Throwable $th) {
               //     $NOME_ARQ_TMP[3] = "";
               // }



                // $NOME_ARQ_TMP[0] = $rows[$x][8] ?  $rows[$x][8]: ""; // $codigo . "_" . 0 . "." . "png";
                // $NOME_ARQ_TMP[1] = $rows[$x][9] ?  $rows[$x][9]: ""; // $codigo . "_" . 1 . "." . "png";
                // $NOME_ARQ_TMP[2] = $rows[$x][10] ?  $rows[$x][10]: ""; // $codigo . "_" . 2 . "." . "png";
                // $NOME_ARQ_TMP[3] = $rows[$x][8] ?  $codigo . "_" . 3 . "." . "webm" : "";


                // valida o codigo
                $SQL = "SELECT id from solucoes WHERE codigo = '$codigo'";

                try {
                    $result = mysqli_query($conn, $SQL);

                    $regs = mysqli_num_rows($result);


                    if($regs > 0 ){                      
                        continue;
                       
                    }else{
                        $sql = "INSERT INTO solucoes (linha_id, titulo, titulo_en, titulo_es, codigo, descricao, descricao_en, descricao_es, img_1, img_2, img_3, destaque) 
                        VALUES ('$linha_id', '$titulo', '$tituloEN', '$tituloES', '$codigo', '$descricao', '$descricaoEN', '$descricaoES', '$NOME_ARQ_TMP[0]', '$NOME_ARQ_TMP[1]', '$NOME_ARQ_TMP[2]', '$destaque')";

                        if ($conn->query($sql) === TRUE) {

                            $inseridos +=1;
                        }else{
                            echo $conn->error;
                            exit;
                        }
                    }

                } catch (\Throwable $th) {
                    $R['codigo'] = 1;
                    $R['msg'] = "Erro " . $th;
                    $R['dados'] = "";
                    echo json_encode($R);
                    exit;
                }
            }
            $R['codigo'] = 0;
            $R['msg'] = "Registros inseridos " . $inseridos;
            $R['dados'] = "";
            echo json_encode($R);
        }

    }
}


function validaCodigo($codigo){

}