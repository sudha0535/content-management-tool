<?php

include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');

include('includes/header.php');
if (isset($_SESSION['id'])) {
  header('Location: dashboard.php');
  die();
}

if (isset($_POST['email'])) {
  if ($stm = $connect->prepare('SELECT * FROM users WHERE email=? AND  password=?')) {
    $hashed = SHA1($_POST['password']);
    $stm->bind_param('ss', $_POST['email'] , $hashed);
    $stm->execute();

    $result = $stm->get_result();
    $user = $result->fetch_assoc();


    if ($user) {
      $_SESSION['id'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['username'] = $user['username'];

      set_message("You have successfully logged in " . $_SESSION['username']);
      header('Location: dashboard.php');
      die();
    }
    $stm->close();
  } else {
    echo 'could not prepare statement!';
  }
}
?>
<div class="container mt-5 ">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <form method="POST">
        <!-- Email input -->

        <input type="email" id="email" name="email" class="form-control" />
        <label class="form-label" for="email">Email address</label>


        <!-- Password input -->

        <input type="password" id="password"  name="password" class="form-control" />
        <label class="form-label" for="password">Password</label>


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
        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </form>
    </div>
  </div>
</div>

<?php
include('includes/footer.php');
?>