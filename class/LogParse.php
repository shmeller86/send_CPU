<?php

/**
 * Created by PhpStorm.
 * User: che
 * Date: 16.06.2017
 * Time: 15:48
 */
class LogParse
{
    public static function getArrayCPU($arr){
        preg_match_all("@(\d{1,}.\d{1,})[ ]*(\d{1,})[ ]*([\w+-]{1,})[ ]*([\w+\/:.()-]{1,})[\n]@", $arr, $matches, PREG_SET_ORDER );
        $eco = array();
        $i=0;
        foreach ($matches as $k => $v){
            if($v[1] > 0) {
                $eco[$i]['PID']     = $v[2];
                $eco[$i]['CPU']     = $v[1];
                $eco[$i]['RUSER']   = $v[3];
                $eco[$i]['PROCESS'] = $v[4];
                $i++;
            }
        }
        return $eco;
    }
}