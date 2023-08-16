<?php

class DB{

    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "pthtw2";

    function __construct(){
        $this->con = mysqli_connect($this->servername, $this->username, $this->password);
        mysqli_select_db($this->con, $this->dbname);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
    function insert($table, $data)
    {
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->con, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->con, $sql);
    }
    function update($table, $data, $where)
    {
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->con, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->con, $sql);
    }
    function get_row($sql)
    {
        $result = mysqli_query($this->con, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function get_list($sql)
    {
        $result = mysqli_query($this->con, $sql);
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
    function query($sql)
    {
        $result = mysqli_query($this->con, $sql);
        if (!$result)
        {
            return false;
        }
        return true;
    }

}

?>