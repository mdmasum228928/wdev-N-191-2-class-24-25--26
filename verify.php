<?php
    include 'connection.php';

    if(isset($_GET['vkey'])){
        $vkey = $_GET['vkey'];
        $sql = "SELECT v_key,v_status FROM user WHERE v_status = 0 AND v_key = '$vkey'";

        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)>0){
            $sql = "UPDATE user SET v_status = 1 WHERE v_key = '$vkey' LIMIT 1";
            $query = mysqli_query($conn,$sql);

            if($query){
                echo "<h1>Successfully your register. Please login your accoun </h1>";
            }
        }
    }

?>