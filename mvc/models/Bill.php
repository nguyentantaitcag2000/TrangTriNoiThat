<?php
class Bill extends DB{
    public function GetAll($id)
    {
        if($id == 0)
            return $this->get_list("SELECT * FROM bill,bill_status WHERE bill.ID_BS = bill_status.ID_BS");
        else
            return $this->get_list("SELECT * FROM bill,bill_status WHERE bill.ID_BS = bill_status.ID_BS AND bill_status.ID_BS = $id");

    }
    public function Add($array)
    {
        $this->insert("bill", $array);
        return mysqli_insert_id($this->con);;
    }
    public function Done($ID_Bill)
    {
        return $this->update("bill", array("ID_BS" => 2), "ID_Bill = '$ID_Bill'");
    }
    public function NotDone($ID_Bill)
    {
        return $this->update("bill", array("ID_BS" => 1), "ID_Bill = '$ID_Bill'");
    }
    public function Shipping($ID_Bill)
    {
        return $this->update("bill", array("ID_BS" => 3), "ID_Bill = '$ID_Bill'");
    }
    public function Destroy($ID_Bill)
    {
        return $this->update("bill", array("ID_BS" => 4), "ID_Bill = '$ID_Bill'");
    }
    public function Get_SoLuongTonKho()
    {
        return $this->get_row("SELECT SUM(ih.Amount_IH) as SoLuongHangTonKho FROM import_history ih
            JOIN bill b ON b.ID_Bill = ih.ID_Bill
            WHERE b.ID_BS != 2;
            ")['SoLuongHangTonKho'];
    }
    public function Get_SoLuongBillDangXuLy()
    {
        return $this->get_row("SELECT COUNT(b.ID_Bill) as SoLuongHangDangXuLy FROM bill b JOIN bill_status bs ON bs.ID_BS = b.ID_BS WHERE bs.Name_BS = 'Đang xử lý';")['SoLuongHangDangXuLy'];
    }
    public function Get_tongDoanhThu()
    {
        return $this->get_row("SELECT SUM(TotalMoneyCheckout) as TongDoanhThu FROM bill;")['TongDoanhThu'];
    }

    public function Get_Top10SanPhamDuocMuaNhieuNhat()
{
    return $this->get_list("SELECT p.ID_Product, p.Name_Product, SUM(bd.Amount_BD) as TongSoLuong 
                            FROM bill_detail bd 
                            JOIN product p ON bd.ID_Product = p.ID_Product
                            GROUP BY p.ID_Product 
                            ORDER BY TongSoLuong DESC 
                            LIMIT 10;");
}

}
?>