<?php include "header.php"; ?>
<!--  my page -->
<div class="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">


        <?php
        
        if(isset($_POST['submit'])){

             include 'config.php';

            // prevent un wanted charter
            $fname = mysqli_real_escape_string($connection, $_POST['fname']);
            $lname = mysqli_real_escape_string($connection, $_POST['lname']);
            $uname = mysqli_real_escape_string($connection, $_POST['uname']);
            $password = mysqli_real_escape_string($connection, md5($_POST['password']));
            $role = mysqli_real_escape_string($connection, $_POST['role']);

            $query = "SELECT user_name FROM user WHERE user_name = '$fname'";
            $result = mysqli_query($connection, $query) or die("failed");

            $count = mysqli_num_rows($result);

            if(count>0){
                echo "Username Already Exist";
            }else{
                $query1 = "INSERT INTO user (first_name,last_name,	user_name,password,role) VALUE ('$fname','$lname','$uname','$password','$role')";

                $result = mysqli_query($connection, $query1) or die("query failed");
                if($result){
                    header("location:users.php");
                }
            }
        }
        
        ?>


            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" placeholder="First name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" placeholder="Last name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="uname" placeholder="User name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>User Role</label>
                <select class="form-control" name="role">
                  <option value="0">Moderator</option>
                  <option value="1">admin</option>
                </select>
            </div>

            <input type="submit" name="submit" class="btn-primary" value="Add" required>

            </form>
            </div>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>