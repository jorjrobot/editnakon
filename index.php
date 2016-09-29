<?php
ob_start();
define('API_KEY','249645076:AAEq0zgjuj4slsFmXadPQb6zKpB4ERLkLSI');
$admin = "194849320";
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
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$text1 = $message->text;
$fadmin = $message->from->id;
$file_o = __DIR__.'/users/'.$mid.'.json';
file_put_contents($file_o,json_encode($update->message->text));
chmod($file_o,0777);
if (isset($update->edited_message)){
  //$chat_id1 = $editm->chat->id;
  $eid = $editm->message_id;
  $edname = $editm->from->first_name;
  $jsu = json_decode(file_get_contents(__DIR__.'/users/'.$eid.'.json'));
 $text = "- چرا ادیت کردی <b>".$edname."</b>؟؟\n- من میفهمم هاااا😂 تو گفتی :\n- ".$text2."";
  $id = $update->edited_message->chat->id;
  bot('sendmessage',[
    'chat_id'=>$id,
    'reply_to_message_id'=>$eid,
    'text'=>$text,
    'parse_mode'=>'html'
  ]);
  $file_o = __DIR__.'/users/'.$eid.'.json';
  file_put_contents($file_o,json_encode($update->edited_message->text));
  //$up = file_get_contents(__DIR__.'/users/'.$eid.'.json');
  //str_replace("edited_message","message",$up);
}elseif(preg_match('/^\/([Ss]tart)/',$text1)){
  $text = '- سهلام😅\n- به ربات ادیت نکن خوش اومدی😊\n- من توی گروه شما میمونم که هر کسی متنی رو ادیت کرد بهش پیغام بدم😂\n\n- خیلی خوب میشه مچ دوستاتو بگیری تا بدونی قبلا بهت چی گفتن😍😂\n\n<a href="telegram.me/Editer_Bot?startgroup=new">اینجا کلیک کن و منو توی گروهات ببر</a>';
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'سازندگان','url'=>'https://telegram.me/omidi']
        ],
        [
          ['text'=>'کانال','url'=>'https://telegram.me/TeleGold_Team']
        ]
      ]
    ])
  ]);
}elseif( $fadmin == $admin |  $fadmin == $admin2 and $update->message->text == '/stats'){
    $txtt = file_get_contents('member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
  bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"- تعداد کاربران : $mmemcount 👤 "
    ]);

}elseif(isset($update->message-> new_chat_member )){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"- به گروه خوش اومدی🙈\n- امید وارم بهت خوش بگذره😊"
    ]);
}
  
  
  
  
  
  
  
$txxt = file_get_contents('member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('member.txt');
      $aaddd .= $chat_id."\n";
      file_put_contents('member.txt',$aaddd);
    }
