//���C�u�����ǂݍ���
require_once("Mail.php");
require_once("Mail/mime.php");
 
//����ݒ�A�����G���R�[�f�B���O���w�肷��
mb_language("japanese");
mb_internal_encoding("EUC-JP");
 
//���{��Y�t���[���𑗂�
$to = "iga1128@msn.com"; //����
$subject = "��̌��ɂ���"; //�薼
$body = "�����𑗂�܂�"; //�{��
$from = "masaki@example.com"; //���o�l
$fromname = "�R�{ ����"; //�����o���l��
$attachfile = "./TOEIC950.png"; //�Y�t�t�@�C���p�X
 
$mail = Mail::factory("mail");
 
$body = mb_convert_encoding($body,"JIS","EUC-JP");
 
$mime = new Mail_Mime("\n");
$mime->setTxtBody($body);
 
//�Y�t�t�@�C���ǉ�
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
    echo("���[�������M�ł��܂���ł��� �G���[�F".$return->getMessage());
}
