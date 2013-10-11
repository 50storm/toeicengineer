//ライブラリ読み込み
require_once("Mail.php");
require_once("Mail/mime.php");
 
//言語設定、内部エンコーディングを指定する
mb_language("japanese");
mb_internal_encoding("EUC-JP");
 
//日本語添付メールを送る
$to = "iga1128@msn.com"; //宛先
$subject = "例の件について"; //題名
$body = "資料を送ります"; //本文
$from = "masaki@example.com"; //差出人
$fromname = "山本 正喜"; //差し出し人名
$attachfile = "./TOEIC950.png"; //添付ファイルパス
 
$mail = Mail::factory("mail");
 
$body = mb_convert_encoding($body,"JIS","EUC-JP");
 
$mime = new Mail_Mime("\n");
$mime->setTxtBody($body);
 
//添付ファイル追加
$mime->addAttachment($attachfile,"application/octet-stream");
 
$body_encode = array(
  "head_charset" => "ISO-2022-JP",
  "text_charset" => "ISO-2022-JP"
);
 
$body = $mime->get($body_encode);
 
$headers = array(
  "To" => $to,
  "From" => mb_encode_mimeheader(mb_convert_encoding($fromname,"JIS","EUC-JP"))."<".$from.">",
  "Subject" => mb_encode_mimeheader(mb_convert_encoding($subject,"JIS","EUC-JP"))
);
 
$header = $mime->headers($headers);
 
$return = $mail->send($to,$header,$body);
if (PEAR::isError($return)){
    echo("メールが送信できませんでした エラー：".$return->getMessage());
}
