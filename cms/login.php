<?php 
$email = $_POST['email'];
$password = $_POST['password'];
//database connection here
$con= new mysqli("localhost","root","","users");
if($con->connect_error){
    die("Failed to connect : ".$con->connect_error);

}else{
    $stmt= $con->prepare("select * from users where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
$stmt_result= $stmt->get_result();
}

?> 