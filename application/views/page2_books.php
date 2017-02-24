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
<?php
echo $navigation; ?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
<!--            <form action="" method="post">-->
                <div class="form-group">
                    <label>Search</label>
                    <textarea name="search" id="search" cols="30" rows="3" placeholder="Search here." class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="button" name="author" id="author" onclick="author()" class="btn btn-primary" value="Search by Author">
                    <input type="button" name="title" id="title" onclick="title1()" class="btn btn-primary" value="Search by Title">
                </div>
                <div class="form-group">
                    <input type="button" name="shoppingbasket" id="shoppingbasket" class="btn btn-default"
                           onclick="window.location='<?php echo $prj_url."index.php/buyPage";?>';"><br>
                </div>
<!--            </form>-->
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search Results</div>
                <div id="table-output">

                </div>
                <?php // echo $table; ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $.get('<?php echo $prj_url."index.php/login/basketCount" ?>', function (data){
            //console.log("data - " + data);
            if(data > 0){
                $("#shoppingbasket").val("Shopping Basket - "+data);
            }
            else{
                $("#shoppingbasket").val("Shopping Basket - 0");
            }
        });
    });
    function author() {
        $.post('<?php echo $prj_url."index.php/login/findByAuthor" ?>', {text : $("#search").val()} ,function (data){
            //console.log("author - " + data);
            $("#table-output").html(data);
        });
    }
    function title1() {
        $.post('<?php echo $prj_url."index.php/login/findByTitle" ?>', {text : $("#search").val()}, function (data){
            //console.log("title - " + data);
            $("#table-output").html(data);
        });
    }
    function addtocart(isbn, max_count){
        var id = "qty_"+isbn;
        var qty = $("#"+id).val();
        //console.log(max_count + " - " + qty);
        if(parseInt(max_count) >= parseInt(qty) ) {

            $.post('<?php echo $prj_url."index.php/login/addToCart" ?>',{ISBN: isbn, QTY: qty}, function (data) {
                //console.log("Shopping Count - " + data);
                $("#shoppingbasket").val("Shopping Basket - " + data)
            });
        }
        else{
            alert("The quantity you requested is more than the number of books available. ");
        }
    }
</script>


</body>
</html>
