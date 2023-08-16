<?php
class Detail_Product_Image extends DB{
    public function GetDetailProductImageOfID($ID)
    {
        $result = mysqli_query($this->con, 'SELECT * FROM `detail_product_image` WHERE ID_Product = '.$ID.';');
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        
        return $return;
    }
}
?>