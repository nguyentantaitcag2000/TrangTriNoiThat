<?php
class Material extends DB{
    public function GetMaterials()
    {
        $result = mysqli_query($this->con, 'SELECT * FROM `Material`');
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