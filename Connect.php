<?php
# https://rextester.com/rundotnet/Run
# @RRLRR , @CodeLeak
error_reporting(0);
$code = $_GET['code'];
$data  = array(

    'LanguageChoiceWrapper' => '24',
    'EditorChoiceWrapper' => '1',
    'LayoutChoiceWrapper' => '1',
    'Program' => $code,
    'Input' => '',
    'Privacy' => '',
    'PrivacyUsers' => '' ,
    'Title' => '',
    'SavedOutput' => '',
    'WholeError' => '',
    'WholeWarning' => '',
    'StatsToSave' => '',
    'CodeGuid' => '',
    'IsInEditMode' => 'False',
    'IsLive' => 'False'

);
$header = array(

  "Referer: https://rextester.com/l/python3_online_compiler",
  "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.107 Safari/537.36"

);
$rextester  = curl_init();
curl_setopt($rextester , CURLOPT_URL ,"https://rextester.com/rundotnet/Run");
curl_setopt($rextester , CURLOPT_FOLLOWLOCATION , true);
curl_setopt($rextester , CURLOPT_POST , true);
curl_setopt($rextester , CURLOPT_HTTPHEADER , $header);
curl_setopt($rextester , CURLOPT_POSTFIELDS , $data);
curl_setopt($rextester , CURLOPT_COOKIEJAR , "cookie.txt");
curl_setopt($rextester , CURLOPT_RETURNTRANSFER , true);

$result = curl_exec($rextester);
curl_close($rextester);

echo $result;