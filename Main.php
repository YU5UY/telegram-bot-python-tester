<?php
ob_start();
define('API_KEY','TOKEN'); // Your Token //
echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
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
function SendMessage($chat_id,$text,$parse_mode="MARKDOWN",$disable_web_page_preview=true,$reply_to_message_id=null,$reply_markup=null){
    return bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$parse_mode,
	'disable_web_page_preview'=>$disable_web_page_preview,
	'disable_notification'=>false,
	'reply_to_message_id'=>$reply_to_message_id,
	'reply_markup'=>$reply_markup
	]);
}
function RunCode($Code){
    $request = file_get_contents("https://hamod.ga/api/Python.php?code=".$Code);
    $json = json_decode($request,true);
    if( $json['Warnings'] == null && $json['Errors'] == null ){
    return $json['Result'];
    }elseif( $json['Warnings'] != null | $json['Errors'] != null ){
    $error = explode('py",',$json['Errors']);
    return $error[1];
    }
}
$update             = json_decode(file_get_contents('php://input'));
$message            = $update->message;
$chat_id            = $message->chat->id;
$from_id            = $message->from->id;
$user               = $message->from->username;
$text               = $message->text;
$data               = $update->callback_query->data;
$bot                = bot('getMe');
$BotUserName        = "@".$bot->result->username;
$name               = $message->from->first_name;
$data_name          = $update->callback_query->from->first_name;
$message_id2        = $update->callback_query->message->message_id;
$from_id2           = $update->callback_query->from->id;
$chat_id2           = $update->callback_query->message->chat->id;
/* Python Codes tester */
if( preg_match("/^\/([Ss][Tt][Aa][Rr][Tt])$/",$text) ){
    $keyboard = [];
    $keyboard['inline_keyboard'][] = [["text"=>"Coder .","url"=>"https://t.me/RRLRR"]];
    $keyboard = json_encode($keyboard);
    SendMessage($chat_id,"*· Welcome Dear in Python Codes Tester 🧚🏻*\n\n· Send Your Code Then Wait to Run it & Give You Result .\nNotice : bot dont run any code with library ⚠️","MARKDOWN",true,$message->message_id,$keyboard);
}elseif( $text != "/start" ){
    SendMessage($chat_id,RunCode($text),"MARKDOWN",true,$message->message_id,null);
}

// File By @RRLRR - @CodeLeak