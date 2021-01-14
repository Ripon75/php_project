<?php
   include 'config.php';
   
   if(empty($_FILES['new-image']['name'])){
       $new_name = $_POST['old-image'];
   }else{

       $error = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
       // explode pic.jpg k vag kore dibe = pic r jpg and end function last part nibe (jpg)
       $file_ext = end(explode('.',$file_name));
       $extensions = array("jpeg","jpg","png");
       //in_array function check between array
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
    //$image_name = $new_name;
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

   $query = " UPDATE post SET title='{$_POST["post_title"]}', description='{$_POST["postdesc"]}', category='{$_POST["category"]}',
   post_img='{$new_name}' WHERE post_id={$_POST["post_id"]};";

   if($_POST['old_category'] != $_POST["category"]){
       $query .= "UPDATE category SET post=post - 1 WHERE category_id = {$_POST['old_category']};";
       $query .= "UPDATE category SET post=post + 1 WHERE category_id = {$_POST['category']};";
   }

   $result = mysqli_multi_query($connection, $query);
   if($result){
       header("location: ../admin/post.php");
   }else{
       echo "Query Failed";
   }
   
   
?>