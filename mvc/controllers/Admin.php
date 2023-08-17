<?php

class Admin extends Controller{

    // Must have SayHi()
    function Daskboard(){
        $listProduct = $this->model('Product')->GetProducts();
        $listUser = $this->model('User')->GetUserTotal();
        $Bill = $this->model('Bill');
        $soLuongHangTonKho = $Bill->Get_SoLuongTonKho();
        $soLuongHangDangXuLy = $Bill->Get_SoLuongBillDangXuLy();
        $tongDoanhThu = $Bill->Get_tongDoanhThu();
        // $Top10SanPhamDuocMuaNhieuNhat = $Bill->Get_Top10SanPhamDuocMuaNhieuNhat();
        $Top10SanPhamDuocMuaNhieuNhat = null;
       
        // Call Views
        $this->view("admin", [
            "Page"=>"admin-home",
            "ListProduct"=>$listProduct,
            "ListUser"=>$listUser,
            "soLuongHangTonKho"=>$soLuongHangTonKho,
            "soLuongHangDangXuLy"=>$soLuongHangDangXuLy,
            "tongDoanhThu"=>$tongDoanhThu,
            "Top10SanPhamDuocMuaNhieuNhat"=>$Top10SanPhamDuocMuaNhieuNhat,
        ]);
    }
    function CheckoutDone($id)
    {
        $Bill = $this->model('Bill');
        if($Bill->Done($id))
        {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
        else
            echo "Error";

    }
    function CheckoutNotDone($id)
    {
        $Bill = $this->model('Bill');
        if($Bill->NotDone($id))
        {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
        else
            echo "Error";

    }
    function CheckoutShiping($id)
    {
        $Bill = $this->model('Bill');
        if($Bill->Shipping($id))
        {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
        else
            echo "Error";

    }
    function Destroy($id)
    {
        $Bill = $this->model('Bill');
        if($Bill->Destroy($id))
        {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
        else
            echo "Error";

    }
    function Product(){
        $listProduct = $this->model('Product');
        $listCategory = $this->model('Category');
        
        $listProduct = $listProduct->GetProducts();
        $listCategory = $listCategory->GetCategories();
       
        // Call Views
        $this->view("admin", [
            "Page"=> 'admin-product',
            "ListProduct"=>$listProduct,
            "ListCategory"=>$listCategory,
            "ListColor"=>$this->model('Color')->GetColors(),
            "ListMaterial"=>$this->model('Material')->GetMaterials(),
 
        ]);
    }
    function Category(){
        $listProduct = $this->model('Product');
        $listCategory = $this->model('Category');
        $listProduct = $listProduct->GetProducts();
        $listCategory = $listCategory->GetCategories();
        // Call Views
        $this->view("admin", [
            "Page"=> 'admin-category',
            "ListCategory"=>$listCategory,
        ]);
    }
    function Bill($id = 0)
    {
        $Bill = $this->model('Bill');
        $listProduct = $this->model('Product');
        $listCategory = $this->model('Category');
        $listProduct = $listProduct->GetProducts();
        $listCategory = $listCategory->GetCategories();
        // Call Views
        $this->view("admin", [
            "Page"=> 'admin-quan-li-don-hang',
            "ListCategory"=>$listCategory,
            "Bill_List"=>$Bill->GetAll($id),
        ]);
    }
    function Test()
    {
        $this->model('Product')->SaveProductCategories();
    }

}
?>