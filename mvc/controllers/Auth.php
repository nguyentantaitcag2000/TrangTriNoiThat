<?php

class Auth extends Controller{
    public $ID_User = -1;
    // Must have SayHi()
    
    function Daskboard(){
        $this->Login();
    }
    function Login(){
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $ListCategories = $category->GetCategories();
        $ListProducts = $product->GetProducts();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        // Call Views
        $this->view("Auth", [
           "Page" => "Auth-Login",
           "Title" => "Đăng nhập",

        ]);
    }
     function Register(){
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $ListCategories = $category->GetCategories();
        $ListProducts = $product->GetProducts();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        // Call Views
        $this->view("Auth", [
           "Page" => "Auth-Register",
           "Title" => "Đăng kí",
           "password_strength" => $this->model('Option')->GetOption("password_strength"),
        ]);
    }
    function Verify(){
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $ListCategories = $category->GetCategories();
        $ListProducts = $product->GetProducts();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        // Call Views
        $this->view("Auth", [
           "Page" => "Auth-Verify",
           "Title" => "Xác thực tài khoản",
        ]);
    }
    function Logout(){
        global $ck_email;
        global $ck_hash;
        $_SESSION = array();
        unset($_SESSION['email']);
        unset($_SESSION['level']);
        session_destroy();
        
        unset($_COOKIE[$ck_email]);
        setcookie($ck_email,null,-1,'/');

        unset($_COOKIE[$ck_hash]);
        setcookie($ck_hash,null,-1,'/');


        die('<script>window.location.href = "/"</script>');
    }
}
?>