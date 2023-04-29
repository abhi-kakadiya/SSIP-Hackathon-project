<?php

    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "ssip_db";  
    
    $con = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }  

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'joshimayankh312@gmail.com';                     //SMTP username
        $mail->Password   = 'zoqhwvxkopgqgigq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $email = $_POST['email'];
        $mail->setFrom('anshmodi250@gmail.com', 'Admin');
        $mail->addAddress($email);     //Add a recipient

        //Content
        // $sql = "select password from o_login where email = '$email'";  
        // $result = mysqli_query($con, $sql);  
        // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        // $count = mysqli_num_rows($result);
        // echo $count;
       
        // echo "<h2>" . $txt1 . "</h2>";

        $result = mysqli_query($con, "select password AS pass from o_login where email = '$email'");
        if($row = mysqli_fetch_array($result))
        {
            // echo $row["pass"];

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Your Password';
            $mail->Body    = '<b> Your Password is '. $row["pass"] . '</b>';

            $mail->send();
            echo '<script>alert("Password has been sent to your e-mail.")</script>';
            echo '<script>location.replace("OfficerLogin.html")</script>';
            // echo 'Message has been sent';
        }

        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>