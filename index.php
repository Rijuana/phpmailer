<?php

$conn=mysqli_connect("localhost","root","","calendar");
//Include required PHPMailer files
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	$mail=new PHPMailer; 
	$mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'rijuk9272@gmail.com';                     //SMTP username
    $mail->Password   = 'R!juanak9272';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("rijuk9272@gmail.com");
    $sql="Select * from table_reminder" ;  //Add a recipient
       $res=mysqli_query($conn,$sql);
	   if(mysqli_num_rows($res)>0){

    $mail->addReplyTo("'rijuk9272@gmail.com'");
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
		while($x=mysqli_fetch_assoc($res)){
			$ddate=$x['rdate'];
			
			$ddate1=strtotime($ddate);
			
			date_default_timezone_set('Asia/Kolkata');
			$cdate= new DateTime();
		
			$cdate1=strtotime($cdate->format("Y-m-d H:i:s"));
			
			if($ddate1==$cdate1){
			
			$mail->addBCC($x['rmail']);
			}
		}
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reminder Mail';
    $mail->Body    = '<h1>Hey u have a event</h1>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
    echo 'Message has been sent';
	   }
	   else{
		   echo "no data found";
	   }
	}
	   ?>