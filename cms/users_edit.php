<?php


include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');
 
if(isset($_POST['username']) ) {
  if ($stm = $connect->prepare('UPDATE users set username=? , email=? , active=?   WHERE id=?')) {
    $stm->bind_param('sssi',$_POST['username'] ,$_POST['email'] , $_POST['active'] , $_GET['id']);
    $stm->execute();

      $stm->close();


      if(isset($_POST['password'])){
        if ($stm = $connect->prepare('UPDATE users set password=? WHERE id=?')) {
          $hashed=SHA1($_POST['password']);
          $stm->bind_param('si',$hashed , $_GET['id']);
          $stm->execute();
          $stm->close();
      
      
      } else {
        echo 'could not prepare password update statement!';
      }
      }
      set_message("A user " .  $_GET['id'] ." has been updated");
      header('Location: users.php');
      die(); 

  } else {
    echo 'could not prepare user update statement!';
  }


}

   if(isset($_GET['id'])){

    if ($stm = $connect->prepare('SELECT * FROM users WHERE id=?  ')) {
    
      $stm->bind_param('i', $_GET['id']);
      $stm->execute();
  
      $result = $stm->get_result();
    $user = $result->fetch_assoc();
if($user){


?>

  <div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="display-1">Edit user</h1>

    <form method="POST">
        <!-- Username input -->
        <input type="username" id="username"  name="username" class="form-control active"  value="<?php echo$user['username']?>"/>
        <label class="form-label" for="username">Username</label>
        <!--Email input-->

        <input type="email" id="email"  name="email" class="form-control active"  value="<?php echo$user['email']?>"/>
        <label class="form-label" for="email">Email address</label>

        <!-- Password input -->

        <input type="password" id="password"  name="password" class="form-control" />
        <label class="form-label" for="password">Password</label>

         <!-- Active select -->
         <div class="form-outline mb-4">
             <select name= "active" class="form-select" id="active">
              <option <?php echo($user['active'])? "selected": "";?> value="1">Active</option>
              <option <?php echo($user['active'])? "": "selected";?> value="0">Inactive</option>
             </select>
         </div>


        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Update user</button>
      </form>
    

    </div>
</div>




    <?php
  }
  $stm->close();
  die();
  }else{
    echo 'Could not prepare statement!';
  }
  }else{
    echo"No user selected";
    die();
  }

    include('includes/footer.php');
    ?>