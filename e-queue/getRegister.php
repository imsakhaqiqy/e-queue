<?php
    include 'config.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $created_at = date('Y-m-d');
    $sql = "INSERT INTO users (name,email,password,created_at,updated_at) VALUES ('$name','$email','$password','$created_at','$created_at')";
    if($conn->query($sql) === TRUE){
        $json['msg'] = 1;
        echo json_encode($json);
    }else{
        $json['msg'] = 2;
        echo json_encode($json);
    }
?>
