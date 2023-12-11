<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    //


    public function moeda($v){
		$source=array('.',',');
		$replace=array('','.');
		$valor=str_replace($source, $replace, $v);
		return $valor;
		
	}

	public function clear($input){

        $texto=addslashes($input);
        $texto=htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        return $texto;
    }
}
