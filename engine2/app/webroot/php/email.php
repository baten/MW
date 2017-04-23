<?php
if(isset($_POST['email']))
{
session_cache_limiter( 'nocache' );
$subject = $_POST['subject-type']."to Thai Atrium"; // Subject of your email
$to = "info@thai-atrium.de";  //Recipient's E-mail
$name = $_POST['name'];
// $subject_reply = "Re:".$_POST['subject-type']."to Thai Atrium";
$subject_reply = "Response from Thai Atrium Team";
$to_reply = $_POST['email'];


$headers = "From: " . $_POST['name']."<".$_POST['email'].">"."\r\n"; 


$headers_reply = "From: " . $to ."\r\n";

$message = "Name:".$name."\r\n".$_POST['message'];   
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