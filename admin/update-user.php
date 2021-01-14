
<?php include "header.php"; 
  if($_SESSION['user_role'] == '0'){
   header("location:post.php");
 }
?>

<?php
 if(isset($_POST['submit'])){
      
    include 'config.php';

            // prevent un wanted charter
            $user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
            $fname = mysqli_real_escape_string($connection, $_POST['fname']);
            $lname = mysqli_real_escape_string($connection, $_POST['lname']);
            $uname = mysqli_real_escape_string($connection, $_POST['uname']);
            
            $role = mysqli_real_escape_string($connection, $_POST['role']);

            $query1 = "UPDATE user SET  first_name = '{$fname}',last_name = '{$lname}',user_name = '{$uname}',role = '{$role}' WHERE user_id='{$user_id}'";
            $result1 = mysqli_query($connection, $query1) or die("failed");
            if($result1){
                header("location:users.php");
            }
 }
?>

<div class="admin-content">
  <div class="container">
     <div class="row">
        <div class="col-md-12">
            <h1 class="Admin-heading">Modify user details</h1>
        </div>

        <div class="col-md-offset-4 col-md-4">

     <?php
      $user_id = $_GET['id'];
      include 'config.php';
      $query = "SELECT * FROM user WHERE user_id={$user_id}";
      $result = mysqli_query($connection , $query);
      $count = mysqli_num_rows($result);

      if($count>0){
          while($row=mysqli_fetch_assoc($result)){
     
     ?>
    

          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
              <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="">
            </div>

            <div class="form-group">
               <label >First Name</label>
               <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" >
            </div>
            <div class="form-group">
               <label >Last Name</label>
               <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" >
            </div>
            <div class="form-group">
               <label >User Name</label>
               <input type="text" name="uname" class="form-control" value="<?php echo $row['user_name'] ?>" placeholder="" >
            </div>
            <div class="form-group">
               <label >User Role</label>
              <select name="role" class="form-control" value="<?php echo $row['role'] ?>">
              <?php 
                       if($row['role']==1){
                           echo " <option value='0'>Moderator</option> ";
                           echo " <option value='1' selected>Admin</option> ";
                       }else{

                        echo " <option value='0' selected>Moderator</option> ";
                        echo " <option value='1'>Admin</option> ";
                       }
                       ?>
              </select>
            </div>
            <input type="submit" name="submit" class="btn-primary" value="Update" required>
          </form>
          <?php 
          }
         } 
         ?>
        </div>
     </div>
  </div>
</div>

<?php include "footer.php"; ?>