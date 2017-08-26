<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div class="row">

        <div class="row">
            <h4 class="center">Login</h4>
            <div id="error-log"></div>
        </div>
    <form class="col l4 offset-l4 ConnectBloc" action="" id="form-connect" method="post">

                <input placeholder="Login" id="login" name="login" type="text">

                <input placeholder="Password" id="passwd" name="passwd" type="password">

        <button class="btn waves-effect waves-light btn-full" type="button" name="action" id="connect-btn">Connexion</button>
    </form>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>



<script>


$ = jQuery;



    $(document).ready(function() {


        $("#connect-btn").click(function () {
            event.preventDefault();
            var formdata = $('#form-connect').serialize();
            $.ajax({
                url: 'ajax-login.php'
                , method: 'POST'
                , data: formdata
                , dataType: 'json'
                , success: function (json) {
                    if (json.access) {
                        location.href = "/";
                    } else {
                        //Materialize.toast( json.error , 1100, 'red');
                        alert(json.error);
                    }
                }

            });
        });
    });
</script>
<script>
    $(document).keypress(function(e) {
        if(e.which == 13) {
            event.preventDefault();
            var formdata = $('#form-connect').serialize();
            $.ajax({
                url: '/ajax-login.php'
                , method: 'POST'
                , data: formdata
                , dataType: 'json'
                , success: function (json) {
                    if (json.access) {
                        location.href = "/";
                    } else {
                        //Materialize.toast( json.error , 1100, 'red');
                        alert(json.error);

                    }
                }

            });
        }
    });
</script>

</html>
