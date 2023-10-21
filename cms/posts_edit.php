<?php


include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');
 
if(isset($_POST['title']) ) {
  if ($stm = $connect->prepare('UPDATE posts set title=? , content=? , date=? where id=?')) {
  
    $stm->bind_param('sssi',$_POST['title'] ,$_POST['content'] ,  $_POST['date'] , $_GET['id']);
    $stm->execute();


      $stm->close();
      set_message("A  post " . $_GET['id'] ." has been updated");
      header('Location: posts.php');
die();


  } else {
    echo 'could not prepare post update statement!';
  }
}

if(isset($_GET['id'])){

  if ($stm = $connect->prepare('SELECT * FROM posts  WHERE id=?  ')) {
  
    $stm->bind_param('i', $_GET['id']);
    $stm->execute();

    $result = $stm->get_result();
  $post = $result->fetch_assoc();
if($post){

?>

  <div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="display-1">Edit posts</h1>

    <form method="POST">
        <!-- Title input -->
        <input type="text" id="title"  name="title" class="form-control" />
        <label class="form-label" for="title">Title</label>

        <!--Content input-->
        <textarea name="content" id="content"><?php echo $post['content']?>
      
      
    </textarea>

        <!-- Date input -->

        <input type="date" id="date"  name="date" class="form-control"  value="<?php echo $post['date']?>" />
        <label class="form-label" for="date">Date</label>

         
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Edit post</button>
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
  
  }
  $stm->close();
} else {
  echo 'could not prepare  statement!';
}

  }else{
    echo "No user selected";
    die();
  }

    include('includes/footer.php');
    ?>