<?php
class Import_History extends DB{
    // public function GetAll()
    // {
    //     return $this->get_list("SELECT * FROM bill ");
    // }
    public function Add($array)
    {
        return $this->insert("import_history",$array);
    }

}
?>