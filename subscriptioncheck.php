<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/Exception.php";
require_once "PHPMailer/src/SMTP.php";

if(isset($_POST['bookname']))
{
         $name=$_POST['bookname'];
$sqlstmt="select * from subscription_list where BookName='$name'";
$conn=mysqli_connect('localhost','root','','mvogms_db');
$query=mysqli_query($conn,$sqlstmt);
while($row=mysqli_fetch_assoc($query))
{
	$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'winwritesofficial@gmail.com';				
	$mail->Password = 'capdwmpqvrnwqnxc';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;
	$mail->setFrom("bookstore@gmail.com", "Book Store");		
	$mail->addAddress($row['mail']);	
	$mail->isHTML(true);								
	$mail->Subject = 'Subject';
	$mail->Body="<html><body style='background-color:maroon;width:50%;height:200px;color:white'><h3>The book ".$name." is now available in store. You can now order it.</h3></body></html>";
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
	// Account details
	$del = $conn->query("DELETE FROM subscription_list where BookName='$name'");
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}	
}
else
{
	echo "No item at the moment";
}


?>
