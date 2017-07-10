<?php

define('API_KEY', '437863282:AAFji-Vi3tk0F47r6JEPqb_WfFDZLsaVWTE');

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function sendmessage($chat_id, $text){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"MarkDown"
 ]);
 } 
 function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
//-//////
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
//---------------//
if($text == '/start'){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"به ربات بیوگرافی اینستا خوش امدید
 برای دریافت بیوگرافی یکی از کاربران اینستا  نام کاربری شخص را برام بفرستید
مثلا : `perspolis24_official`",
 'parse_mode'=>"MarkDown"
 ]);
}

elseif($text){
$ali1 = json_decode(file_get_contents("https://instagram.com/".$text."/?__a=1"));
    $tik2 = objectToArrays($ali1);
    $a1 = $tik2['user']['biography'];
    $a2 = $tik2["user"]["followed_by"]["count"];
    $a3 = $tik2["user"]["follows"]["count"];
    $a4 = $tik2["user"]["media"]["count"];
    $a5 = $tik2["user"]["external_url"];
    $a6 = $tik2["user"]["username"];
     $a7 = $tik2["user"]["profile_pic_url_hd"];
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"خوب اینم بیوگرافی  کاربر :

$a1
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
📍تعداد دنبال کننده ها => ($a2)

📍تعداد دنبال شده گان => ($a3)

📍تعداد پست ها => ($a4)
‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾",
 'parse_mode'=>"MarkDown"
 ]);
}

?>
