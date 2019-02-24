<?php

//echo '<script language="javascript">';
//echo 'alert("message successfully sent")';
//echo '</script>';
 require_once('../dbconnect.php');
 require("/home/root1/dev.peepschannel.com/ajax/phpmailer/PHPMailer-5.2.0/class.phpmailer.php");

       $mail = new PHPMailer();
   
	$USER_EMAIL     = $_POST['USER_EMAIL'];
	$USER_FULL_NAME = $_POST['USER_FULL_NAME'];
	$USER_NAME      = $_POST['USER_NAME'];
	$USER_PASSWORD  = $_POST['USER_PASSWORD'];
	$user_lat       = $_POST['user_lat'];
	$user_long      = $_POST['user_long'];
    $sourcePath     = $_FILES['profile_image']['tmp_name'];       // Storing source path of the file in a variable
    $name_img       = $_FILES['profile_image']['name'];       // Storing source path of the file in a variable
     
	 
	//echo $sourcePath;


	
   
       
	   date_default_timezone_set('Asia/Dhaka');
		
		
		$sql1 = "SELECT * FROM USER WHERE USER_EMAIL = '$USER_EMAIL' or USER_NAME = '$USER_NAME'";

	  $result1 = mysqli_query($con,$sql1);
	  
     
      $count = mysqli_num_rows($result1);

		
      if($count > 0) {
          
echo '<script>';

echo 'alert('.'"User already exist , Please try with another email or username"'.');';
echo 'history.go(-1);';
echo '</script>';
	   

// echo "Exist";

	 }
	  
	  else
	  {
						

	$sql = "INSERT INTO `USER`(`USER_EMAIL`, `USER_FULL_NAME`, `USER_NAME`, `USER_PASSWORD`,`USER_USER_FROM`,`USER_LAT`,`USER_LONG`) 
	VALUES ('$USER_EMAIL','$USER_FULL_NAME','$USER_NAME','$USER_PASSWORD',2,$user_lat,$user_long)";
                                  
	$confirm = mysqli_query($con,$sql);
	
	if($confirm)
	{
	
	///upload/server/php/files
		$last_id = $con->insert_id;

		$targetPath = "../upload/server/php/files/".$last_id."/".$name_img;
	
	    $directoryName = "../upload/server/php/files/".$last_id."/";
 
    //Check if the directory already exists.
    if(!is_dir($directoryName)){
        //Directory does not exist, so lets create it.
        mkdir($directoryName, 0755, true);
    }
	
	if(move_uploaded_file($sourcePath,$targetPath)){
	
	$query="INSERT INTO `POST`(`USER_ID`, `CATEGORY_ID`,  `POST_SOURCE`, `FILE_TYPE`,  `PROFILE_PIC_STATUS`) VALUES ($last_id,42,'$targetPath','image/jpeg',1)";
 
	  mysqli_query($con,$query);
	
	
	
	}


echo '<script> window.location.href="../login.php?from=reg"; </script>';
  // echo "Done";
  
  //$mail_arr = array("imranhossen5912@gmail.com","imranhossen4847@gmail.com","jahidul282@gmail.com");
				
				/*foreach($USER_EMAIL as $USER_EMAILd){*/
  
if (!filter_var($USER_EMAIL, FILTER_VALIDATE_EMAIL) !== true) {
	if(!empty($USER_EMAIL)){
	
	
	//start phpmailer use
	  

                    $mail->IsSMTP();            // set mailer to use SMTP
                    $mail->Host     = "localhost";  // specify main and backup server
                    $mail->SMTPAuth = true;     // turn on SMTP authentication
                    $mail->Username = "no_reply@peepschannel.com";  // SMTP username
                    $mail->Password = "peepschannel.com"; // SMTP password
                    $mail->From     = "no_reply@peepschannel.com";
                    $mail->FromName = "PEEPS CHANNEL";
                    $mail->AddAddress($USER_EMAIL);
                    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
                    $mail->IsHTML(true);                                  // set email format to HTML
                    $mail->Subject  = "Congratulations !";
                            include "welcome_mail.php";
                    $mail->Body     = $welcome_mail_body;

                 if(!$mail->Send())
                      {
                       echo "Message could not be sent. <p>";
                       echo "Mailer Error: " . $mail->ErrorInfo;
                       
                       exit;
                    }else{
                    
                   // echo "Message has been sent";
                    
                    	 //end phpmailer use
	 
                    }	
	
} } /*}*/

//$res=mail($to, $subject, $message, $header);
	
	}else{

	echo '<script>';
	echo 'alert('.'"Something is wrong . Please try again. "'.');';

echo 'history.go(-1);';
echo '</script>';
	
	
	}
	
 }
	  
	  
	  
	
     mysqli_close($con);
	 

	?>