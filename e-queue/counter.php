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
    #container-form{
        background-color: #fff !important;
        width:300px;
        border: 1px solid black;
        padding: 25px;
        padding-top: 0px;
        margin: 100px auto;
    }
    input[type=text], textarea{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    .button{
        background-color: blue;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    .button-next{
        border-radius: 4px;
        box-shadow: 1px 2px 5px grey;
    }
</style>
</head>
<body>
    <ul>
        <li><a href="#home">HOME</a></li>
        <li><a href="#" id="queue">QUEUE</a></li>
        <li><a href="#" id="counter" style="background-color:#111">COUNTER</a></li>
        <li><a href="#" id="logout">LOGOUT</a></li>
        <li style="float:right"><a class="active" href="#about">Hello, <?php session_start(); echo $_SESSION['name']; ?></a></li>
    </ul>
    <div id="progress-bar"></div>
    <div id="container-form">
        <!-- <h1>COUNTER</h1> -->
        <br>
        <form method="post" id="form">
            <label for="queue_name">QUEUE NAME</label>
            <input type="hidden" id="users_id" name="users_id" autocomplete="OFF" value="<?php echo $_SESSION['id']; ?>">
            <input type="text" id="queue_name" name="queue_name" autocomplete="OFF">
            <label for="counter_many">COUNTER MANY</label>
            <input type="text" id="counter_many" name="counter_many" autocomplete="OFF">
            <label for="running_text">RUNNING TEXT</label>
            <textarea id="running_text" name="running_text" autocomplete="OFF" style="height:100px">
            </textarea>
            <button type="submit" id="submit" class="button button-next">SUBMIT</button>
        </form>

    </div>
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
                    $("#progress-bar").css("animation-play-state","running");
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

        $("#submit").on("click",function(e){
            e.preventDefault();
            var submit = 1;
            $.ajax({
                url: "toSubmit.php",
                type: "POST",
                data: $("#form").serialize(),
                beforeSend: function(data){

                },
                success: function(data){
                    var obj = JSON.parse(data);
                    if(obj.msg == 1){
                        alert("Counter has been added");
                    }else{

                    }
                }
            });
        });

        $("#queue").on("click",function(e){
            e.preventDefault();
            var users_id = $("#users_id").val();
            var queue = 1;
            $.ajax({
                url: "getQueue.php",
                type: "POST",
                data: {"users_id":users_id,"queue":queue},
                beforeSend: function(data){
                    //$("#counter").css("animation-play-state","running");
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    $("#progress-bar").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/welcome.php");
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
