<?php include "header.php"; ?>
<?php

include 'config.php';

$rcv_id = $_GET['id'];

$query = "DELETE FROM user WHERE user_id = '{$rcv_id}'";

$result = mysqli_query($connection, $query);
if($result){
    header("location:users.php");
}else{
    echo "Can not Delete";
}

mysqli_close($connection);

?>
<?php include "footer.php"; ?>