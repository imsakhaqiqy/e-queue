<?php
    include 'config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT id,name,email,password FROM users WHERE email ='$email' AND password = '$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $json['msg'] = 1;
            $json['id'] = $row['id'];
            $json['name'] = $row['name'];
            echo json_encode($json);
        }
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }

?>
