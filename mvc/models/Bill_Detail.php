<?php
class Bill_Detail extends DB{
    // public function GetAll()
    // {
    //     return $this->get_list("SELECT * FROM bill ");
    // }
    public function Add($array)
    {
        return $this->insert("bill_detail",$array);
    }

}
?>