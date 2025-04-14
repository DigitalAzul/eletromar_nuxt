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



    // se 1 entrega pra a home site

   // $sql = "SELECT * FROM animacoes ORDER BY ordem,id  DESC ";
    $sql = "SELECT a.*, sl.titulo AS categoria FROM animacoes AS a INNER JOIN solucao_linhas AS sl ON a.linha_id = sl.id ORDER BY ordem,id  DESC";

    try {
        $conn->query("SET lc_time_names = 'pt_BR'");
        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

        $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        $R['codigo'] = 0;
        $R['msg'] = "ok";
        $R['dados'] = $emparray;
        echo json_encode($R);
    } catch (\Throwable $th) {
        $R['codigo'] = 1;
        $R['msg'] = "erro";
        $R['dados'] = "";
        echo json_encode($R);
        exit;
    }




    //echo json_encode($emparray);
};




/// PARAM GRAVAR ARQUIVO
$PRE_FIXO = "BLOG_";
$MAX_size = 500000;
$ERROS = array();
$NOME_ARQ_TMP = array();
$BARRAS = "//"; // linux
//$BARRAS = "\\"; // windows

if ($isDev) {
    $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\anima\\';
} else {
    $uploaddir = dirname(__DIR__, 1) . "/media/anima/";
}

function gravaArquivoIO($id_blog)
{

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
        if ($path = $_FILES[0]) {

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






    //
    // IMAGEM PARA O CAPA
    //

    error_reporting(1);
    ini_set('display_errors', 1);
}



// APAGA ARQUIVOS
function delTree($dir)
{
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    global  $PRE_FIXO, $MAX_size, $ERROS, $NOME_ARQ_TMP, $isDev;




    if (isset($_POST))

        try {



            $emEdicao = $_POST['emEdicao'];





            // DELETE ANIMAÇÃO
            if ($emEdicao == "delete") {
                $id = $_POST['delete_id'];

                if (!$id) {
                    $R['codigo'] = 1;
                    $R['msg'] = "Erro ao inserir registro:";
                    $R['dados'] = "";
                    echo json_encode($R);
                }

                $sql = "SELECT * FROM animacoes WHERE id = $id ";
                $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

                $row = mysqli_fetch_assoc($result);
                $ordemCopy = $row['ordem'];


                // EXCLUI DO DB
                $sql_excluir = "DELETE FROM animacoes WHERE id = $id";
                $result2 = mysqli_query($conn, $sql_excluir) or die("Error in Selecting " . mysqli_error($connection));

                $emparray = array();

                $PASTA = $row['pasta'];


                try {
                    // echo($uploaddir);
                    // echo("___");
                    // echo($PASTA);
                    // exit;
                    //array_map('unlink', glob("$uploaddir/$PASTA/*.*"));
                    //rmdir("$uploaddir/$PASTA");
                    delTree("$uploaddir/$PASTA");
                    // delTree($uploaddir."atual".$BARRAS.$ordemCopy.$BARRAS);
                    foreach (glob($uploaddir . "atual" . $BARRAS . $ordemCopy . $BARRAS . "*.*") as $filename) {

                        unlink($filename);
                    }

                    $R['codigo'] = 0;
                    $R['msg'] = "Sucesso na exclusão";
                    $R['dados'] = "";
                    echo json_encode($R);
                    exit;
                    return;
                } catch (\Throwable $th) {
                    $R['codigo'] = 1;
                    $R['msg'] = "Erro ao excluir registro:";
                    $R['dados'] = "";
                    exit;
                    return;
                }


                exit;
            }







            $tituloEsq = $_POST['titulo_esquerdo'];
            $tituloDir = $_POST['titulo_direito'];

            $tituloEsq_en = $_POST['titulo_esquerdo_en'];
            $tituloEsq_es = $_POST['titulo_esquerdo_es'];
            $tituloDir_en = $_POST['titulo_direito_en'];
            $tituloDir_es = $_POST['titulo_direito_es'];

            $ativo = $_POST['ativo'];
            $linha_id = $_POST['linha_id'];
            $pasta = "0";
            $ordem = $_POST['ordem'];
            $translateEsq = $_POST['translateEsq'];
            $translateDir = $_POST['translateDir'];


            // INSERIR
            if ($emEdicao == "false") {



                $sql = "INSERT INTO animacoes (titulo_esquerdo, titulo_direito, ativo, ordem, pasta, translateEsq, translateDir, linha_id, titulo_esquerdo_en,titulo_esquerdo_es, titulo_direito_en, titulo_direito_es) 
            VALUES ('$tituloEsq', '$tituloDir', '$ativo', '$ordem', '$pasta', '$translateEsq', '$translateDir', '$linha_id','$tituloEsq_en','$tituloEsq_es','$tituloDir_en', '$tituloDir_es' )";


                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;



                    if (!file_exists($uploaddir . $last_id)) {
                        mkdir($uploaddir . $last_id, 0777, true);

                        foreach ($_FILES as $file) {

                            $uploadfilePath = $uploaddir . $last_id . $BARRAS . $file['name'];
                            move_uploaded_file($file['tmp_name'], $uploadfilePath);

                            // ANIMACAO ATUAL
                            if ($ordem == "1" or $ordem == "2" or $ordem == "3") {
                                $uploadfilePathAtual = $uploaddir . "atual" . $BARRAS .  $ordem . $BARRAS . $file['name'];
                                copy($uploadfilePath, $uploadfilePathAtual);
                            }
                        }

                        // ATUALIZA A TBL ANIMACOES CORRENTE
                        $sql = "UPDATE animacoes SET pasta='$last_id' WHERE id = $last_id";
                        $conn->query($sql);
                    }
                    // gravaArquivoIO($last_id);


                    //echo "Registro inserido com sucesso";
                    $R['codigo'] = 0;
                    $R['msg'] = "Registro inserido com sucesso";
                    $R['dados'] = "";
                    echo json_encode($R);
                } else {
                    $R['codigo'] = 1;
                    $R['msg'] = "Erro ao inserir registro:" . $conn->error;
                    $R['dados'] = "";
                    echo json_encode($R);
                    //echo "Erro ao inserir registro: " . $conn->error;
                };
                $conn->close();
            }


            // EDITAR
            if ($emEdicao == "true") {

                $id = $_POST['id'];

                // copy
                $sql = "SELECT * FROM animacoes WHERE id = $id ";
                $resultCopia = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

                $rowCopy = mysqli_fetch_assoc($resultCopia);

                $ordemCopy = $rowCopy['ordem'];
                $pastaID = $rowCopy['pasta'];

                // f1 = se ordem diferente ? apaga arq. da ordem futura > copy arq. da $pastaAtual pra odem futura : null 
                

                    if ($ordem != $rowCopy['ordem']) {
                        $pathAtual = $uploaddir . "atual" . $BARRAS . $ordemCopy . $BARRAS;
                        $pathPos = $uploaddir . "atual" . $BARRAS . $ordem . $BARRAS;

                        //
                        // EXCLUI DA PASTA ATUAL E PRA ONDE VAI
                        //
                        foreach (glob($pathAtual . "*.*") as $filename) {
                            //  echo "$filename size " . filesize($filename) . "\n";
                            unlink($filename);
                        }
                        foreach (glob($pathPos . "*.*") as $filename) {
                            //  echo "$filename size " . filesize($filename) . "\n";
                            unlink($filename);
                        }

                        //
                        // COPIA DA PASTA ID PRA A PASTA ATUAL
                        //
                        if ($ordem == "1" or $ordem == "2" or $ordem == "3") {
                            foreach (glob($uploaddir . $pastaID . $BARRAS . "*.*") as $filename) {
                                $file_ = str_replace($uploaddir . $pastaID . $BARRAS, "", $filename);
                                copy($filename, $uploaddir . "atual" . $BARRAS . $ordem . $BARRAS . $file_);
                            }

                        }

                }

                $sql = " UPDATE animacoes SET titulo_esquerdo='$tituloEsq', titulo_direito='$tituloDir', ativo='$ativo', ordem='$ordem', translateEsq='$translateEsq', translateDir='$translateDir', linha_id='$linha_id', titulo_direito_en='$tituloDir_en',titulo_direito_es='$tituloDir_es', titulo_esquerdo_en='$tituloEsq_en' , titulo_esquerdo_es='$tituloEsq_es'   WHERE id = $id ";

                if ($conn->query($sql) === TRUE) {
                    $R['codigo'] = 0;
                    $R['msg'] = "Sucesso na edição";
                    $R['dados'] = "";
                    echo json_encode($R);
                    exit;
                    return;
                } else {
                    $R['codigo'] = 1;
                    $R['msg'] = "Erro atualizando registro: " . $conn->error;
                    $R['dados'] = "";
                    echo json_encode($R);
                    exit;
                    return;
                }
            }
        } catch (Exception $e) {

            echo $e->getMessage();
        }
};



if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    echo "delete";
    if (isset($_DELETE)) {
        echo $_DELETE['delete_id'];
    }
    exit;

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
