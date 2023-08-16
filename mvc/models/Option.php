<?php
class Option extends DB{
    public function GetOption($name)
    {
        $stmt = $this->con->prepare("SELECT * FROM `options` WHERE `Name` = ? ");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $return = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if($return)
            return $return;
        return false;
    }
    public function GetOptions(){


        $stmt = $this->con->prepare("SELECT * FROM `options`");
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $array = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row;
        }
        mysqli_free_result($result);
       
        return $array;
    }
    
}
?>