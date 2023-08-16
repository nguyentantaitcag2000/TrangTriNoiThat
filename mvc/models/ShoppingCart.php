<?php
class ShoppingCart extends DB{
    public function GetShoppingCartOfID($ID_User)
    {
        $result = mysqli_query($this->con, "SELECT * FROM `shoppingcart` s INNER JOIN product p ON s.ID_Product = p.ID_Product WHERE ID_User = '".$ID_User."';");
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