<?php
// http://localhost/live/Home/Show/1/2

class Home extends Controller{
    public $ID_User = -1;
    function __construct()
    {
        $User = $this->model('User');
        if(isset($_SESSION['email']))
            $this->ID_User = $User->GetUser($_SESSION['email'])['ID_User'];
    }
    // Must have SayHi()
    function Daskboard(){
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $ListCategories = $category->GetCategories();
        $ListProducts = $product->GetProducts();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        // Call Views
        $this->view("Home", [
            "Page"=>"Home-Daskboard",
            "ListCategories"=>$ListCategories,
            "ListProducts"=>$ListProducts,
            "ListShoppingCarts"=>$ListShoppingCarts,
            "Title" => "Trang chủ",
            "Title-Product-List" => "Tất cả sản phẩm",
            
        ]);
    }
    function Order()
    {

        $shoppingcart = $this->model('ShoppingCart');
        $Import_History = $this->model('Import_History');
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        $Bill = $this->model('Bill');
        $Bill_Detail = $this->model('Bill_Detail');

        $firstname = $_POST['firstname'];
        $address = $_POST['address'];
        $sdt = $_POST['sdt'];
        $note = $_POST['note'];
        $ID_User = $_SESSION['ID_User'];
        $price = $_POST['price'];
        $ListShoppingCarts = $_POST['ListShoppingCarts'];
        $total_money_checkout = $_POST['total_money_checkout'];
       
        //Tạo đơn hàng
        $ID_Bill = $Bill->Add(array(
            "ID_User" => $ID_User,
            "TotalMoney" => $price,
            "TotalMoneyCheckout" => $total_money_checkout,
            "Address_Bill" => $address
        ));
        //Tạo chi tiết đơn hàng
        foreach ($ListShoppingCarts as $key => $value) {
          
            $ID_Product = $value['ID_Product'];
            $Amount =  $value['Amount'];
            $Price =  $value['Price'];
            $result =  $Bill_Detail->Add(array(
                "ID_Product" => $ID_Product,
                "ID_Bill" => $ID_Bill,
                "Amount_BD" => $Amount
            ));
            //Thêm đơn hàng vào bảng nhập hàng
            $Import_History->Add(array(
                "ID_Bill" => $ID_Bill,
                "Amount_IH" => $Amount,
                "Price_IH" => $Price,
                "TotalMoney_IH" =>$total_money_checkout 
            ));
        }

        
        if($result)
        {
            $this->view("Home", [
                "Page"=>"Thong-bao-da-dat-hang",
                "Title" => "Trang chủ",
                "Title-Product-List" => "Tất cả sản phẩm",
                "ListShoppingCarts"=>$ListShoppingCarts
            ]);
        }
        else
        {
            echo "Đặt hàng thất bại";
        }
            
    }
    function Introduce()
    {
        $shoppingcart = $this->model('ShoppingCart');
        
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);

          // Call Views
        $this->view("Home", [
            "Page"=>"Home-gioi-thieu",
            "Title" => "Giới thiệu",
            "Title-Product-List" => "Tất cả sản phẩm",
            "ListShoppingCarts"=>$ListShoppingCarts,
            
        ]);
    }
    function Contact()
    {
        $shoppingcart = $this->model('ShoppingCart');
        
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);

          // Call Views
        $this->view("Home", [
            "Page"=>"Home-lien-he",
            "Title" => "Liên hệ",
            "Title-Product-List" => "Tất cả sản phẩm",
            "ListShoppingCarts"=>$ListShoppingCarts,
            
        ]);
    }
    function Info($ProductID)
    {
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $Detail_Product_Image = $this->model('Detail_Product_Image');
        $ListCategories = $category->GetCategories();
        $Product = $product->GetProductOfID($ProductID);
        $Detail_Product_Image = $Detail_Product_Image->GetDetailProductImageOfID($ProductID);
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        // Call Views
        $this->view("Home", [
            "Page"=>"Home-Info",
            "ListCategories"=>$ListCategories,
            "Product"=>$Product,
            "ProductID"=>$ProductID,
            "Detail_Product_Image"=>$Detail_Product_Image,
            "ListShoppingCarts"=>$ListShoppingCarts,
            "Title" => "Thông tin sản phẩm",
            "Product_Suggestion" => $product->SearchInTitle_Description($Product['Name_Category']),

        ]);
    }
    function Cart()
    {
        //Kiểm tra nếu người dùng chưa đăng nhập thì chuyển sang trang login
        if(!isset($_SESSION['email'])){
            GO('/Auth/Login');
        }
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $Detail_Product_Image = $this->model('Detail_Product_Image');
        $ListCategories = $category->GetCategories();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);

        // Call Views
        $this->view("Home", [
            "Page"=>"Home-Cart",
            "ListCategories"=>$ListCategories,
            "Detail_Product_Image"=>$Detail_Product_Image,
            "ListShoppingCarts"=>$ListShoppingCarts,
            "Title" => "Giỏ hàng",

        ]);
    }
    function Checkout($idProduct = '')
    {
        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $Detail_Product_Image = $this->model('Detail_Product_Image');
        $ListCategories = $category->GetCategories();
        // $Product = $product->GetProductOfID($ProductID);
        // $Detail_Product_Image = $Detail_Product_Image->GetDetailProductImageOfID($ProductID);
        
        if($idProduct != '')  // Trường hợp người nhấn mua ở trang xem sản phẩm
        {
            $myProduct = $product->GetProductOfID($idProduct);
            $total_money = ((int)$_POST['amount'])* $myProduct['Price'];
            $myProduct['Amount'] = $_POST['amount']; 
            $ListShoppingCarts = [$myProduct];   
        }
        else // Trường hợp người nhấn thanh toán ở giỏ hàng
        {

            $total_money = $_POST['total_money'];
            $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);    
            foreach ($_POST['product'] as $key => $value) {
              
                foreach ($ListShoppingCarts as $key2 => $value2) {
                    if($value2['ID_Product'] == $value['ID_Product'] )
                    {
                        $ListShoppingCarts[$key2]['Amount'] = $value['Amount'];
                        break;
                    }
                }
                
            }
        }
        // Call Views
        $this->view("Home", [
            "Page"=>"Home-Checkout",
            "ListCategories"=>$ListCategories,
            "ListShoppingCarts"=>$ListShoppingCarts,
            "Title" => "Thông tin sản phẩm",
            "total_money" => $total_money,

        ]);
    }
    function Search($type, $searchQuery)
    {
        $Product_Suggestion = null;

        $category = $this->model('Category');
        $product = $this->model('Product');
        $shoppingcart = $this->model('ShoppingCart');
        $ListCategories = $category->GetCategories();
        $ListShoppingCarts = $shoppingcart->GetShoppingCartOfID($this->ID_User);
        $ListProducts = $this->model('Product')->Search($searchQuery);
        if(count($ListProducts) > 0)
        {
            switch ($type) {
                case 'Keywords':
                    $Product_Suggestion = $product->SearchInTitle_Description($ListProducts[0]['Name_Category']); 
                    break;
                case "Category":
                break;
                default:
                    // code...
                    break;
            }
        }
            
        // Call Views
        $this->view("Home", [
            "Page"=>"Home-Daskboard",
            "ListCategories"=>$ListCategories,
            "ListProducts"=>$ListProducts,
            "ListShoppingCarts"=>$ListShoppingCarts,
            "Title" => "Kết quả tìm kiếm: $searchQuery",
            "Title-Product-List" => "Kết quả tìm kiếm: $searchQuery",
            "Product_Suggestion" => $Product_Suggestion,
        ]);
    }
}
?>