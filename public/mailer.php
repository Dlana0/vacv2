<?php
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
require 'PhpMailer.php';

if (isset($_POST['sendButton'])) {
    $mailer = new mailSender();
    $mailer->sendNow();
}
class mailSender
{
    public function sendNow($recAddress, $body, $attachTmp ='', $attachName='')
    {
        $mail             = new PHPMailer();
            
        //$body             = file_get_contents('contents.html');
        //$body             = eregi_replace("[\]",'',$body);

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = "mail.yourdomain.com"; // SMTP server
        //$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                                   // 1 = errors and messages
                                                   // 2 = messages only
        //$mail->Debugoutput = 'html';
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
        $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
        $mail->SMTPSecure = 'tls';
        $mail->Username   = "dianaozolina2@gmail.com";  // GMAIL username
        $mail->Password   = 'l33t5p34k';            // GMAIL password

        $mail->SetFrom('noreply@talenthire.com','noreply');

        $mail->AddReplyTo("noreply@talenthire.com","noreply");

        $mail->Subject    = "Notification from TalentHire";

        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        if ($attachName && $attachTmp)
            $mail->addAttachment($attachTmp, $attachName);
        //echo $body;
        $mail->MsgHTML($body);

        //$address = "ibaumgarts@gmail.com";
        $mail->AddAddress($recAddress);

        //$mail->AddAttachment("images/phpmailer.gif");      // attachment
        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

        if(!$mail->Send()) {
          echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
          echo "Message sent!";
        }
    }   
}
?>