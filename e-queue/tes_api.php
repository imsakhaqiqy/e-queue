<?php
    include 'config.php';
    $sql = "SELECT* FROM users WHERE id='$_POST[key]'";
    $result =  $conn->query($sql);
    $data = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($data,[
                'id'=>$row['id'],
                'name'=>$row['name'],
                'email'=>$row['email'],
                'password'=>$row['password'],
            ]);
            $json = $data;
            echo json_encode($json);
        }
    }else{
        $json['msg'] = 0;
        echo json_encode($json);
    }
?>
