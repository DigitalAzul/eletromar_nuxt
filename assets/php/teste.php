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

try {
    $stmt = $conn->prepare('INSERT INTO psociais (texto) VALUES(:nome)');
    $stmt->execute(array(
      ':nome' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
    ));
  
    echo $stmt->rowCount();
  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }  