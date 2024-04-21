
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

include 'config.php' ;
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $user_type = $_POST['user_type'];
    $mail = new PHPMailer(true);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    
    if(mysqli_num_rows($select_users) > 0)
    {
        $message[] = 'user already exist!';
    }else{
      if($pass !=$cpass)
      {
        $message[] = 'confirm password not matched !';
      }
      else{
        try {
          //Enable verbose debug output
          $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;

          //Send using SMTP
          $mail->isSMTP();

          //Set the SMTP server to send through
          $mail->Host = 'smtp.gmail.com';

          //Enable SMTP authentication
          $mail->SMTPAuth = true;

          //SMTP username
          $mail->Username = 'mouaouyalamyaa696@gmail.com';

          //SMTP password
          $mail->Password = 'zntxzsrdxshnqgoy';

          //Enable TLS encryption;
          $mail->SMTPSecure = 'SSL';

          //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
          $mail->Port = 465;

          //Recipients
          $mail->setFrom('mouaouyalamyaa696@gmail.com');

          //Add a recipient
          $mail->addAddress('mouaouyalamyaa@gmail.com');

          //Set email format to HTML
          $mail->isHTML(true);

          $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

          $mail->Subject = 'Email verification';
          $mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

          $mail->send();
          // echo 'Message has been sent';

          $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

          // connect with database
          
          // insert in users table

          
          mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, verification_code, email_verification ) VALUES('$name' , '$email' , '$encrypted_password' , '$user_type' , '$verification_code' , 'NULL')") or die('query failed');

          header("Location: verification_email.php?email=" . $email);
          exit();
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      
        
      }
    }




}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
   
</head>
<body>



<?php

if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
           <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';

    }
}
?>
<div class="form-container">

<form action="" method="post">
    <h3>regiter now</h3>

   <input type="text" name="name" placeholder="enter your name" required class="box">
   <input type="email" name="email" placeholder="enter your email" required class="box">
   <input type="password" name="password" placeholder="enter your password" required class="box">
   <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
   <select name="user_type" class="box">
    <option value="user">user</option>
    <option value="admin">admin</option>
   </select>
   <input type="submit" name="submit" value="regiter now" class="btn">
   <p>already have an account? <a href="login.php">login now</a></p>



</form>
</div>
    
</body>
</html>