<?php
    $counter = $_POST['counter'];
    if($counter == 1){
        $json['msg'] = 1;
        echo json_encode($json);
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }
?>
