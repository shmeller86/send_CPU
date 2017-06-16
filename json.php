<?php
/**
 * Created by PhpStorm.
 * User: che
 * Date: 02.05.2017
 * Time: 19:26
 */

//http://80.73.194.181:8081/Status_Conntrack.asp
/*
$output4 = file_get_contents("http://212.48.228.114");
$count4 = preg_match("/Login/", $output4);
echo "\r\n" . $count4;

/*  -------------------------*/

function send($msg) {

    $chat_id = 'ssss';
    $bot_token = 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    $params = array(
        "chat_id" => $chat_id,
        "text" => $msg,
        "disable_web_page_preview" => 1,
    );

    $aContext = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($params),
            'header' => "Content-type: application/x-www-form-urlencoded",
            'ignore_errors' => true,
        ),
    );
    $cxContext = stream_context_create($aContext);

    $query = "https://api.telegram.org/" . $bot_token . "/sendMessage";
    $res = file_get_contents($query, false, $cxContext);
    echo $res;

}


$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://url_to_router/Status_Conntrack.asp');
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_USERPWD, "login:pwd");
$content = curl_exec($curl);
curl_close($curl);


$content = str_replace(array("\r","\n"),"",$content);
$pattern = "/<tr><td align=\"right\">(\S{1,})<\/td><td>(\S{1,})<\/td><td align=\"right\">(\S{1,})<\/td><td align=\"right\"><a title=\"Geotool\" href=\"javascript:openGeotool\('(\d*.\d*.\d*.\d*)'\)\">\d*.\d*.\d*.\d*<\/a><\/td><td align=\"right\"><a title=\"Geotool\" href=\"javascript:openGeotool\('(\d*.\d*.\d*.\d*)'\)\">\d*.\d*.\d*.\d*<\/a><\/td><td align=\"right\">(\d*)<\/td><td>(\w*)<\/td><\/tr>/";
preg_match_all($pattern,$content,$matches,PREG_SET_ORDER);

$vpn = array(
    "server" => array(
        array("200.97.165.39","3391"),
        array("200.97.165.39","3392"),
    ),

);

foreach ($matches as $key => $value) {
    if(preg_match("/192.168.0./",$value[4])) {
        foreach ($vpn as $key2 => $value2) {
            foreach ($value2 as $key3 => $value3) {
                if ($value[5] == $value3[0]) {
                    $json[$key]["fromip"] =  $value[4];
                    $json[$key]["fromname"] =  getName($value[4]);
                    $json[$key]["port"] =  $value[6];
                    $json[$key]["toip"] =  $value[5];
                    $json[$key]["toname"] =  $key2;
                    $json[$key]["status"] =  $value[7];
                }
            }
        }
    }
    //if($value[4] == '192.168.0.111') {

        //echo $value[4].":".$value[6]." => ".$value[5]."   ".$value[7].PHP_EOL;}

}
echo json_encode($json);

//print_r($vpn);
//print_r($matches);

/*foreach ($matches as $key => $value){
    echo $value[5];
    print_r(array_keys($array,$value[5]));

}*/

function getName($ip){
    $client = array(
        "Victor B" => "192.168.0.100",
        "Igor R" => "192.168.0.111",
        "Olga K" =>  "192.168.0.119",
        "Maxim L" =>  "192.168.0.125",
        "Katya K" =>  "192.168.0.120",
        "Pip" =>  "192.168.0.124",

        );
    foreach ($client as $key => $value){
        if($value == $ip) return $key;
    }
}