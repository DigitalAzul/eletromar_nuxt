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


// ********** FUNCOES ***************
function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function apagaArquivos($arr_path)
{
    foreach ($arr_path as $arquivo) {
        ini_set('display_errors', 0);
        unlink($arquivo);
    }
    ini_set('display_errors', 1);
}

// ********** FUNCOES ***************


if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents('php://input'), true);

    $id = $_GET['id'];
    $titulo = $data['titulo'];
    $tituloEN = $data['tituloEN'];
    $tituloES = $data['tituloES'];
    $criado_em = $data['data'];
    $descricao = $data['descricao'];
    $descricaoEN = $data['descricaoEN'];
    $descricaoES = $data['descricaoES'];
    $categoria = $data['categoria'];
    $categoriaEN = $data['categoriaEN'];
    $categoriaES = $data['CategoriaES'];
    $tags = $data['tags'];

    $tituloEN = addslashes($tituloEN);
    $tituloES = addslashes($tituloES);
    $descricao = addslashes($descricao);
    $descricaoEN = addslashes($descricaoEN);
    echo $descricaoEN;
    exit;
    $descricaoES = addslashes($descricaoES);

    $tituloEN = htmlspecialchars($tituloEN, ENT_QUOTES);
    $tituloES = htmlspecialchars($tituloES, ENT_QUOTES);
    $descricao = htmlspecialchars($descricao, ENT_QUOTES);
    $descricaoEN = htmlspecialchars($descricaoEN, ENT_QUOTES);
    $descricaoES = htmlspecialchars($descricaoES, ENT_QUOTES);






    $sql = "UPDATE blog_posts SET titulo='$titulo', titulo_en='$tituloEN', titulo_es='$tituloES', criado_em='$criado_em', descricao='$descricao', descricao_en='$descricaoEN', descricao_es='$descricaoES', categoria='$categoria', categoria_en='$categoriaEN', categoria_es='$categoriaES', tags='$tags' WHERE id = $id";

    echo $sql;
    exit;

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
};

if ($_SERVER['REQUEST_METHOD'] == 'GET') {



    $whereQuery = "";
    $offset = "";
    $qpag = "";
    $xLimit = "";
    $tipoSql = 0; //0 = Normal 1 = destaqueHome
    $sql = "";

    if (isset($_GET['q'])) {

        if ($_GET['q'] == 'blog_home') {
            $tipoSql = 1;
        } else {
            $tipoSql = 0;
        }

        $q = htmlspecialchars($_GET['q'], ENT_QUOTES);
        
        if (isset($_GET['tag'])) {
            $tipoSql = 2;
        }
        
    }

    // PESQUISA POR UM CODIGO
    if (isset($_GET['c']) && $_GET['c'] != "") {
        $c = $_GET['c'];
        $whereQuery = "WHERE codigo = $c";
    }

    // PESQUISA POR UM ID
    if (isset($_GET['post']) && $_GET['post'] != "") {
        $post = $_GET['post'];
        $whereQuery = "WHERE bp.id = $post";
    }




    // PESQUISA POR UMA CATEGORIA ID
    if (isset($_GET['categoria_id']) && $_GET['categoria_id'] != "") {
        $cat = $_GET['categoria_id'];
        $whereQuery = "WHERE categoria_id = $cat";
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
        $sql = "SELECT *, DATE_FORMAT(criado_em,'%d de %M de %Y') AS data_br FROM blog_posts ORDER BY id DESC 
         $xLimit";
    } else {

        if ($tipoSql == 2) {
            $t = $_GET['tag'];
            $sql = "SELECT *, bp.*, ba.nome, ba.bio, ba.bio_en, ba.bio_es, ba.imagem AS imagem_autor, ba.social_instagram, ba.social_facebook, ba.social_linkedin,DATE_FORMAT(criado_em,'%d de %M de %Y') AS data_br
            FROM blog_posts AS bp
            LEFT JOIN blog_autor AS ba ON bp.blog_autor_id = ba.id 
            RIGHT JOIN tag_post AS tgp ON tgp.post_id = bp.id 
            WHERE tgp.tag_id = $t ORDER BY bp.id DESC ";
        }else{
            $sql = "SELECT *, bp.*, ba.nome, ba.bio, ba.bio_en, ba.bio_es, ba.imagem AS imagem_autor, ba.social_instagram, ba.social_facebook, ba.social_linkedin,DATE_FORMAT(criado_em,'%d de %M de %Y') AS data_br
            FROM blog_posts AS bp
            LEFT JOIN blog_autor AS ba ON bp.blog_autor_id = ba.id 
             $whereQuery ORDER BY bp.id DESC $xLimit";
        }

    }



    try {
        $conn->query("SET lc_time_names = 'pt_BR'");
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));
    } catch (\Throwable $th) {
        $R['codigo'] = 0;
        $R['msg'] = "ok" ;
        $R['dados'] = "";
        echo json_encode($R);
        exit;
    }



    $emparray = array();
    while ($row = mysqli_fetch_assoc($result)) {

        $idRow = $row['id'];
        // obtem as imagens
        $sqlImagens = "SELECT * FROM blog_imagens WHERE blog_id = $idRow";
        try {
            $resultImagens = mysqli_query($conn, $sqlImagens) or die("Error in Selecting " . mysqli_error($connection));

            $ImgArray = array();
            while ($rowI = mysqli_fetch_assoc($resultImagens)) {
                $ImgArray[] = $rowI;
            }
        } catch (\Throwable $th) {
        }

        //adiciona imagens
        if (count($ImgArray) > 0) {
            $row['imagens'] =  $ImgArray;
        } else {
            $row['imagens'] =  [];
        }

        // obtem tags
        $sqlTags = "SELECT * FROM tag_post WHERE post_id = $idRow";
        try {
            $resultTags = mysqli_query($conn, $sqlTags) or die("Error in Selecting " . mysqli_error($connection));
            $TagArray = array();
            while ($rowI = mysqli_fetch_assoc($resultTags)) {
                $TagArray[] = $rowI;
            }
            $row['tags'] = $TagArray;
        } catch (\Throwable $th) {
            var_dump($th);
        }
       



        // obtem comentarios
        $conn->query("SET lc_time_names = 'pt_BR'");
        $sqlComentarios = "SELECT *, DATE_FORMAT(criado_em,'%d DE %M DE %Y') AS data_br FROM comentarios WHERE blog_posts_id = $idRow  AND ativado = 1";
        try {
            $resultComentarios = mysqli_query($conn, $sqlComentarios) or die("Error in Selecting " . mysqli_error($connection));
            $ComentArray = array();
            $x = 0;
            while ($rowC = mysqli_fetch_assoc($resultComentarios)) {
                $ComentArray[] = $rowC;

                // add resposta

                // $idComen = $rowC['id'];
                // $sqlR = " SELECT * FROM comentario WHERE comentarios_id = $idComen";
                // $resultR = mysqli_query($conn, $sqlR) or die("Error in Selecting " . mysqli_error($connection));
                // $resposta = array();
                // while ($rowR = mysqli_fetch_assoc($resultR)) {
                //     $resposta[] = $rowR;
                // }
                // $ComentArray[$x]['resposta'] = $resposta;
                // $x++;
            }
        } catch (\Throwable $th) {
            echo $th;
        }



        // adiciona comentarios
        if (count($ComentArray) > 0) {
            $row['comentarios'] =  $ComentArray;
        } else {
            $row['comentarios'] =  [];
        }

        $emparray[] = $row;
    }





    $R['codigo'] = 0;
    $R['msg'] = "ok" . $conn->error;;
    $R['dados'] = $emparray;
    echo json_encode($R);
    //echo json_encode($emparray);
};




/// PARAM GRAVAR ARQUIVO
$PRE_FIXO = "BLOG_";
$MAX_size = 500000;
$ERROS = array();
$NOME_ARQ_TMP = array();

if ($isDev) {
    $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\blog\\';
} else {
    $uploaddir = dirname(__DIR__, 1) . "/media/blog/";
}

function gravaArquivoIO($id_blog){

  global  $PRE_FIXO, $MAX_size, $ERROS, $NOME_ARQ_TMP, $isDev, $uploaddir;




        if (!isset($_FILES)) {
            throw new RuntimeException('Sem arquivos !.');
        }
        // foreach ($_FILES as $arquivo) {
        //     if ($arquivo['size'] > $MAX_size) {
        //         echo $arquivo['size'];
        //         throw new RuntimeException('Arquivo com Tamanho Maior que 5M');
        //     }
        // }

        // agrava o arquivo no io

        //
        // IMAGEM PARA O BANNER
        //
        error_reporting(0);
        try {
            ini_set('display_errors', 0);
            ini_set('log_errors', false);
            if($path = $_FILES[0]){

                $path = $_FILES[0]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_0_BANNER' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_0_BANNER' . '.' . $ext;
                
                // IMAGEM PARA O BANNER
                $data = ["banner" => 1, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);
                
                move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);
            }
        } catch (\Throwable $th) {
        }
        try {
            if($path = $_FILES[1]){

                $path = $_FILES[1]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_1_BANNER' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_1_BANNER' . '.' . $ext;
                
                // IMAGEM PARA O BANNER
                $data = ["banner" => 1, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);
                
                move_uploaded_file($_FILES[1]['tmp_name'], $uploadfilePath);
            }
        } catch (\Throwable $th) {
        }
        try {
            if($path = $_FILES[2]){
                
                $path = $_FILES[2]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_2_BANNER' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_2_BANNER' . '.' . $ext;

                // IMAGEM PARA O BANNER
                $data = ["banner" => 1, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);

                move_uploaded_file($_FILES[2]['tmp_name'], $uploadfilePath);
            }
            } catch (\Throwable $th) {
        }


        //
        // IMAGEM PARA O MEIO TXT
        //
        try {
            if($path = $_FILES[3]){
                
                $path = $_FILES[3]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_3_MEIO' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_3_MEIO' . '.' . $ext;
                
                // IMAGEM PARA O BANNER
                $data = ["banner" => 0, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);
                
                move_uploaded_file($_FILES[3]['tmp_name'], $uploadfilePath);
            }
        } catch (\Throwable $th) {
        }
        try {
            if($path = $_FILES[4]){
                
                $path = $_FILES[4]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_4_MEIO' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_4_MEIO' . '.' . $ext;
                
                // IMAGEM PARA O BANNER
                $data = ["banner" => 0, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);
                
                move_uploaded_file($_FILES[4]['tmp_name'], $uploadfilePath);
            }
        } catch (\Throwable $th) {
        }
        //
        // IMAGEM PARA O CAPA
        //
        try {
            if($path = $_FILES[5]){
                
                $path = $_FILES[5]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $date = new DateTimeImmutable();
                $micro = (int)$date->format('U');
                $RAND = rand(1000000, 9999999);
                $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_5_CAPA' . '.' . $ext;
                $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog . '_5_CAPA' . '.' . $ext;

                // IMAGEM PARA O CAPA
                $data = ["banner" => 2, "name" => $uploadfile];
                
                array_push($NOME_ARQ_TMP, $data);
                
                move_uploaded_file($_FILES[5]['tmp_name'], $uploadfilePath);
            }
        } catch (\Throwable $th) {
            
        }
        error_reporting(1);
        ini_set('display_errors', 1);



        // try {
           
        //     for ($x = 0; $x < 6; $x++) {



        //         if (isset($_FILES[$x])) {
        //             $path = $_FILES[$x]['name'];
        //             $ext = pathinfo($path, PATHINFO_EXTENSION);
        //             $finfo = new finfo(FILEINFO_MIME_TYPE);


        //             $date = new DateTimeImmutable();
        //             $micro = (int)$date->format('U');
        //             $RAND = rand(1000000, 9999999);
        //             $uploadfilePath = $uploaddir . $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog  . '.' . $ext;
        //             $uploadfile = $PRE_FIXO . $micro . '_' . $RAND . '_' . $id_blog  . '.'.  $ext;
        //             $eHBanner = false;

        //             if ($x < 3) { //012
        //                 // IMAGEM PARA O BANNER
        //                 $data = ["banner" => 1, "name" => $uploadfile];
        //             } elseif ($x > 4) { //5
        //                 // IMAGEM PARA CAPA
        //                 $data = ["banner" => 2, "name" => $uploadfile];
        //             }
        //             // IMAGEM PARA MEIO DO BLOG
        //             else { //34
        //                 $data = ["banner" => 0, "name" => $uploadfile];
        //             }

        //             array_push($NOME_ARQ_TMP, $data);



        //             if (move_uploaded_file($_FILES[$x]['tmp_name'], $uploadfilePath)) {
        //             } else {

        //                 throw new RuntimeException('Possível ataque de upload de arquivo!\n');
        //             }
        //         } else {

        //             continue;
        //             throw new RuntimeException('for de 4>>\n ' . $x);
        //         }
        //     }
        // } catch (RuntimeException $e) {
        //     echo $e->getMessage();
        // }

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    global  $PRE_FIXO, $MAX_size, $ERROS, $NOME_ARQ_TMP, $isDev;


    


    if (isset($_POST['json']))
        $json = json_decode($_POST['json']);


    try {
        $titulo = $json->titulo;
        $tituloEN = $json->titulo_en;
        $tituloES = $json->titulo_es;
        $criado_em = $json->criado_em;
        $descricao = $json->descricao;
        $descricaoEN = $json->descricao_en;
        $descricaoES = $json->descricao_es;
        $categoria_id = $json->categoria_id;
        $blog_autor_id = $json->blog_autor_id;
        $tags = $json->tags;



        $titulo = addslashes($titulo);
        $tituloEN = addslashes($tituloEN);
        $tituloES = addslashes($tituloES);
        $descricao = addslashes($descricao);
        $descricaoEN = addslashes($descricaoEN);
        $descricaoES = addslashes($descricaoES);

        // $tituloEN = htmlspecialchars($tituloEN, ENT_QUOTES);
        // $tituloES = htmlspecialchars($tituloES, ENT_QUOTES);
        // $descricao = htmlspecialchars($descricao, ENT_QUOTES);
        // $descricaoEN = htmlspecialchars($descricaoEN, ENT_QUOTES);
        // $descricaoES = htmlspecialchars($descricaoES, ENT_QUOTES);



        if ($json->emEdicao == false) {

            $sql = " INSERT INTO blog_posts (titulo, titulo_en, titulo_es, criado_em, descricao, descricao_en, descricao_es, categoria_id, blog_autor_id) 
        VALUES ('$titulo', '$tituloEN', '$tituloES', '$criado_em', '$descricao', '$descricaoEN', '$descricaoES', $categoria_id, $blog_autor_id)";

            $eHbanner = null;
            // INSERI NO BLOG_IMAGENS
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;

                gravaArquivoIO($last_id);

                foreach ($NOME_ARQ_TMP as $path) {

                    $pathString = str_replace("\\", "\\", $path);
                    $pathArq = $pathString['name'];
                    //$eHbanner = $pathString['banner'];
                    if ($pathString['banner'] == 1) {
                        $eHbanner = 1;
                    } elseif ($pathString['banner'] == 2) {
                        $eHbanner = 2;
                    } else {
                        $eHbanner = 0;
                    }

                    $blogImgSql = "INSERT INTO blog_imagens (imagem_url,blog_id, tipo) VALUES ('$pathArq',$last_id, $eHbanner)";

                    $conn->query($blogImgSql);
                }



                foreach ($tags as $tg) {
                    $tagSql = "INSERT INTO tag_post (tag_id,post_id) VALUES ('$tg',$last_id)";
                    $conn->query($tagSql);
                }

                //echo "Registro inserido com sucesso";
                $R['codigo'] = 0;
                $R['msg'] = "Registro inserido com sucesso";
                $R['dados'] = "";
                echo json_encode($R);
            } else {
                $R['codigo'] = 1;
                $R['msg'] = "Erro ao inserir registro:" . $conn->error;;
                $R['dados'] = "";
                echo json_encode($R);
                //echo "Erro ao inserir registro: " . $conn->error;
            };
            $conn->close();

            ///
            /// else
            ///    
        } else {  // se > edita
            $id = $json->id;

            try {
                // EXCLUI ARQUIVOS QUE FORAM SUBSTITUIDOS
                foreach ($json->imgParaExcluir as $img) {

                    // exclui do banco
                    $blogImgSql = "DELETE FROM blog_imagens WHERE imagem_url = '$img'";
                    $conn->query($blogImgSql);

                   
                    //exclui do io
                    ini_set('display_errors', 0);
                    unlink($uploaddir . $img);
                }
                // inseri no banco blog_imagens
                gravaArquivoIO($id);
                foreach ($NOME_ARQ_TMP as $path) {

                    $pathString = str_replace("\\", "\\", $path);
                    $pathArq = $pathString['name'];
                    //$eHbanner = $pathString['banner'];
                    if ($pathString['banner'] == 1) {
                        $eHbanner = 1;
                    } elseif ($pathString['banner'] == 2) {
                        $eHbanner = 2;
                    } else {
                        $eHbanner = 0;
                    }

                    $blogImgSql = "INSERT INTO blog_imagens (imagem_url,blog_id, tipo) VALUES ('$pathArq',$id, $eHbanner)";

                    $conn->query($blogImgSql);
                }
            } catch (\Throwable $th) {
                echo $th;
            }




            // FAZ CÓPIA DA imagem ORIGINAL
            $sqlCopia = "SELECT * FROM blog_imagens WHERE blog_id= $id";
            $resultCopia = mysqli_query($conn, $sqlCopia) or die("Error in Selecting " . mysqli_error($connection));
            $emparrayCopia = array();
            while ($row = mysqli_fetch_assoc($resultCopia)) {
                $emparrayCopia[] = $row;
            }

            $sql = "UPDATE blog_posts SET titulo='$titulo', titulo_en='$tituloEN', titulo_es='$tituloES', criado_em='$criado_em', descricao='$descricao', descricao_en='$descricaoEN', descricao_es='$descricaoES', categoria_id='$categoria_id', blog_autor_id= '$blog_autor_id', tags='$tags' WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                try {
                    $deleteTags = "DELETE FROM tag_post WHERE post_id = $id";
                    $conn->query($deleteTags);
                } catch (\Throwable $th) {}

                try {
                    foreach ($tags as $tg) {
                        $tagSql = "INSERT INTO tag_post (tag_id,post_id) VALUES ('$tg',$id)";
                        $conn->query($tagSql);
                    }
                } catch (\Throwable $th) {}

                $R['codigo'] = 0;
                $R['msg'] = "Registro atualizado com sucesso";
                $R['dados'] = "";
                echo json_encode($R);
            } else {
                $R['codigo'] = 1;
                $R['msg'] = "Erro atualizando registro: " . $conn->error;
                $R['dados'] = "";
                echo json_encode($R);
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
};



if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM blog_posts WHERE id = $id";

    echo ($sql);

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }

    $conn->close();
};
