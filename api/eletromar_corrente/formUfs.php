<?php

include_once("cnxdb.php"); 
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

    $sql = " UPDATE ufs SET titulo='$titulo' WHERE id = $id ";

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro atualizando registro: " . $conn->error;
    }
};








if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = json_decode($_POST['json']);

    if (1 == 2) { // FOI USADO PARA DA INICIO A TABELA
        foreach ($json as $uf) {
            $sql = " INSERT INTO ufs (estado,sigla) VALUES ('$uf->nome', '$uf->sigla')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro inserido com sucesso";
            } else {
                echo "Erro ao inserir registro: " . $conn->error;
            }
        }

        $sql = " INSERT INTO ufs (titulo) VALUES ('$titulo')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro inserido com sucesso";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
    }
};

if ($_SERVER['REQUEST_METHOD'] == 'GET') {


    $UF = array(
        (object) [
            'value' => 'AC',
            'label' => 'Acre'
        ],
        (object) [
            'value' => 'AL',
            'label' => 'Alagoas '
        ],
        (object) [
            'value' => 'AP',
            'label' => 'Amapá'
        ],
        (object) [
            'value' => 'AM',
            'label' => 'Amazonas'
        ],
        (object) [
            'value' => 'BA',
            'label' => 'Bahia'
        ],
        (object) [
            'value' => 'CE',
            'label' => 'Ceará'
        ],
        (object) [
            'value' => 'DF',
            'label' => 'Distrito Federal '
        ],
        (object) [
            'value' => 'ES',
            'label' => 'Espírito Santo'
        ],
        (object) [
            'value' => 'GO',
            'label' => 'Goiás'
        ],
        (object) [
            'value' => 'MA',
            'label' => 'Maranhão'
        ],
        (object) [
            'value' => 'MT',
            'label' => 'Mato Grosso'
        ],
        (object) [
            'value' => 'MS',
            'label' => 'Mato Grosso do Sul'
        ],
        (object) [
            'value' => 'MG',
            'label' => 'Minas Gerais'
        ],
        (object) [
            'value' => 'PA',
            'label' => 'Pará'
        ],
        (object) [
            'value' => 'PB',
            'label' => 'Paraíba'
        ],
        (object) [
            'value' => 'PR',
            'label' => 'Paraná'
        ],
        (object) [
            'value' => 'PE',
            'label' => 'Pernambuco'
        ],
        (object) [
            'value' => 'PI',
            'label' => 'Piauí'
        ],
        (object) [
            'value' => 'RJ',
            'label' => 'Rio de Janeiro'
        ],
        (object) [
            'value' => 'RN',
            'label' => 'Rio Grande do Norte'
        ],
        (object) [
            'value' => 'RS',
            'label' => 'Rio Grande do Sul'
        ],
        (object) [
            'value' => 'RO',
            'label' => 'Rondônia'
        ],
        (object) [
            'value' => 'RR',
            'label' => 'Roraima'
        ],
        (object) [
            'value' => 'SC',
            'label' => 'Santa Catarina'
        ],
        (object) [
            'value' => 'SP',
            'label' => 'São Paulo'
        ],
        (object) [
            'value' => 'SE',
            'label' => 'Sergipe'
        ],
        (object) [
            'value' => 'TO',
            'label' => 'Tocantins'
        ]

    );
      echo json_encode($UF);

    // $estados = array(
    //     'AC' => 'Acre',
    //     'AL' => 'Alagoas',
    //     'AP' => 'Amapá',
    //     'AM' => 'Amazonas',
    //     'BA' => 'Bahia',
    //     'CE' => 'Ceará',
    //     'DF' => 'Distrito Federal',
    //     'ES' => 'Espirito Santo',
    //     'GO' => 'Goiás',
    //     'MA' => 'Maranhão',
    //     'MS' => 'Mato Grosso do Sul',
    //     'MT' => 'Mato Grosso',
    //     'MG' => 'Minas Gerais',
    //     'PA' => 'Pará',
    //     'PB' => 'Paraíba',
    //     'PR' => 'Paraná',
    //     'PE' => 'Pernambuco',
    //     'PI' => 'Piauí',
    //     'RJ' => 'Rio de Janeiro',
    //     'RN' => 'Rio Grande do Norte',
    //     'RS' => 'Rio Grande do Sul',
    //     'RO' => 'Rondônia',
    //     'RR' => 'Roraima',
    //     'SC' => 'Santa Catarina',
    //     'SP' => 'São Paulo',
    //     'SE' => 'Sergipe',
    //     'TO' => 'Tocantins',
    // );
    
}
// if ($_SERVER['REQUEST_METHOD'] == 'GET') {

//     $sql = " SELECT id AS value, estado, sigla AS label  FROM ufs ORDER BY sigla";

//     $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

//     $emparray = array();
//     while ($row = mysqli_fetch_assoc($result)) {
//         $emparray[] = $row;
//     }

//     echo json_encode($emparray);
// };

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $id = $_GET['del'];

    $sql = " DELETE FROM ufs WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro apagado com sucesso";
    } else {
        echo "Erro ao tentar apagar registro: " . $conn->error;
    }
};
