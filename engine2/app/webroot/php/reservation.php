<?php
if(isset($_POST['mail']))
{
session_cache_limiter( 'nocache' );
$subject = "Reservation Request From ".$_POST['name']; // Subject of your email
$to = "info@thai-atrium.de";  //Recipient's E-mail

// $subject_reply = "Re:".$subject;
$subject_reply = "Response from Thai Atrium Team";
$to_reply = $_POST['mail'];

// $booktype= $_POST['book-type'];

$headers = "From: " . $_POST['name']."<".$_POST['mail'].">"."\r\n"; 


$headers_reply = "From: " . $to ."\r\n";

$message = "Name:". $_POST['name']."\r\n"."Date:".$_POST['date']."\r\n"."Time:".$_POST['time']."\r\n"."No of Person:".$_POST['person-no']."\r\n"."Phone No:".$_POST['phone']."\r\n"."Booking Type:".$_POST['reserve-book-type']."\r\n".$_POST['message'];  
// $message_reply = "Thank you very much for email us."."\r\n"."We will reply you within shortest possible time."."\r\n"."\r\n"."ThemeRole Team"; 
$message_reply = "Dear Sir or Madam,"."\r\n"."\r\n"."Thank you very much for contacting us."."\r\n"."We will shortly come back to you. For urgent request please feel free to call us."."\r\n"."\r\n"."Tel: 089 45212755"."\r\n"."\r\n"."Sincerely yours,"."\r\n"."Thai Atrium Team"."\r\n"."Briennerstr. 10,"."\r\n"."D-80333 Munich";
    
if (@mail($to, $subject, $message, $headers))
{
	mail($to_reply, $subject_reply, $message_reply, $headers_reply);
	// Transfer the value 'sent' to ajax function for showing success message.
	echo 'sent';
}
else
{
	// Transfer the value 'failed' to ajax function for showing error message.
	echo 'failed';
}

}
?>