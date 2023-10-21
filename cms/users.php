<?php


include('includes/config.php');
include('includes/database.php');
include('includes/functions.php');
secure();

include('includes/header.php');

if ($stm = $connect->prepare('SELECT * FROM users')) {
  $stm->execute();

  $result = $stm->get_result();

  var_dump($result->num_rows);


if ($result->num_rows>0) {
   

?>

  <div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="display-1">Users management</h1>
<table class="table table-striped table-hover">
<tr>
  <th> Id</th>
  <th> Username </th>
  <th> Email</th>
  <th> status</th>
  <th> Edit /Delete</th>
</tr>
<?php while($record= mysqli_fetch_assoc($result)){ ?>
  <tr>

  <td><?php echo $record['id'];?></td>
  <td><?php echo $record['username'];?></td>
  <td><?php echo $record['email'];?></td>
  <td><?php echo $record['active'];?></td>
  <td><a href="users_edit.php?id=<?php echo $record['id'];?>">Edit</a>/
  <a href="users.php?delete=<?php echo $record['id'];?>">Delete</a></td>




  </tr>
<?php } ?>





</table>

<a href="users_add.php">Add new user</a>


    </div>
</div>




    <?php
  }else
  {
    echo 'No users found';
  }


  
  $stm->close();

}else{
  echo 'could not prepare statement!';
}
    include('includes/footer.php');
    ?>