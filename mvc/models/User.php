<?php
class User extends DB{
    public function GetUser($Email)
{
    $query = "SELECT u.*, 
            (SELECT COUNT(*) FROM Bill WHERE ID_User = u.ID_User AND ID_BS = 2) as SoLuongDaThanhToan,
            (SELECT COUNT(*) FROM Bill WHERE ID_User = u.ID_User AND ID_BS = 4) as SoLuongDaHuy
            FROM users u
            WHERE Email = '".$Email."'";
    $result = mysqli_query($this->con, $query);

    if (!$result)
    {
        die ('Câu truy vấn bị sai');
    }

    $return = mysqli_fetch_array($result);
    
    mysqli_free_result($result);
    return $return;
}
    public function GetUserTotal()
    {
        $query = "SELECT u.*, 
            (SELECT COUNT(*) FROM Bill WHERE ID_User = u.ID_User AND ID_BS = 2) as SoLuongDaThanhToan,
            (SELECT COUNT(*) FROM Bill WHERE ID_User = u.ID_User AND ID_BS = 4) as SoLuongDaHuy
            FROM users u";
    $result = mysqli_query($this->con, $query);

    if (!$result)
    {
        die ('Câu truy vấn bị sai');
    }

    $return = array();
    while ($row = mysqli_fetch_array($result))
    {
        $return[] = $row;
    }
    
    mysqli_free_result($result);
    return $return;
    }
}
?>