<?php

namespace App;

class GlobalFunction
{
    public static function spaceChange($sts, $string){
        if($sts == 1){
            $result = str_replace(' ', '-', $string);
        }else{
            $result = str_replace('-', ' ', $string);
        }
        
        return $result;
    }
}
