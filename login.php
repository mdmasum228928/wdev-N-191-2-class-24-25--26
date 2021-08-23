<?php
    include 'connection.php';
    $error = '';
    $invalid = '';

    session_start();

    if(isset($_SESSION['login_user'])){
        header('location:index.php');
    }

    if(isset($_POST['login'])){
        $email = mysqli_escape_string($conn,$_POST['email']);
        $password = mysqli_escape_string($conn,$_POST['password']);
        
        if(empty($email) || empty($password)){
            $error = "<span>This is field is required</span>";
        }
        else{
            $password = md5($password);
            $sql = "SELECT * FROM user WHERE email='$email' AND password = '$password'";
            $query = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($query)>=1){
                $_SESSION['login_user']=$email;
                header('location:index.php');
            }
            else{
                $invalid = "Invalid Email & password wrong";
            }
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login your account</h2>
    <form action="?" method="POST">
        <input type="email" placeholder="Enter your email" name="email"><br>
        <?=$error;?>
        <?=$invalid;?><br><br>
        <input type="password" placeholder="Enter your password" name="password"><br>
        <?=$error;?><br><br>
        <input type="submit" value="Login" name="login">
    </form>
</body>
</html>