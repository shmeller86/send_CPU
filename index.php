<?php
/**
 * Created by PhpStorm.
 * User: che
 * Date: 16.06.2017
 * Time: 15:27
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));

 require_once "class/LogParse.php";
require_once "class/Ssh.php";
require_once 'config/conf.php';
require_once 'class/Curl.php';
require_once 'class/Get.php';

$content = file_get_contents("php://input");

echo $s = ($content)  ? $str = Get::getCorrectArray($content) : 'bad';
//$str['text'] = "/cpu";

if (strtolower($str['text']) == "/con" || strtolower($str['text']) == "/con@bot_che_bot") {
    echo $rs0 =   "========================================\r\n"
        . "=====     Сейчас сидят на VPN     =====\r\n"
        . "=======================================\r\n";

    $answer = json_decode(file_get_contents("http://url/json.php"));

    foreach ($answer as $key => $value){
        if($value->{'fromip'}!=='') $rs0 .= " FROM - ".$value->{'fromname'}." ".$value->{'fromip'}."\r\n";
        else $rs0 .= " FROM - ".$value->{'fromip'}."\r\n";


        if($value->{'toname'}!=='') $rs0 .= " TO - ".$value->{'toname'}." ".$value->{'toip'}."\r\n";
        else $rs0 .= " TO - ".$value->{'toip'}."\r\n";

        $rs0 .= " PORT - ".$value->{'port'}."\r\n";
        $rs0 .= "STATUS - ".$value->{'status'}."\r\n\r\n";
    }
    $rs0  .=  "======================================== \r\n";

    Curl::apiRequestJson("sendMessage", array(
        'chat_id' => $str['chat_id'], //
        "text" => $rs0,
        'parse_mode' => 'HTML',
        'reply_markup' => array(
            //'keyboard' => array(array('Hello', 'Hi')),
            'one_time_keyboard' => true,
            'resize_keyboard' => true)));
}
if (strtolower($str['text']) == "/cpu" || strtolower($str['text']) == "/cpu@bot_che_bot") {
    // auth
    $cn = Ssh::getAuth();

    // get some log file
    Ssh::getFilePS($cn);

    // work with log file
    $eco = LogParse::getArrayCPU(file_get_contents('process.log'));
    unlink('process.log');


    echo $rs0 =   "========================================\r\n"
        . "=====     Нагрузка процессора     =====\r\n"
        . "=======================================\r\n";
    foreach ($eco as $k => $v){
        $rs0 .= "Процесс ".$v['PROCESS'].", запущен от ".$v['RUSER']." и загружен на ".$v['CPU']."%\r\n";
    }
    $rs0  .=  "======================================== \r\n";
//echo $rs0;
    Curl::apiRequestJson("sendMessage", array(
        'chat_id' => '11111111',//$str['chat_id'],
        "text" => $rs0,
        'parse_mode' => 'HTML',
        'reply_markup' => array(
        //'keyboard' => array(array('Hello', 'Hi')),
        'one_time_keyboard' => true,
        'resize_keyboard' => true)));
}






