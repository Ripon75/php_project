<?php
   include 'config.php';
   
   if(isset($_FILES['fileToUpload'])){
       $error = array();

       $file_name = $_FILES['fileToUpload']['name'];
       $file_size = $_FILES['fileToUpload']['size'];
       $file_tmp = $_FILES['fileToUpload']['tmp_name'];
       $file_type = $_FILES['fileToUpload']['type'];
       // explode pic.jpg k vag kore dibe = pic r jpg and end function last part nibe (jpg)
       $file_ext = end(explode('.',$file_name));
       $extensions = array("jpeg","jpg","png");
       // in_array function check between array
       if(in_array($file_ext,$extensions)=== false)
       {
           $error[] = "This extension file not allowed";
       }
       if($file_size > 2097152)
       {
           $error[] = "File size must be 2mb or lower";
       }
    $new_name = time(). "_".basename($file_name);
    $target = "upload/".$new_name;
    if(empty($error)==true)
    {
       move_uploaded_file($file_tmp,$target);
    }
    else
    {
       print_r($error);
       die();
    }

   }
   
   
   session_start();

   $title = mysqli_real_escape_string($connection, $_POST['post_title']);
   $description = mysqli_real_escape_string($connection, $_POST['postdesc']);
   $category = mysqli_real_escape_string($connection, $_POST['category']);
   $date = date("d M, Y");
   $author = $_SESSION['user_id'];
   					
   $sql = "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$title}','{$description}', '{$category}', '{$date}', '{$author}', '{$new_name}');";

    //$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

   if(mysqli_multi_query($connection, $sql)){
       header("location:post.php");
   }else{
       echo "<div class='alert alert-danger'>Query Failed</div>";
   }

?>