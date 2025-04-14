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

    try {
        $data = json_decode(file_get_contents('php://input'), true);
        echo "put \n";
        var_dump($data);
        exit;
    } catch (Exception $e) {
        echo $e;
    }



    $id = $_GET['id'];
    $nome = $data["nome"];
    $bio = $data["bio"];
    $bioEN = $data["bioEN"];
    $bioES = $data["bioES"];
    $imagem = $data["imagem"];
    $socialInstagram = $data["socialInstagram"];
    $socialFacebook = $data["socialFacebook"];
    $socialLinkedin = $data["socialLinkedin"];


    $sql = "UPDATE blog_autor SET nome='$nome', bio='$bio', bio_en='$bioEN', bio_es='$bioES', social_instagram='$socialInstagram', social_facebook='$socialFacebook', social_linkedin='$socialLinkedin' WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
};





if ($_SERVER['REQUEST_METHOD'] == 'POST') {



    if($isDev){
        $uploaddir = 'C:\Users\x900l\Desktop\MECTRONIC\mectronic_nuxt\public\media\blog\\';
    }else{
        $uploaddir = dirname(__DIR__,1)."/media/blog/";
    }

    $PRE_FIXO = "BLOG_AUTOR_";

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

        try {
            move_uploaded_file($_FILES[0]['tmp_name'], $uploadfilePath);
        } catch (\Throwable $th) {
            echo "Erro ao inserir arquivo: " . $conn->error; 
        }
        
    }else{
        $uploadfile = "BLOG_AVATAR_PADRAO.png";
    }

    $json = json_decode($_POST['json']);
    // CHECA SE É PRA ADD OU ATUALIZAR
    if($json->emEdicao == false){

    //
    // ADD AUTOR
    //
    try {
        $nome = $json->nome;
        $bio = $json->bio;
        $bioEN = $json->bio_en;
        $bioES = $json->bio_es;
        $imagem = $uploadfile;
        $socialInstagram = $json->social_instagram;
        $socialFacebook = $json->social_facebook;
        $socialLinkedin = $json->social_linkedin;

        $sql = "INSERT INTO blog_autor (nome, bio, bio_en, bio_es, imagem, social_instagram, social_facebook, social_linkedin)
        VALUES ('$nome', '$bio', '$bioEN', '$bioES', '$imagem', '$socialInstagram', '$socialFacebook', '$socialLinkedin')";

        if ($conn->query($sql) === TRUE) {
            echo 'Inserido com sucesso';
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    } catch (\Throwable $th) {
        echo "Erro ao inserir registro: " . $conn->error;
    }
    // fim
    // ADD AUTOR
    //
    }else {
    //
    // UPD AUTOR
    //
    $id = $json->id;
    $nome = $json->nome;
    $bio = $json->bio;
    $bioEN = $json->bio_en;
    $bioES = $json->bio_es;
    $imagem = $uploadfile;
    $socialInstagram = $json->social_instagram;
    $socialFacebook = $json->social_facebook;
    $socialLinkedin = $json->social_linkedin;
    $sql = "UPDATE blog_autor SET nome='$nome', bio='$bio', bio_en='$bioEN', bio_es='$bioES', imagem='$imagem', social_instagram='$socialInstagram', social_facebook='$socialFacebook', social_linkedin='$socialLinkedin' WHERE id = $id";


    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
        ini_set('display_errors', false);
        unlink($uploaddir . $json->imagem);
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
    // fim
    // UPD AUTOR
    //
}
};


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    # TODOS OS AUTORES

        if (isset($_GET['todos'])) {

            $sql = " SELECT * FROM blog_autor ORDER BY id";

            $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

            $emparray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $emparray[] = $row;
            }
            
            $R['codigo'] = 0;
            $R['msg'] = "";
            $R['dados'] = $emparray; 
            echo json_encode($R);

        }


    # POR ID
    if (isset($_GET['porid'])) {

        $autorID = $_GET['porid'];
        $sql = " SELECT * FROM blog_autor WHERE id =  $autorID";

        $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

        $emparray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $row;
        }

        echo json_encode($emparray);
    }
};


if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM blog_autor WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};
