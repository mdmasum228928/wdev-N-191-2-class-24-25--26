<?php
    include 'connection.php';
    $error = '';
    $alert = '';

    if(isset($_POST['category'])){
        $name = mysqli_escape_string($conn,$_POST['name']);
        $details = mysqli_escape_string($conn,$_POST['details']);

        if(empty($name) || empty($details)){
            $error =  "This field can not be";
        }
        else{
            $sql =  "INSERT INTO categories(name,details)VALUES('$name','$details')";
            $query = mysqli_query($conn,$sql);
            if($query){
                $alert = "Your categories successfully Inserted";
            }
            else{
                $alert = "Something went wrong".mysqli_error($query);
            }
        }
    }
?>
<?php
    include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script>
</head>
<body>
    <?php include 'header.php';?>
    <br><br>
    <div class="alert" style="background:red;">
        <h3><?=$alert;?></h3>
    </div>
    <h3>Add a New Category</h3><br><br>
    <form action="?" method="POST">
        <label>Name :</label>
        <input type="text" name="name" id="name" placeholder="Enter your name" style="width:40%;"><br>
        <?=$error;?><br><br>
        <textarea name="details" cols="50" rows="4" style="width:40%;" placeholder="Enter your details"></textarea><br>
        <?=$error;?><br><br>
        <button type="submit" name="category" style="width:40%;">Add a New Category</button>
    </form>
</body>
</html>