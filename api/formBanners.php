<?php

include_once("cnxdb.php");
include_once("param.php");


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

   return false;
   
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo 'GET';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //GRAVA ARQUIVOS
    if ($isDev) {
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\solucoes\\';
    } else {
        $uploaddir = dirname(__DIR__, 1) . "/img/";
    }



    $PRE_FIXO = "SOLUCOES_";
    $MAX_size = 1000000;
    $ERROS = array();
    $NOME_ARQ_TMP = array();


    if (isset($_FILES)) {

        if (isset($_FILES[0])) {
            $path = $_FILES[0]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES[0]['tmp_name']),

                array(
                    'jpg' => 'image/jpeg',
                    // 'png' => 'image/png',
                    // 'mp4' => 'video/mp4',
                    // 'webm' => 'video/webm'
                ),
                true
            )) {
                //throw new RuntimeException('Tipo de arquivo invalido (JPEG)');
                echo "Tipo de arquivo invalido (deve ser em JPEG)";
                return;
                
            }

            $uploadfilePath = $uploaddir . 'bg_banner_1' .'.'. $ext;

            try {
                ini_set('display_errors', false);
                unlink($uploadfilePath);


                move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);

                echo "Salvo com sucesso";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        if (isset($_FILES[1])) {
            $path = $_FILES[1]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES[1]['tmp_name']),

                array(
                    'jpg' => 'image/jpeg',
                    // 'png' => 'image/png',
                    // 'mp4' => 'video/mp4',
                    // 'webm' => 'video/webm'
                ),
                true
            )) {
                //throw new RuntimeException('Tipo de arquivo invalido (JPEG)');
                echo "Tipo de arquivo invalido (deve ser em JPEG)";
                return;
            }

            $uploadfilePath = $uploaddir . 'bg_banner_2' .'.'. $ext;

            try {
                ini_set('display_errors', false);
                unlink($uploadfilePath);


                move_uploaded_file($_FILES[1]['tmp_name'], $uploadfilePath);

                echo "Salvo com sucesso";
            } catch (\Throwable $th) {
                echo $th;
            }
        }
        if (isset($_FILES[2])) {
            $path = $_FILES[2]['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $finfo = new finfo(FILEINFO_MIME_TYPE);

            if (false === $ext = array_search(
                $finfo->file($_FILES[2]['tmp_name']),

                array(
                    'jpg' => 'image/jpeg',
                    // 'png' => 'image/png',
                    // 'mp4' => 'video/mp4',
                    // 'webm' => 'video/webm'
                ),
                true
            )) {
                //throw new RuntimeException('Tipo de arquivo invalido (JPEG)');
                echo "Tipo de arquivo invalido (deve ser em JPEG)";
                return;
            }

            $uploadfilePath = $uploaddir . 'bg_banner_3' .'.'. $ext;

            try {
                ini_set('display_errors', false);
                unlink($uploadfilePath);


                move_uploaded_file($_FILES[2]['tmp_name'], $uploadfilePath);

                echo "Salvo com sucesso";
            } catch (\Throwable $th) {
                echo $th;
            }
        }


    }
    

}