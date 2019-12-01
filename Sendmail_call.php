<?php
require 'mail/class.phpmailer.php';

 $message = '<html><body>';
		
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
			$message .= "<tr><td><strong>Phone:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
		$message .= "<tr><td><strong>Message:</strong> </td><td>" . htmlentities($_POST['message']) . "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";
			
			
			
			
			//  MAKE SURE THE "FROM" EMAIL ADDRESS DOESN'T HAVE ANY NASTY STUFF IN IT
			
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
            if (preg_match($pattern, trim(strip_tags($_POST['email'])))) { 
                $cleanedFrom = trim(strip_tags($_POST['email'])); 
            } else { 
                echo "The email address you entered was invalid. Please try again!"; 
                exit;
            } 
			
			
            
$mail = new PHPMailer;
 $mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'aspironweb';                   // SMTP username
$mail->Password = 'temperaturedh123';               // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS
  


$mail->addAddress('info@aspironweb.com');
$mail->addAddress('aspironweb@gmail.com');// Add a recipient

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

$mail->isHTML(true);                                  // Set email format to HTML
 
$mail->Subject = 'New Call Me Request generated';
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 

 
if(!$mail->send()) {
   echo 'Message could not be sent.<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=http://www.aspironweb.com/contact.html">';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent.<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=http://www.aspironweb.com/contact.html">';
?>