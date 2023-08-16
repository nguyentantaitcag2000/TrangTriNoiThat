<?php
class Color extends DB{
    public function GetColors()
    {
        $result = mysqli_query($this->con, 'SELECT * FROM `Color`');
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