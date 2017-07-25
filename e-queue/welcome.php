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
        background-color: #0066CC;
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
    #header-line{
        border: none;
    }
    #tag-line{
        margin: 20px auto;
        text-align: left;
        border: 1px solid #fff;
        width: 25%;
        border: none;
        color: #fff;
    }
    #running-text{
        margin: 20px auto;
        width: 70%;
        border: 1px solid #fff;
        margin-right: 20px;
        border: none;
    }
    #container-header{
        border: none;
    }
    #content-queue-one{
        margin: 20px auto;
    }
    #iframe{
        margin: 20px auto;
        margin-right: 20px;
        width: 70%;
        height: 300px;

    }
    .flex-container {
        display: -webkit-flex;
        display: flex;
        width: 100%;
        height: auto;
        background-color: #0066CC;
        flex-wrap: wrap;
        justify-content: center;
        border-top: 1px solid #fff;
    }
    .content-queue{
        background-color: #0066CC !important;
        width:25%;
        border: 1px dashed #fff;
        padding: 10px;
        padding-top: 0px;
        margin: 10px;
    }
    #number{
        width: 30%;
        border: 1px solid black;
        background-color: red;
        margin: 20px auto;
        position: relative;
        text-align: center;
        padding: 20px 20px;
        color: #fff;
        font-size: 30px;
    }
    #content-loading{
        width: 100%;
        box-sizing: border-box;
    }
    #loading{
        width:20px;
        height:20px;
        background-color: red;
        position: relative;
        border-radius: 50px;
        animation-name: example;
        animation-duration: 4s;
        animation-play-state: paused;
    }
    @keyframes example {
        0% {background-color: red; left: 0%; top: 0px;}
        25% {background-color: yellow; left: 25%; top: 0px}
        50% {background-color: blue; left: 50%; top: 0px}
        75% {background-color: green; left: 75%; top: 0px}
        100% {background-color: red; left: 94%; top: 0px}
    }

</style>
</head>
<body>
    <ul>
        <li><a href="#" id="home">HOME</a></li>
        <li><a href="#queue" style="background-color:#111">QUEUE</a></li>
        <li><a href="#" id="counter">COUNTER</a></li>
        <li><a href="#" id="logout">LOGOUT</a></li>
        <li style="float:right"><a class="active" href="#about">Hello,
        <?php
            echo $_SESSION['name'];
        ?>
    </a></li>
    </ul>
    <div id="progress-bar"></div>
    <div id="header-line" class="flex-container">
        <div id="tag-line">
            <h2><?php echo $_GET['queue_name']; ?></h2>
        </div>
        <div id="running-text">
            <marquee style="color:#fff">
            <?php
                echo $_GET['running_text'];
            ?>
            </marquee>
        </div>
    </div>
    <div class="flex-container" id="container-header">
        <div class="content-queue" id="content-queue-one">
            <h2 align="center">
                COUNTER 1
            </h2>
            <div id="number">
                <h1 id="count-number">00</h1>
            </div>
            <!-- <div id="content-loading">
                <div id="loading">

                </div>
            </div> -->
        </div>
        <div id="iframe">
            <iframe style="width:100%;height:100%" src="https://www.youtube.com/embed/kJQP7kiw5Fk?&autoplay=1&loop=1&rel=0&showinfo=0&color=white&iv_load_policy=3&playlist=kJQP7kiw5Fk" frameborder="0">
            </iframe>
        </div>
    </div>
    <div class="flex-container">
        <?php
            for($a = 0; $a < $_GET['counter_many']; $a ++){
        ?>
        <div class="content-queue">
            <h2 align="center">
                <?php echo "COUNTER ".($a+1);?>
            </h2>
            <div id="number">
                <h1 id="count-number">00</h1>
            </div>
            <!-- <div id="content-loading">
                <div id="loading">

                </div>
            </div> -->
        </div>
        <?php
            }
        ?>
    </div>
<script>
    $(document).ready(function(){
        var num = 1;

        // $("#continue").on("click",function(){
        //     $("#loading").css("animation-play-state","running");
        //     $("#loading").css("animation-iteration-count","infinite");
        //     $("#count-number").text(num++);
        //     if(num%2 == 0){
        //         $("#number").css("background-color","red");
        //     }else{
        //         $("#number").css("background-color","blue");
        //     }
        // });

        // $("#break").on("click",function(){
        //     //clearInterval(refreshsetIntervalId);
        //     $("#loading").css("animation-play-state","paused");
        // });


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

        $("#home").on("click",function(e){
            e.preventDefault();
            var home = 1;
            $.ajax({
                url: "getHome.php",
                type: "POST",
                data: {"home":home},
                beforeSend: function(data){
                    //$("#counter").css("animation-play-state","running");
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    $("#progress-bar").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/dashboard.php");
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
