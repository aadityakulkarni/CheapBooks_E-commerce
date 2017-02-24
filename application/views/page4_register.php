<?php
include  'nav_template.php';
?>
<html>
<head>
    <link rel="stylesheet" href="<?php echo $prj_url.'assets/bootstrap/css/bootstrap.css';?>">
    <script src="<?php echo $prj_url.'assets/js/jquery-3.1.1.min.js';?>"></script>
    <script src="<?php echo $prj_url.'assets/bootstrap/js/bootstrap.js';?>"></script>
    <script src="<?php echo $prj_url.'assets/js/wdmproject5.js'; ?>"></script>
</head>
<body>
<?php echo $navigation; ?>
<div class="container">
    <div class="row">
       <!-- --><?php /*if($status == '1'){
            echo "<div class=\"alert alert-success\" role=\"alert\">Registration Successfull !</div>";
        } else if($status == '2'){
            echo "<div class=\"alert alert-danger\" role=\"alert\">Registration Failed !</div>";
        } else if ($status == '0') {
            echo "";
        }*/?>
        <div id="error_status">

        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
<!--            <form action="" id="register" onsubmit="return validateRegisterForm();" method="post">-->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" minlength="2" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password&nbsp;</label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password&nbsp;</label>
                    <input type="password" name="confirmpassword" id="confirmpassword" required class="form-control">
                </div>
                <div class="from-group">
                    <label for="address">Address&nbsp;</label>
                    <textarea name="address" cols="30" rows="2" id="address" required class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="phone">Phone&nbsp;</label>
                    <input type="tel" name="phone" id="phone" maxlength="10" minlength="10" pattern="[0-9]+" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email&nbsp;</label>
                    <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" required class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" value="Register" onclick="validateRegisterForm()" class="btn btn-primary form-control">
                </div>
<!--            </form>-->
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
</body>

<script>
    $(document).ready(function() {
        $("#logout").addClass("hidden");
    });

    function validateRegisterForm() {

        var password = $("#password").val();
        var confirmpassword = $("#confirmpassword").val();

        if(confirmpassword != password){
            $("#password").focus();
            $("#status").html('Passwords did not match!');
            console.log('passwords did not match');
            return false;
        }
        else{
            //console.log($("#address").val());
            $.post('<?php echo $prj_url."index.php/login/registerCustomer" ?>',
                {username: $("#username").val(), password: $("#password").val(), address: $("#address").val(),
                    phone: $("#phone").val(), email: $("#email").val()}, function(data){
                if(data == 1) {
                $("#error_status").html('<div class=\"alert alert-success\" role=\"alert\">Registration Successfull !</div>');
                } else {
                    $("#error_status").html('<div class=\"alert alert-danger\" role=\"alert\">Registration Failed !</div>');
                }
            });
        }
    }
</script>
</html>

