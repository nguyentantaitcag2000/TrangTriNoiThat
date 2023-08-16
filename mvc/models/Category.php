<?php
class Category extends DB{
  
    public function Category(){
        $qr = "SELECT * FROM sinhvien";
        return mysqli_query($this->con, $qr);
    }
    public function GetCategories()
    {
        $result = mysqli_query($this->con, 'SELECT * FROM `category`');
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