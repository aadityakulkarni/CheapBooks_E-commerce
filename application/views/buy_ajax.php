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
<?php echo $navigation; ?>
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>Your order has been placed successfully !</h1>
            <h1>Thank you for shopping with us.</h1>
            <button value="Shop More" onclick="window.location='<?php echo $prj_url."index.php/page2" ?>'" class="btn btn-default">Go back and shop more.</button>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $.get('<?php echo $prj_url."index.php/login/buyItems" ?>', function (data){
            console.log("data - " + data);
           /* if(data > 0){
                $("#shoppingbasket").val("Shopping Basket - "+data);
            }
            else{
                $("#shoppingbasket").val("Shopping Basket - 0");
            }*/
        });
    });
</script>
</body>
</html>




