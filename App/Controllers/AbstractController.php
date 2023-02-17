<?php

namespace App\Controllers;

class AbstractController
{
    function populate(Array $arrayWillTake, Array $mainArray){
        foreach ($arrayWillTake as $element){
            array_push($mainArray, $element);
        }
        return $mainArray;
    }

    function emComum(Array $array){
        $res = array();
        foreach($array as $element){
            $aux = 0;
            foreach($array as $elementComparator){
                if($element == $elementComparator){
                    $aux++;
                    if($aux>2 && !in_array($element, $res)){
                        array_push($res, $element);
                        $aux = 0;
                    }
                }
                continue;
            }
        }
        if(empty($res)){
            return $array;
        }
        return $res;
    }

}