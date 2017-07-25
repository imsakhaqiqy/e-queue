<?php
    include 'config.php';
    $users_id = $_POST['users_id'];
    $sql = "SELECT * FROM counter WHERE users_id='$users_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $json['msg'] = 1;
            $json['id'] = $row['id'];
            $json['queue_name'] = $row['queue_name'];
            $json['counter_many'] = $row['counter_many'];
            $json['running_text'] = $row['running_text'];
            $json['users_id'] = $row['users_id'];
            echo json_encode($json);
        }
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }
?>
