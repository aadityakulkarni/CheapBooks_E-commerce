<?php
include  'nav_template.php';
//print_r($this->session->all_userdata());
//print_r($this->session->user_session['logged_in_status']);
//print_r($basketid = $this->session->user_session['basketId']);
if(!$this->session->user_session['logged_in_status']){
    header('Location:'.$prj_url);
}
?>
<html>
<head>
    <link rel="stylesheet" href="<?php echo $prj_url.'assets/bootstrap/css/bootstrap.css';?>">
    <script src="<?php echo $prj_url.'assets/js/jquery-3.1.1.min.js';?>"></script>
    <script src="<?php echo $prj_url.'assets/bootstrap/js/bootstrap.js';?>"></script>
    <script src="<?php echo $prj_url.'assets/js/wdmproject5.js'; ?>"></script>
</head>
<body>
<?php echo $navigation;?>
<!--<button onclick="logout()">Logout</button><br>-->
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Search Results</div>
                <div id="table-output">

                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="button" name="buy" id="buy" value="Buy" class="btn btn-success"
                   onclick="window.location='<?php echo $prj_url."index.php/buyCart";?>';">

            </div>
        </div>

    </div>
</div>
</div>
<script>
    $(document).ready(function (){
        $.get('<?php echo $prj_url."index.php/login/buy" ?>', function (data){
            console.log("table - " + data);
            $("#table-output").html(data);
        });
    });
</script>
</body>
</html>
