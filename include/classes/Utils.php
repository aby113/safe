<?php
class Utils{



    public static function redirect($url) {
        header("Location:{$url}");
        exit;
      }
    
    
    public static function sanitizeInp($inpVal)
    {
        $inpVal = strip_tags($inpVal);
        $inpVal = str_replace(" ", "", $inpVal);
        return $inpVal;
    }


    public static function rememberInpVal($name){

        if(isset($_POST[$name])){
            return $_POST[$name];
        }
    }
    
}



?>