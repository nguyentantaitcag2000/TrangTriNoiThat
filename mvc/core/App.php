<?php
session_start();
$ck_email = "email";
$ck_hash = "hash";
$time_save_cookie = time() + 90*24*3600; // Lưu 3 tháng
class App{

    protected $controller="Home";
    protected $action="Daskboard";
    protected $params=[];
    
    function __construct(){
 
        $arr = $this->UrlProcess();
        // Controller
        if($arr != NULL)
            if( file_exists("./mvc/controllers/".$arr[0].".php") ){
                $this->controller = $arr[0];
                unset($arr[0]);
            }
        require_once "./mvc/controllers/". $this->controller .".php";
        $this->controller = new $this->controller;

        // Action
        if(isset($arr[1])){
            if( method_exists( $this->controller , $arr[1]) ){
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }
        // Params
        $this->params = $arr?array_values($arr):[];
        call_user_func_array([$this->controller, $this->action], $this->params );

    }

    function UrlProcess(){
        if( isset($_GET["url"]) ){
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
      

    }
}
function check_string($data)
{
    return trim(htmlspecialchars(addslashes($data)));
}
function random($string, $int)
{  
    return substr(str_shuffle($string), 0, $int);
}
function EncodePassword($string)
{
    return hash('sha256', $string);
}
function alert($str)
{
    echo "<script>alert('$str');</script>";
}
function alertSuccess($text, $url = null, $time = 1000)
{
    if($url !=null)
    {
        return die('<script type="text/javascript">Swal.fire("Success", "'.$text.'","success");
        setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
    }
    else
    {
        return die('<script type="text/javascript">Swal.fire({icon:"success",title:"'.$text.'",timer: 1500});</script>');
    }
        
}
function alertError($text, $url = null, $time = 1000)
{
    if($url !=null)
    {
        return die('<script type="text/javascript">Swal.fire("Error", "'.$text.'","error");
        setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');    
    }
    else
    {
        return die('<script type="text/javascript">Swal.fire("Error", "'.$text.'","error");</script>');    
    }
    
}
function format_cash($number, $suffix = '') {
    return number_format($number,0);
}
function GO($url){
    return die('<script type="text/javascript">location.href = "'.$url.'";</script>');
}
?>
