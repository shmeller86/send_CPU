<?php

/**
 * Created by PhpStorm.
 * User: che
 * Date: 16.06.2017
 * Time: 15:29
 */

class Ssh
{

    public static function getAuth(){
        $param = include (ROOT."/config/ssh_config.php");
        $connection = ssh2_connect($param['host'], $param['port']);
        ssh2_auth_password($connection, $param['login'], $param['password']);

        return $connection;
    }

    public static function getFilePS($cn){
        ssh2_exec($cn, "cd ~/");
        ssh2_exec($cn, "ps -eo %C%p%u%c --sort %cpu >> process.log");
        ssh2_scp_recv($cn, '/home/g-soft/process.log', 'process.log');
        ssh2_exec($cn, "rm process.log");
    }
}