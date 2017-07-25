<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    body{
        background-color: #ddd;
        font-family: Verdana,sans-serif;
    }
    ul{
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #0066CC;
        box-shadow: 1px 2px 5px grey;
    }
    li{
        float: left;
    }
    li a{
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    li a:hover:not(.active){
        background-color: #111;
    }
    .active{
        background-color: #0066CC;
        cursor:default;
        color:#fff;
    }
    #progress-bar{
        width:0%;
        height:5px;
        background-color: red;
        position: relative;
        animation-name: anim;
        animation-duration: 4s;
        animation-play-state: paused;
    }
    @keyframes anim {
        0% {background-color: red; width: 0%;}
        25% {background-color: red; width: 25%;}
        50% {background-color: red; width: 50%;}
        75% {background-color: red; width: 75%;}
        100% {background-color: red; width: 100%;}
    }
</style>
</head>
<body>
    <ul>
        <li><a href="#home" style="background-color:#111">HOME</a></li>
        <li><a href="#" id="queue">QUEUE</a></li>
        <li><a href="#" id="counter">COUNTER</a></li>
        <li><a href="#" id="logout">LOGOUT</a></li>
        <li style="float:right"><a class="active" href="#about">Hello,
            <?php
            $_SESSION['id'] = $_GET['id'];
            $_SESSION['name'] = $_GET['name'];
            echo $_SESSION['name'];
            ?>
        </a></li>
    </ul>
    <div id="progress-bar"></div>
    <input type="hidden" id="users_id" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" id="name" value="<?php echo $_SESSION['name']; ?>">
<script>
    $(document).ready(function(){
        $("#logout").on("click",function(e){
            e.preventDefault();
            var logout = 1;
            $.ajax({
                url: "getLogout.php",
                type: "POST",
                data: {"logout":logout},
                beforeSend: function(data){

                },
                success: function(data){
                    var obj = JSON.parse(data);
                    $("#loading").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/index.php");
                        }else{
                            //$("#submit").after("<p>Email or password not valid");
                        }
                    },4000);
                }
            });
        });

        $("#counter").on("click",function(e){
            e.preventDefault();
            var counter = 1;
            $.ajax({
                url: "getCounter.php",
                type: "POST",
                data: {"counter":counter},
                beforeSend: function(data){
                    //$("#counter").css("animation-play-state","running");
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    $("#progress-bar").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/counter.php");
                        }else{
                            //$("#submit").after("<p>Email or password not valid");
                        }
                    },4000);
                }
            });
        })

        $("#queue").on("click",function(e){
            e.preventDefault();
            var queue = 1;
            var usersId = $("#users_id").val();
            $.ajax({
                url: "getQueue.php",
                type: "POST",
                data: {"queue":queue,"users_id":usersId},
                beforeSend: function(data){
                    //$("#counter").css("animation-play-state","running");
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    $("#progress-bar").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/welcome.php?id="+obj.id+"&queue_name="+obj.queue_name+"&counter_many="+obj.counter_many+"&running_text="+obj.running_text+"&users_id"+obj.users_id);
                        }else{
                            //$("#submit").after("<p>Email or password not valid");
                        }
                    },4000);
                }
            });
        })



    });
</script>
</body>
</html>
