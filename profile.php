<?php
    include 'session.php';
     $status = $row['v_status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pofile.php</title>
</head>
<body>
    <?php include 'header.php';?><br><br>

    <h5><?=$row['name'];?></h5>
    <div class="profile-info">
        <h1>Contact Information</h1>
        <ul style="list-style:none;">
            <li>
                <span style="font-size:20px; color:red;">Email Address  :</span>
                <?=$row['email'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">Mobile Number  :</span>
                <?=$row['mobile'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">Country  :</span>
                <?=$row['country'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">District :</span>
                <?=$row['district'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">University  :</span>
                <?=$row['university'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">Birth :</span>
                <?=$row['birth'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">Gender  :</span>
                <?=$row['gender'];?>
            </li>
            <li>
                <span style="font-size:20px; color:red;">Verification Account  :</span>
                <?php
                    if($status==0){
                        echo 'Not verified';
                    }
                    else{
                        echo 'verified';
                    }
                ?>
            </li>
        </ul>
    </div>


</body>
</html>