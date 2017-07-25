<!DOCTYPE html>
<html>
<head>
    <title>Antrian Online</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
    body{
        background-color: #ddd;
    }
    #content-login, #content-register{
        background-color: #fff !important;
        width:300px;
        border: 1px solid black;
        padding: 25px;
        padding-top: 0px;
        margin: 100px auto;
    }
    input[type=text], input[type=password]{
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
<body>
    <div id="content-login">
        <h1>E-Queue</h1>
        <form method="post" id="form">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" autocomplete="OFF">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="OFF">
            <a href="#" type="button" class="button button-next" id="submit">NEXT</a>
            <a href="#" style="float:right" id="create-account">Create Account</a>
            <div id="content-loading">
                <div id="loading">

                </div>
            </div>
        </form>
    </div>

    <div id="content-register" style="display:none">
        <h1>Register</h1>
        <form method="post" id="form">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" autocomplete="OFF">
            <label for="email">Email</label>
            <input type="text" id="email_reg" name="email" autocomplete="OFF">
            <label for="password">Password</label>
            <input type="password" id="password_reg" name="password" autocomplete="OFF">
            <a href="#" type="button" class="button button-next" id="register">NEXT</a>
            <a href="#" style="float:right" id="to-login">Login</a>
            <div id="content-loading">
                <div id="loading">

                </div>
            </div>
        </form>
    </div>
<script type="text/javascript">
        $("#submit").on("click",function(e){
            e.preventDefault();
            //$("#loading").css("animation-play-state","running");
            //$("#loading").css("animation-play-state","running");
            var email = $("#email").val();
            var password = $("#password").val();
            $.ajax({
                url: "getLogin.php",
                type: "POST",
                data: {"email":email,"password":password},
                beforeSend: function(data){

                },
                success: function(data){
                    var obj = JSON.parse(data);
                    console.log(data);
                    $("#loading").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/dashboard.php?id="+obj.id+"&name="+obj.name);
                        }else{
                            $("#submit").after("<p>Email or password not valid");
                        }
                    },4000);
                }
            });

        });

    $("#create-account").on("click",function(e){
        $("#content-login").hide();
        $("#content-register").fadeIn("slow");
    })

    $("#to-login").on("click",function(e){
        $("#content-register").hide();
        $("#content-login").fadeIn("slow");
    })

        $("#register").on("click",function(e){
            e.preventDefault();
            //$("#loading").css("animation-play-state","running");
            //$("#loading").css("animation-play-state","running");
            var name = $("#name").val();
            var email = $("#email_reg").val();
            var password = $("#password_reg").val();
            $.ajax({
                url: "getRegister.php",
                type: "POST",
                data: {"name":name,"email":email,"password":password},
                beforeSend: function(data){

                },
                success: function(data){
                    var obj = JSON.parse(data);
                    console.log(data);
                    $("#loading").css("animation-play-state","running");
                    setTimeout(function(){
                        if(obj.msg == 1){
                            $(location).attr("href","http://localhost/e-queue/index.php?success="+obj.msg);
                        }else{
                            // $("#submit").after("<p>Email or password not valid");
                        }
                    },4000);
                }
            });

        });
</script>
</body>
</html>
