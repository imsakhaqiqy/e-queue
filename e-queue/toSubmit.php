<?php
    include 'config.php';
    $users_id = $_POST['users_id'];
    $queue_name = $_POST['queue_name'];
    $counter_many = $_POST['counter_many'];
    $running_text = $_POST['running_text'];
    $sql = "INSERT INTO counter (queue_name,counter_many,running_text,users_id) VALUES ('$queue_name','$counter_many','$running_text','$users_id')";
    if($conn->query($sql) === TRUE){
        $json['msg'] = 1;
        echo json_encode($json);
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }
?>
