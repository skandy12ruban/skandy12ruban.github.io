
<?php
require_once('PHPMailer/PHPMailerAutoload.php');
define('GUSER', 'alagaracadamyindia@gmail.com'); // GMail username
define('GPWD', 'alagar123'); // GMail password
define('from', 'No-rplyalagaracadamy@gmail.com');
define('from_name', 'alagaracadamy');
function smtpmailer($to, $subject, $body) { 
    global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = TRUE;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
    $mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->SetFrom(from, from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
        $error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
} else {
		$error = 'Message sent!';
	return true;
}
}
?>