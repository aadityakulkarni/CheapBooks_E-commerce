<?php
include 'nav_template.php';
//echo base_url();
//print_r($this->session->all_userdata());
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
        <div id="error_show"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
<!--            <form action='--><?php //echo site_url(); ?><!--/login/checkLogin' method="post">-->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control"><br>
                </div>
                <div class="form-group">
                    <label for="password">Password&nbsp;</label>
                    <input type="password" name="password" id="password" class="form-control"><br>
                </div>
                <div class="form-group">
                    <input type="submit" onclick="loginSubmit()"  value="Submit" class="btn btn-primary">
                </div>
<!--            </form>-->
            <input type="button" onclick="registerPage()" class="btn btn-default" value="New users must register here">
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>
<script>
    $(document).ready(function() {
        $("#logout").addClass("hidden");
    });
    function  loginSubmit() {
        var user = $("#username").val();
        var pass = $("#password").val();
        $.post('<?php echo $prj_url; ?>index.php/login/checkLogin', {username: user, password : pass}
        ,function (data){
            if(data){
                //console.log("true");
                window.location = '<?php echo $prj_url; ?>index.php/page2';
            }
            else{
                $("#error_show").html('<div class=\"alert alert-danger\" role=\"alert\">Login Failed !</div>');
                //console.log(data);
            }
        });
    }

    function registerPage() {
        //console.log("r");
        window.location = '<?php echo $prj_url; ?>index.php/register';
    }
</script>
</html>

