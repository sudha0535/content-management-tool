<?php


include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');
 
if(isset($_POST['title']) ) {
  if ($stm = $connect->prepare('INSERT INTO posts(title , content , author , date) VALUES(?, ?, ?, ?)')) {
    $hashed = SHA1($_POST['password']);
    $stm->bind_param('ssis',$_POST['title'] ,$_POST['content'] , $_SESSION['id'], $_POST['date']);
    $stm->execute();

    set_message("A new post " . $_SESSION['username'] ." has been added");
      header('Location: posts.php');
      $stm->close();
        die();



  } else {
    echo 'could not prepare statement!';
  }
}

?>

  <div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="display-1">Add posts</h1>

    <form method="POST">
        <!-- Username input -->
        <input type="text" id="title"  name="title" class="form-control" />
        <label class="form-label" for="title">Title</label>

        <!--Content input-->
        <textarea name="content" id="content"></textarea>

        <!-- Date input -->

        <input type="date" id="date"  name="date" class="form-control" />
        <label class="form-label" for="date">Date</label>

         
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Add post</button>
      </form>
    


    </div>
</div>

<script src="js/tintymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#content'
   });
</script>

    <?php
  

    include('includes/footer.php');
    ?>