<?php
    session_start();
    $logout = $_POST['logout'];
    if($logout == 1){
        $json['msg'] = 1;
        session_destroy();
        echo json_encode($json);
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }
?>
