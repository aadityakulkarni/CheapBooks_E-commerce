<?php
/**
 * Created by PhpStorm.
 * User: Aaditya
 * Date: 12/2/2016
 * Time: 9:26 PM
 */

class Model_login extends CI_Model {

    public function login()
    {
        $basketId = '';
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $md5pass = md5($password);

        $query = $this->db->query("select password from customers where username='$username'");


        foreach ($query->result() as $row)
        {
            $dbpassword = $row->password;
            if($md5pass == $dbpassword){
                $basket = $this->db->query("select basketId from shoppingbasket where username ='$username'");
                foreach ($basket->result() as $basketrow)
                {
                    $basketId = $basketrow->basketId;
                }
            }
        }

        return $basketId;

    }

    public function basket_count()
    {
        $basketid = $this->session->user_session['basketId'];

        $query = $this->db->query("select SUM(number) as count from contains where basketid='$basketid'");

        //$count = $query->result();
        foreach ($query->result() as $basketrow)
        {
            $count = $basketrow->count;
        }
        return $count;
    }

    public function author()
    {   $table = '';
        $table .= "<table class='table table-responsive'>
                <tr><th>Book Name</th><th>ISBN</th><th># of Books</th><th>Qty</th><th>Cart</th></tr>";
        $search = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $search_filter = '';
        $search_array = explode(" ",$search);
        foreach($search_array as $x){
            $search_filter .= "%".$x."%";
        }
        $sql = "select * from book where ISBN in (select ISBN from writtenby where SSN in
            (select SSN from author where name LIKE '$search_filter'))";

        $search_query = $this->db->query($sql);
        foreach($search_query->result() as $result){
            $name = $result->title;
            $ISBN = $result->ISBN;
            //print_r($result);
            /* $table .= "<tr><td>$name</td><td>$ISBN</td><td></td><td><input type='number' max='10' min='1'></td>
             <td><button value='Add To Cart' >Add To Cart</button></td>
             </tr>";*/
            $noofbooks = $this->db->query("select number from stocks where ISBN ='$ISBN'");
            $count = 0;
            foreach($noofbooks->result() as $book){
                $count += $book->number;
            }
            if($count > 0)
            {
                $qty_id = "qty_".$ISBN;
                $table .= "<tr><td>$name</td><td>$ISBN</td><td>$count</td><td><input type='number' max='$count'
                        min='1' id='$qty_id' class='form-control'></td>
        <td><button value='Add To Cart'  onclick=\"addtocart('$ISBN','$count')\" class='btn btn-primary' >Add To Cart</button></td>
        </tr>";
            }
        }
        $table .= "</table>";

        return $table;
    }

    public function title()
    {
        $table = '';
        $table .= "<table class='table table-responsive'>
                <tr><th>Book Name</th><th>ISBN</th><th># of Books</th><th>Qty</th><th>Cart</th></tr>";
        $search = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $search_filter = '';
        $search_array = explode(" ",$search);
        foreach($search_array as $x){
            $search_filter .= "%".$x."%";
        }
        $sql = "select * from book where title LIKE '$search_filter'";

        $search_query = $this->db->query($sql);
        foreach($search_query->result() as $result){
            $name = $result->title;
            $ISBN = $result->ISBN;
            //print_r($result);
            $noofbooks = $this->db->query("select number from stocks where ISBN ='$ISBN'");
            $count = 0;
            foreach($noofbooks->result() as $book){
                $count += $book->number;
            }
            if($count > 0)
            {
                $qty_id = "qty_".$ISBN;
                $table .= "<tr><td>$name</td><td>$ISBN</td><td>$count</td><td><input type='number'
                        max='$count' min='1' id='$qty_id' class='form-control'></td>
            <td><button value='Add To Cart' onclick=\"addtocart('$ISBN','$count')\" class='btn btn-primary'>Add To Cart</button></td>
            </tr>";
            }

        }
        $table .= "</table>";
        return $table;
    }

    public function cartAdd(){
        $basketId = $this->session->user_session['basketId'];
        $isbn = filter_input(INPUT_POST, 'ISBN' , FILTER_SANITIZE_NUMBER_INT);
        $qty = filter_input(INPUT_POST, 'QTY' , FILTER_SANITIZE_NUMBER_INT);
        $check = $this->db->query("select number from contains where ISBN='$isbn' and basketid='$basketId'");
        $curr_count = $check->num_rows();

        $resultBool = false;
        if($curr_count > 0) {
            foreach ($check->result() as $prevnum) {
            $finalnum = intval($prevnum->number) + $qty;
            }
            $updatecontains = $this->db->query("update contains set number = '$finalnum' 
                                                 where ISBN = '$isbn' and basketid ='$basketId'");
            if($updatecontains) {
                $resultBool = true;
            }
        }
        else{
            $insertcontains = $this->db->query("insert into contains VALUE ('$isbn','$basketId','$qty')");
            if($insertcontains) {
                $resultBool = true;
            }
        }

        if($check && $resultBool){
            $checkCount =  $this->db->query("select SUM(number) as count from contains where basketid='$basketId'");
            $shoppingcart = $checkCount->result();
            echo $shoppingcart[0]->count;
        }
        else{
            echo "0";
        }
    }

    public function buyPage()
    {

        $table = '<table class="table table-responsive"><tr><th>Name of Book </th><th>ISBN of Book </th><th>Quantity </th><th>Price</th></tr>';
        $basketid = $this->session->user_session['basketId'];
        $showBasket = $this->db->query("select b.title, c.ISBN, SUM(c.number) as num, SUM(c.number) * b.price as price from 
                          contains as c, book as b where c.ISBN = b.ISBN and c.basketId ='$basketid' group by c.ISBN");

        $total = 0;
        foreach($showBasket->result() as $basket){
            $total += $basket->price;
            $table .= "<tr><td>$basket->title</td><td>$basket->ISBN</td><td>$basket->num</td><td>".
                number_format($basket->price, 2, '.', '')."</td></tr>";
        }
        $table .= "<tr><th colspan='3'>Total : -</th><th>".number_format($total, 2, '.', '')."</th></tr>";
        $table .= "</table>";

        return $table;
    }

    public function buyItem(){
        $basketid = $this->session->user_session['basketId'];
        $username = $this->session->user_session['username'];


        $user_order_sql_query = "select a.ISBN , SUM(a.number) as num from contains a , book b where a.ISBN = b.ISBN 
                         and a.basketId = '$basketid' GROUP BY a.ISBN";
        $user_order_result = $this->db->query($user_order_sql_query);
        foreach($user_order_result->result() as $book_in_contains){
            //print_r($book_in_contains);
            $book_bought_by_customer = $book_in_contains->num;
            $stock_sql = "select * from stocks where ISBN = '$book_in_contains->ISBN'";
            $book_warehouse_result = $this->db->query($stock_sql);
            foreach ($book_warehouse_result->result() as $book_warehouse){
                //print_r($book_warehouse);
                $warehouse_books = $book_warehouse->number;

                if (($book_bought_by_customer - $warehouse_books) >0 && $warehouse_books != 0){
                    $countxy = 0;
                    if($book_bought_by_customer > $warehouse_books) {
                        $countxy = $warehouse_books;
                        $balance = $book_bought_by_customer - $warehouse_books;
                    }else {
                        $countxy =  $book_bought_by_customer - $warehouse_books;
                        $balance = $countxy;
                    }
                    $ship =  "INSERT INTO shippingorder VALUES ('$book_in_contains->ISBN', '$book_warehouse->warehouseCode', '$username', '$countxy' )";
                    $ship_exec = $this->db->query($ship);

                    $stock_update = "UPDATE stocks SET number='0' WHERE ISBN='$book_in_contains->ISBN' AND warehouseCode='$book_warehouse->warehouseCode'";
                    $update_stock_result = $this->db->query($stock_update);
                    $book_bought_by_customer = $balance;

                } elseif (($book_bought_by_customer - $warehouse_books) <=0) {
                    $balance =  $warehouse_books - $book_bought_by_customer;
                    $ship =  "INSERT INTO shippingorder VALUES ('$book_in_contains->ISBN', '$book_warehouse->warehouseCode', '$username', '$book_bought_by_customer' )";
                    $ship_exec = $this->db->query($ship);

                    $stock_update = "UPDATE stocks SET number='$balance' WHERE ISBN='$book_in_contains->ISBN' AND warehouseCode='$book_warehouse->warehouseCode'";
                    $update_stock_result = $this->db->query($stock_update);
                    $book_bought_by_customer = $balance;
                    break;
                }
            }
        }
        $delete_contains = $this->db->query("delete from contains where basketid ='$basketid'");

        return $username.$basketid;
    }

    public function register()
    {
        $status = '2';
        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST,'address',FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST,'phone',FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $md5Pass = md5($password);
        $register = $this->db->simple_query("insert into customers values ('$username','$md5Pass','$address','$phone','$email')");
        if($register){
            $basketid = uniqid();
            $shoppingbasket = $this->db->simple_query("insert into shoppingbasket values ('$basketid', '$username')");
            if($shoppingbasket){
                $status = '1';
            }
            else{
                $status = '2';
            }

        }
        else{
            $status = '2';
        }
        return $status;
    }
}