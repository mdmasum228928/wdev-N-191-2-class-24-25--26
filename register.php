<?php
    include 'connection.php';

    use PHPMailer\PHPMailer\PHPMailer;

    require_once 'phpmailer/Exception.php';
    require_once 'phpmailer/PHPMailer.php';
    require_once 'phpmailer/SMTP.php';

    $email_check = '';
    $pwd = '';
    $length = '';

    if(isset($_POST['login'])){
        $name = mysqli_escape_string($conn,$_POST['name']);
        $email = mysqli_escape_string($conn,$_POST['email']);
        $password = mysqli_escape_string($conn,$_POST['password']);
        $confirmPassword = mysqli_escape_string($conn,$_POST['confirmPassword']);
        $mobile = mysqli_escape_string($conn,$_POST['mobile']);
        $district = mysqli_escape_string($conn,$_POST['district']);
        $country = mysqli_escape_string($conn,$_POST['country']);
        $university = mysqli_escape_string($conn,$_POST['university']);
        $birth = mysqli_escape_string($conn,$_POST['birth']);
        $gender = mysqli_escape_string($conn,$_POST['gender']);
        $email_exist = "SELECT email From user WHERE email = '$email'";

        $query = mysqli_query($conn,$email_exist);
        if(mysqli_num_rows($query)>0){
            $email_check = "Your Email is aleredy exaist";
        }
        else if($password != $confirmPassword){
            $pwd = "Your password does not match";
        }
        else if(strlen($name)<5){
            $length = "Length must be greater than 4";
        }
        else{
            $password = md5($password);
            $vkey = md5(time().$email);

            $sql = "INSERT INTO user(name,email,password,mobile,country,district,university,birth,gender,v_key,v_status)VALUES('$name','$email','$password','$mobile','$country','$district','$university','$birth','$gender','$vkey',0)";

            $query = mysqli_query($conn,$sql);
            if($query){
                $mail = new PHPMailer(ture);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'club3637@gmail.com';
                $mail->Password = '01866921240';

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = '587';
                $mail->setFrom('club3637@gmail.com');
                $mail->FromName = 'Md.Masum';
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification From Masum';
                $mail->Body = "<a href='http://localhost/masumphp/Practice_all/verify.php?vkey=$vkey'>Click Activition Link</a>";
                if(!$mail->send()){
                    echo "Mailer Error".$mail->ErrorInfo;
                }
                else{
                    echo "<script>alert('verification has been sent successfully')</script>";
                }
                header("location:success.php");
            }
            echo mysqli_error($conn);
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register Your Account</h2>
    <form action="?" method="POST">
        <input type="text" name="name" placeholder="Enter your name"><br>
        <span><?=$length;?></span><br>
        <input type="email" name="email" placeholder="Enter your email"><br>
        <span><?=$email_check;?></span><br>
        <input type="password" name="password" placeholder="Enter your password"><br><br>
        <input type="password" name="confirmPassword" placeholder="Enter your Confirm password"><br>
        <span><?=$pwd;?></span><br>
        <input type="text" name="mobile" placeholder="Enter your mobile"><br><br>
        <input type="text" name="country" placeholder="Enter your country"><br><br>
        <input type="text" name="district" placeholder="Enter your district"><br><br>
        <input type="text" name="university" placeholder="Enter your university"><br><br>
        <input type="date" name="birth" placeholder="Enter your birth"><br><br>
        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="Male">
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="Female"><br><br>
        <input type="submit" name="login" value="Register">
    </form>
</body>
</html>