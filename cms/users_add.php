<?php


include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');
 
if(isset($_POST['username']) ) {
  if ($stm = $connect->prepare('INSERT INTO users(username , email , password , active) VALUES(?, ?, ?, ?)')) {
    $hashed = SHA1($_POST['password']);
    $stm->bind_param('ssss',$_POST['username'] ,$_POST['email'] , $hashed, $_POST['active']);
    $stm->execute();

    set_message("A new user " . $_SESSION['username'] ." has been added");
      header('Location: users.php');
      $stm->close();
        die();



  } else {
    echo 'could not prepare statement!';
  }
}

?>

  <div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="display-1">Add user</h1>

    <form method="POST">
        <!-- Username input -->
        <input type="username" id="username"  name="username" class="form-control" />
        <label class="form-label" for="username">Username</label>
        <!--Email input-->

        <input type="email" id="email"  name="email" class="form-control" />
        <label class="form-label" for="email">Email address</label>

        <!-- Password input -->

        <input type="password" id="password"  name="password" class="form-control" />
        <label class="form-label" for="password">Password</label>

         <!-- Active select -->
         <div class="form-outline mb-4">
             <select name= "active" class="form-select" id="active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
             </select>
         </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
          </div>

        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Add user</button>
      </form>
    





      <a href="users_add.php">Add new user</a>


    </div>
</div>




    <?php
  

    include('includes/footer.php');
    ?>