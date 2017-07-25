<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div id="target">

    </div>
<script>
    $(document).ready(function(){
        $.ajax({
            url: "tes_api.php",
            type: "POST",
            data: {"key":4},
            beforeSend: function(){

            },
            success: function(data){
                console.log(data);
                var obj = JSON.parse(data);
                $("#target").append(
                    "<input type='text' id='id' value='"+obj[0]['id']+"'>"+
                    "<br><input type='text' id='id' value='"+obj[0]['name']+"'>"+
                    "<br><input type='text' id='id' value='"+obj[0]['email']+"'>"+
                    "<br><input type='text' id='id' value='"+obj[0]['password']+"'>"
                );
            }
        });
    });
</script>
</body>
</html>
