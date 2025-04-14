<?php
include_once("cnxdb.php");
include_once("param.php");



ini_set('auto_detect_line_endings',TRUE);
$handle = fopen('in_ordem_linhas_eletromar.csv','r');
while ( ($data = fgetcsv($handle, 1000, ",") ) !== FALSE ) {

    // echo('ID');
    // print_r($data[0]);
    // echo('ORDEM');
    // print_r($data[3]);
    // echo("\n");

    $sql = "UPDATE solucao_linhas SET ordem='$data[3]' WHERE id = $data[0]";
    
    if ($conn->query($sql) === TRUE) {
        $R['codigo'] = 0;
        $R['msg'] = "Tag registrada com sucesso!";
        $R['dados'] = '';
        echo json_encode($R); 
    }
    
    
    //$sql = "SELECT id, ordem FROM solucao_linhas";
    // $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($connection));

    // $emparray = array();
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $emparray[] = $row;
    // }

    // $R['codigo'] = 0;
    // $R['msg'] = "";
    // $R['dados'] = $emparray;
    // echo json_encode($R);

}
ini_set('auto_detect_line_endings',FALSE);
?>