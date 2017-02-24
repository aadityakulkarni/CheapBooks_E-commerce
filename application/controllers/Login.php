<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('page1_login');
    }

    public function checkLogin()
    {
        $this->load->model('model_login');
        echo $val = $this->model_login->login();
        if(!empty($val)){
            $data = array('logged_in_status' => 1 ,'username' => $this->input->post('username'),
                'basketId' => $val);
            /*$_SESSION['logged_in_status'] = 1;
            $_SESSION['username'] = $this->input->post('username');
            $_SESSION['basketId'] = $val;*/

            $this->session->set_userdata('user_session', $data);
            //$this->data['hello'] = 10;
            //$data['hello']='hellow world';
            //$this->load->view('page2_books');
            echo true;
        }
        else{
            echo false;
        }
        //return $val;
    }

    public function page2()
    {
        $this->load->view("page2_books");
    }

    public function basketCount()
    {
        $this->load->model('model_login');
        $count = $this->model_login->basket_count();
        echo $count;

    }

    public function findByAuthor()
    {
        $this->load->model('model_login');
        $responseAuthor = $this->model_login->author();
        echo $responseAuthor;

    }

    public function findByTitle()
    {
        $this->load->model('model_login');
        $responseTitle = $this->model_login->title();
        echo $responseTitle;

    }

    public function addToCart()
    {
        $this->load->model('model_login');
        $cartCount = $this->model_login->cartAdd();
        echo $cartCount;

    }

    public function buy(){
        $this->load->model('model_login');
        $buyTable = $this->model_login->buyPage();
        echo $buyTable;

    }

    public function buyPage()
    {
        $this->load->view("page3_buy");
    }

    public function buyCart()
    {
        $this->load->view('buy_ajax');

    }

    public function buyItems()
    {
        $this->load->model('model_login');
        $buyTable = $this->model_login->buyItem();
        echo $buyTable;

    }

    public function register()
    {
        $this->load->view('page4_register');

    }
    public function registerCustomer()
    {
        $this->load->model('model_login');
        $success = $this->model_login->register();
        echo $success;
    }

    public function logout()
    {
        $this->session->unset_userdata('user_session');
        $this->session->sess_destroy();
        //redirect('/');
        //echo base_url();
        header('Location:'.explode("index.php", site_url())[0]);
    }

}
